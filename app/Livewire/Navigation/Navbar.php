<?php

namespace App\Livewire\Navigation;


use Livewire\Component;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

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
        if(Auth::check()) {
            $this->cartTotal = Cart::where('user_id', auth()->user()->id)->count();
        }
    }
}
