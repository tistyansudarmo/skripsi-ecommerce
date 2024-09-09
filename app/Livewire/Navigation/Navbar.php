<?php

namespace App\Livewire\Navigation;


use Livewire\Component;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class Navbar extends Component
{

    public $cartTotal = 0;


    public function render()
    {

        return view('livewire.navigation.navbar');
    }


    #[On('addToCart')]
    #[On('removeCart')]
    public function mount()
    {
        if(Auth::guard('customers')->check()) {
            $this->cartTotal = Cart::where('customer_id', Auth::guard('customers')->user()->id)->count();
        }
    }

}
