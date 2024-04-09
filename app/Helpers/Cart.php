<?php

namespace App\Helpers;

use App\Models\Product;
use App\Models\Cart as CartModel;

class Cart
{
    public function __construct()
    {
        if ($this->get() === null ) {
            $this->set($this->empty());
        }
    }

    public function set($cart)
    {
        request()->session()->put('cart', $cart);
    }

    public function get()
    {
        return request()->session()->get('cart');
    }

    public function empty()
    {
        return [
            'products' => []
        ];
    }

    public function add(Product $product)
{
    $cart = $this->get();
    $cart['products'][] = $product->id;

    // Simpan ke database
    $cartModel = new CartModel();
    $cartModel->user_id = auth()->user()->id;
    $cartModel->product_id = $product->id;
    $cartModel->save();

    $this->set($cart);
}


    public function remove($productId)
    {
        $cart = $this->get();

        // Cari posisi produk dalam array products
        $index = array_search($productId, $cart['products']);

        // Hapus produk dari array jika ditemukan
        if ($index !== false) {
            unset($cart['products'][$index]);

        // Simpan perubahan ke session
        $this->set($cart);

        CartModel::where('user_id', auth()->user()->id)
            ->where('product_id', $productId)
            ->delete();
    }
    }

    public function clear()
    {
        $this->set($this->empty());
        // Kosongkan data di database
        CartModel::truncate();
    }
}
