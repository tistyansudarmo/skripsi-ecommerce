<?php

namespace App\Livewire\Checkout;

use Livewire\Component;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\detail_transaction;
use App\Models\Transaction;
use Illuminate\Support\Carbon;
use App\Models\Stock;
use App\Models\Cart;
use App\Models\Cities;
use App\Models\Province;
use Illuminate\Support\Facades\Http;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;
use Livewire\Attributes\Rule;


class Checkout extends Component
{
    public $sellerName;
    public $sellerEmail;
    public $sellerAddress;
    public $sellerPhone;
    public $sellerProvince;
    public $sellerCity;
    public $sellerPostalCode;
    public $productName;
    public $productDescription;
    public $productSize;
    public $productPrice;
    public $productImage;
    #[Rule('required')]
    public $buyerAddress;
    #[Rule('required')]
    public $buyerPhone;
    public $buyerName;
    public $buyerEmail;
    #[Rule('required')]
    public $buyerProvince;
    #[Rule('required')]
    public $buyerCity;
    #[Rule('required')]
    public $buyerPostalCode;
    public $selectedProduct;
    public $qty = 1;
    public $cart;
    public $quantities = [];
    public $totalPrice;
    public $totalQtyCart;
    public $totalPriceCart;
    #[Rule('required')]
    public $courier;
    public $sellerOrigin;
    public $getShippingCosts = [];
    #[Rule('required')]
    public $shipping;
    public $shippingCosts;
    public $shippingService;
    public $etd;
    public $snapToken;

    public function render()
    {
        $province = Province::all();

        $city = Cities::where('province_id', '=', $this->buyerProvince)->get();

        return view('livewire.checkout.checkout', ['province' => $province, 'city' => $city]);
    }

    public function productCart() {
        $this->cart = Cart::with(['product', 'customer'])
        ->join('products', 'products.id', '=', 'carts.product_id')
        ->join('customers', 'customers.id', '=', 'carts.customer_id')
        ->join('stocks', 'stocks.product_id', '=', 'products.id')
        ->select('products.*', 'stocks.*', 'carts.*')
        ->where('carts.customer_id', '=', Auth::guard('customers')->user()->id)
        ->get();
    }

    public function mount($name = null) {

        $this->buyerName = Auth::guard('customers')->user()->name;
        $this->buyerAddress = Auth::guard('customers')->user()->address_street;
        $this->buyerPhone = Auth::guard('customers')->user()->no_telepon;
        $this->buyerEmail = Auth::guard('customers')->user()->email;
        $this->buyerProvince = Auth::guard('customers')->user()->province_id;
        $this->buyerCity = Auth::guard('customers')->user()->city_id;
        $this->buyerPostalCode = Auth::guard('customers')->user()->postal_code;
        $this->totalPrice = session('totalPrice');
        $this->qty = session('qty');
        $this->totalQtyCart = session('totalQtyCart');
        $this->totalPriceCart = session('totalPriceCart');

        $seller = User::where('name', 'admin')->first();

            $this->sellerName = $seller->name;
            $this->sellerAddress = $seller->address_street;
            $this->sellerPhone = $seller->no_telepon;
            $this->sellerCity = $seller->city->name;
            $this->sellerOrigin = $seller->city_id;
            $this->sellerProvince = $seller->province->name;
            $this->sellerPostalCode = $seller->postal_code;
            $this->sellerEmail = $seller->email;

        if($name) {
            $this->selectedProduct = Product::where('name', $name)->first();
        } else {
            $this->productCart();
        }

        $this->checkout();
    }


    public function shippingCost() {
        $this->productCart();
        if ($this->buyerProvince && $this->buyerCity && $this->courier) {
            // Call RajaOngkir API to get shipping cost
            // Jika produk yang dipilih adalah satu produk (checkout satu produk saja)

            $totalWeight = 0;
            if ($this->selectedProduct) {
                $totalWeight = $this->selectedProduct->weight * $this->qty;
            }
            // Jika ada banyak produk di keranjang (checkout dari cart)
            else {
                foreach ($this->cart as $item) {
                    // Tambahkan berat setiap produk dikalikan dengan kuantitasnya
                    $totalWeight += $item->product->weight * $this->totalQtyCart[$item->id];
                }
            }
            $courier = Http::withHeaders([
                'key' => '96abfca08a93e9256ddbe3297040d191',
            ])->post('https://api.rajaongkir.com/starter/cost', [
                'origin' => $this->sellerOrigin,
                'destination' => $this->buyerCity,
                'weight' => $totalWeight,
                'courier' => $this->courier,
            ]);
            // Save the shipping costs
            $this->getShippingCosts = $courier['rajaongkir']['results'][0];
        }
    }


    public function checkout() {
        $this->validate();
        $user = Auth::guard('customers')->user();

        // Update buyer information
        $user->update([
            'address_street' => $this->buyerAddress,
            'no_telepon' => $this->buyerPhone,
            'province_id' => $this->buyerProvince,
            'city_id' => $this->buyerCity,
            'postal_code' => $this->buyerPostalCode
        ]);

        // Set shipping information
        // "Pos Reguler 22500 4 HARI"
        if($this->shipping && $this->courier == 'pos') {
            $shippingExplode = explode(' ', $this->shipping);
            $shippingService1 = $shippingExplode[0];
            $shippingService2 = $shippingExplode[1];
            $this->shippingService = $shippingService1 . ' ' . $shippingService2;
            $this->shippingCosts = $shippingExplode[2];
            $this->etd = $shippingExplode[3];
        } else {
            $shippingExplode = explode(' ', $this->shipping);
            $this->shippingService = $shippingExplode[0];
            $this->shippingCosts = $shippingExplode[1];
            $this->etd = $shippingExplode[2];
        }

        // Save detail transaction (for one product or cart)
        if ($this->selectedProduct) {
            // Save transaction to the database
            $transaction = new Transaction();
            $transaction->customer_id = Auth::guard('customers')->user()->id;
            $transaction->total_price = $this->totalPrice + $this->shippingCosts;
            $transaction->courier = $this->courier;
            $transaction->order_id_midtrans = uniqid();
            $transaction->shipping_cost = $this->shippingCosts;
            $transaction->shipping_service = $this->shippingService;
            $transaction->estimate = $this->etd;
            // $transaction->order_id = uniqid();
            $transaction->date = Carbon::now()->format('Y-m-d');
            $transaction->status = 'Belum dibayar';
            $transaction->save();

            $detailTransaction = new detail_transaction();
            $detailTransaction->transaction_id = $transaction->id;
            $detailTransaction->product_id = $this->selectedProduct->id;
            $detailTransaction->quantity = $this->qty;
            $detailTransaction->price = $this->selectedProduct->price;
            $detailTransaction->total_price = $transaction->total_price;
            $detailTransaction->date = Carbon::now()->format('Y-m-d');
            $detailTransaction->save();

            // Update stock
            $stock = Stock::where('product_id', $this->selectedProduct->id)->first();
            $stock->quantity -= $this->qty;
            $stock->save();
        } else {
            foreach ($this->cart as $item) {

            // Save transaction to the database
            $transaction = new Transaction();
            $transaction->customer_id = Auth::guard('customers')->user()->id;
            $transaction->total_price = $this->totalPriceCart + $this->shippingCosts;
            $transaction->courier = $this->courier;
            $transaction->order_id_midtrans = uniqid();
            $transaction->shipping_cost = $this->shippingCosts;
            $transaction->shipping_service = $this->shippingService;
            $transaction->estimate = $this->etd;
            // $transaction->order_id = uniqid();
            $transaction->date = Carbon::now()->format('Y-m-d');
            $transaction->status = 'Belum dibayar';
            $transaction->save();

            $detailTransaction = new detail_transaction();
            $detailTransaction->transaction_id = $transaction->id;
            $detailTransaction->product_id = $item->product_id;
            $detailTransaction->quantity = $this->totalQtyCart[$item->id];
            $detailTransaction->price = $item->product->price;
            $detailTransaction->total_price = $this->totalPriceCart + $this->shippingCosts;
            $detailTransaction->date = Carbon::now()->format('Y-m-d');
            $detailTransaction->save();

            // Update stock
            $stock = Stock::where('product_id', $item->product_id)->first();
            $stock->quantity -= $this->totalQtyCart[$item->id];
            $stock->save();
            }

            // Clear the cart after checkout
            Cart::where('customer_id', Auth::guard('customers')->user()->id)->delete();
        }

        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = config('services.midtrans.is_sanitized');
        Config::$is3ds = config('services.midtrans.is_3ds');

        // Create transaction data for Midtrans
        $transactionDetails = [
            'order_id' => $transaction->order_id_midtrans, // Generate unique ID for transaction
            'gross_amount' => $this->totalPrice + $this->shippingCosts, // Total price including shipping
        ];

        // Get item details for Midtrans payment
        $itemDetails = [];
        if ($this->selectedProduct) {
            $itemDetails[] = [
                'id' => $this->selectedProduct->id,
                'price' => $this->selectedProduct->price,
                'quantity' => $this->qty,
                'name' => $this->selectedProduct->name
            ];
        } else {
            foreach ($this->cart as $item) {
                $itemDetails[] = [
                    'id' => $item->product_id,
                    'price' => $item->product->price,
                    'quantity' => $this->totalQtyCart[$item->id],
                    'name' => $item->product->name
                ];
            }
        }

        // Add shipping cost as a separate item
        $itemDetails[] = [
            'id' => 'SHIPPING',
            'price' => $this->shippingCosts,
            'quantity' => 1,
            'name' => 'Shipping Cost'
        ];

        // Set customer details
        $customerDetails = [
            'first_name' => $this->buyerName,
            'email' => $this->buyerEmail,
            'phone' => $this->buyerPhone,
            'billing_address' => [
                'first_name' => $this->buyerName,
                'email' => $this->buyerEmail,
                'phone' => $this->buyerPhone,
                'address' => $this->buyerAddress,
                'city' => Auth::guard('customers')->user()->city->name,
                'postal_code' => $this->buyerPostalCode,
                'province' => $this->buyerProvince,
            ]
        ];

        // Midtrans Snap payload
        $payload = [
            'transaction_details' => $transactionDetails,
            'item_details' => $itemDetails,
            'customer_details' => $customerDetails,
        ];

        // Generate Snap token
        $snapToken = Snap::getSnapToken($payload);

        // Redirect to Midtrans payment page using Snap token
        return redirect()->route('payment', ['snap_token' => $snapToken]);
    }

    public function handleMidtransNotification() {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = config('services.midtrans.is_sanitized');
        Config::$is3ds = config('services.midtrans.is_3ds');
        $notif = new Notification();

        $transactionStatus = $notif->transaction_status;
        $orderId = $notif->order_id;
        $transaction = Transaction::where('order_id_midtrans', $orderId)->first();

        // Lakukan logika penyimpanan transaksi setelah mendapatkan notifikasi
        if ($orderId && $transactionStatus == 'settlement') {
        // Save transaction to the database
            $transaction->status = 'Sudah dibayar';
            $transaction->save();
        }
    }

}
