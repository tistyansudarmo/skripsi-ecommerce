<?php

namespace App\Livewire\Shop;

use Livewire\Component;
use App\Facades\Cart as FacadesCart;
use App\Models\Product;

class Item extends Component
{

    public $cart;
    public $totalPrice;

    public function mount() {
        $this->cart = FacadesCart::get();
        $this->totalPrice = $this->calculateTotalPrice();
    }

    public function calculateTotalPrice()
{
    // Ambil ID produk dari keranjang belanja
    $productIds = $this->cart['products'];

    // Hitung total harga berdasarkan ID produk
    foreach ($productIds as $productId) {
        // Cari harga produk berdasarkan ID
        $product = Product::find($productId);

        // Jika produk ditemukan, tambahkan harganya ke total harga
        if ($product) {
            $this->totalPrice += $product->price;
        }
    }

    // Kembalikan total harga
    return $this->totalPrice;
}


    public function render()
    {
        return view('livewire.shop.item');
    }

    public function removeCart($id) {
        FacadesCart::remove($id);
        $this->cart = FacadesCart::get();
        $this->dispatch('removeCart');
    }
}
