<?php

namespace App\Livewire\Shop;

use Livewire\Component;
use App\Models\Cart as CartModel;
use Illuminate\Support\Facades\Auth;

class Item extends Component
{
    public $cart;
    public $totalPrice;
    public $quantities = [];
    public $alamat;
    public $no_telepon;
    public $name;
    public $email;


    public function mount()
    {
        $this->viewCart();
    }

    public function viewCart()
    {
        $this->cart = CartModel::with(['product', 'customer'])
            ->join('products', 'products.id', '=', 'carts.product_id')
            ->join('customers', 'customers.id', '=', 'carts.customer_id')
            ->join('stocks', 'stocks.product_id', '=', 'products.id')
            ->select('products.*', 'stocks.*', 'carts.*')
            ->where('carts.customer_id', '=', Auth::guard('customers')->user()->id)
            ->get();

        // Iterasi melalui setiap item dalam properti 'cart'
        // Properti 'cart' berisi semua item dalam keranjang belanja pengguna saat ini
        foreach ($this->cart as $item) {
            // Periksa apakah array 'quantities' tidak memiliki entri untuk item ini
            // 'isset' memeriksa apakah suatu variabel sudah di-set dan bukan null
            // 'item->id' digunakan sebagai kunci untuk mengidentifikasi item secara unik
            if (!isset($this->quantities[$item->id])) {
                // Jika quantity belum diinisialisasi, tetapkan quantity item ini ke 1
                // Ini memastikan bahwa setiap item dalam keranjang memiliki quantity awal
                $this->quantities[$item->id] = 1;
            }
}

        $this->totalPrice = $this->calculateTotalPrice();
    }

    public function calculateTotalPrice()
    {
        $totalPrice = 0;

        foreach ($this->cart as $item) {
            $totalPrice += $item->price * $this->quantities[$item->id];
        }

        return $totalPrice;
    }

    public function increment($id)
    {
        $this->quantities[$id]++;
        $this->viewCart();
        $this->totalPrice = $this->calculateTotalPrice();
    }

    public function decrement($id)
    {
        if ($this->quantities[$id] > 1) {
            $this->quantities[$id]--;
        }
        $this->viewCart();
        $this->totalPrice = $this->calculateTotalPrice();
    }

    public function render()
    {
        return view('livewire.shop.item', [
            'cart' => $this->cart,
            'totalPrice' => $this->totalPrice,
            'quantities' => $this->quantities,
        ]);
    }

    public function removeCart($id)
    {
        $data = CartModel::find($id);
        $data->delete();

        $this->viewCart();
        $this->dispatch('removeCart');
    }


    public function redirectToCheckout(){
        $quantities = [];
        foreach ($this->cart as $item) {
            if ($this->quantities[$item->id] > $item->product->stock->quantity) {
                session()->flash('errorCheckout', 'The quantity of product is not enough!');
                $this->viewCart();
                return;
            }

            $quantity = $this->quantities[$item->id];
            $quantities[$item->id] = $quantity;
            $weight = $item->product->weight;
        }
        session()->put('totalQtyCart', $quantities);
        session()->put('weight', $weight);
        session()->put('totalPriceCart', $this->totalPrice);
        return redirect()->route('checkoutCart');
    }
}
