<?php

namespace App\Livewire\Shop;

use Livewire\Component;
use App\Models\Cart as CartModel;
use App\Models\Transaction;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;

class Item extends Component
{

    public $calculate;
    public $cart;
    public $totalPrice;
    public $qty = 1;


    public function viewCart() {
        $this->cart = CartModel::join('products', 'products.id', '=', 'carts.product_id')
        ->join('users', 'users.id', '=', 'carts.user_id')
        ->join('stocks', 'stocks.product_id', '=', 'products.id')
        ->select('products.*', 'stocks.*', 'carts.*')
        ->where('carts.user_id', '=', auth()->user()->id)
        ->get();

        $this->totalPrice = $this->calculateTotalPrice();
    }

    public function mount() {

        $this->viewCart();
    }

    public function calculateTotalPrice() {
        // Inisialisasi total harga
        $totalPrice = 0;

        // Loop melalui setiap produk dalam keranjang
        foreach ($this->cart as $item) {
            // Menghitung harga untuk setiap produk dengan mengalikan harga produk dengan jumlahnya
            $totalPrice += $item->price * $this->qty;
        }

        // Mengembalikan total harga yang dihitung
        return $totalPrice;
    }

    public function increment() {

        $this->qty++;
        $this->viewCart();
        $this->totalPrice = $this->calculateTotalPrice();

    }

    public function decrement() {
        if($this->qty > 1) {
            $this->qty--;
        }

        $this->viewCart();
        $this->totalPrice = $this->calculateTotalPrice();
    }


    public function render() {

        return view('livewire.shop.item');
    }

    public function removeCart($id) {

        $data = CartModel::find($id);
        $data->delete();

        $this->viewCart();
        $this->dispatch('removeCart');

    }

    public function checkout() {
        $carts = auth()->user()->cart;

        foreach ($carts as $cart) {
            if($this->qty > $cart->product->stock->quantity) {
                session()->flash('errorCheckout', 'The quantity of product is not enough!');
                $this->viewCart();
                return;
            }
            // Buat entri transaksi
            $transaction = new Transaction();
            $transaction->user_id = $cart->user_id;
            $transaction->product_id = $cart->product_id;
            $transaction->quantity = $this->qty;
            $transaction->total_price = $cart->product->price * $this->qty;
            $transaction->description = $cart->product->description;
            $transaction->status_transaction = 'Menunggu Pembayaran';
            $transaction->save();

            // Kurangi jumlah persediaan produk
            $stock = Stock::where('product_id', $cart->product_id)->first();
            $stock->quantity -= $this->qty;
            $stock->save();

        }

        CartModel::where('user_id', auth()->user()->id)->delete();

        $this->viewCart();
        session()->flash('checkout', 'Your product has been successfully checked out');
        $this->dispatch('removeCart');


    }

}
