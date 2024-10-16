<?php

namespace App\Livewire\Navigation;

use App\Models\Cart;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class NavbarBottom extends Component
{
    public $cartTotal = 0;

    public function render()
    {
        return view('livewire.navigation.navbar-bottom');
    }

    #[On('addToCart')]
    #[On('removeCart')]
    public function mount() {
        if(Auth::guard('customers')->check()) {
            $this->cartTotal = Cart::where('customer_id', Auth::guard('customers')->user()->id)->count();
        }
    }
}
