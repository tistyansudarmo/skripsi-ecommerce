<?php

namespace App\Helpers;

use App\Models\Product;

class Cart {
    
    public function set($cart) {
        request()->session()->put('cart', $cart);
    }

    public function get() {
        request()->session()->get('cart');
    }
}