<?php

namespace App\Livewire\Shop;

use Livewire\Component;
use App\Facades\Cart as FacadesCart;

class Item extends Component
{

    public $cart;

    public function mount() {
        $this->cart = FacadesCart::get();
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
