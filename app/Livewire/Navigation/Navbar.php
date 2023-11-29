<?php

namespace App\Livewire\Navigation;

use App\Facades\Cart;
use Livewire\Component;

class Navbar extends Component
{

    public $cartTotal = 0;

    protected $listeners = [
        'addToCart' => 'updateCartTotal',
        'removeCart' => 'updateCartTotal'
    ];

    public function render()
    {

        return view('livewire.navigation.navbar');
    }

    public function mount()
    {
        $this->updateCartTotal();
    }


     public function updateCartTotal()
    {
        $this->cartTotal = count(Cart::get()['products']);
    }
}
