<?php

namespace App\Livewire\Shop;

use Livewire\Component;
use App\Models\Cart as CartModel;
use App\Models\detail_transaction;
use App\Models\Transaction;
use App\Models\Stock;
use Illuminate\Support\Carbon;

class Item extends Component
{
    public $cart;
    public $totalPrice;
    public $quantities = [];

    public function mount()
    {
        $this->viewCart();
    }

    public function viewCart()
    {
        $this->cart = CartModel::with(['product', 'user'])
            ->join('products', 'products.id', '=', 'carts.product_id')
            ->join('users', 'users.id', '=', 'carts.user_id')
            ->join('stocks', 'stocks.product_id', '=', 'products.id')
            ->select('products.*', 'stocks.*', 'carts.*')
            ->where('carts.user_id', '=', auth()->user()->id)
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

    public function checkout()
    {
        $carts = auth()->user()->cart;

        foreach ($carts as $cart) {
            $quantity = $this->quantities[$cart->id];

            if ($quantity > $cart->product->stock->quantity) {
                session()->flash('errorCheckout', 'The quantity of product is not enough!');
                $this->viewCart();
                return;
            }

            $transaction = new Transaction();
            $transaction->user_id = $cart->user_id;
            $transaction->total_price = $cart->product->price * $quantity;
            $transaction->date = Carbon::now()->format('Y-m-d');
            $transaction->status = 'Sedang Diproses';
            $transaction->save();

            $detailTransaction = new detail_transaction();
            $detailTransaction->transaction_id = $transaction->id;
            $detailTransaction->product_id = $cart->product_id;
            $detailTransaction->quantity = $quantity;
            $detailTransaction->price = $cart->product->price;
            $detailTransaction->total_price = $transaction->total_price;
            $detailTransaction->date = Carbon::now()->format('Y-m-d');
            $detailTransaction->save();

            $stock = Stock::where('product_id', $cart->product_id)->first();
            $stock->quantity -= $quantity;
            $stock->save();
        }

        CartModel::where('user_id', auth()->user()->id)->delete();

        $this->viewCart();
        session()->flash('checkout', 'Your product has been successfully checked out');
        $this->dispatch('removeCart');
    }
}
