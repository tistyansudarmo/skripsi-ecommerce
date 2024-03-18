<?php

namespace App\Livewire\Shop;

use App\Models\User;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Checkout extends Component
{

    public $fullName;
    public $username;
    public $email;
    public $phoneNumber;
    public $address;

    public function mount()
    {
        $user = Auth::user();
        $this->fullName = $user->full_name;
        $this->username = $user->username;
        $this->email = $user->email;
        $this->phoneNumber = $user->no_telepon;
        $this->address = $user->alamat;
    }

    public function checkout()
    {
        // Your checkout logic here
    }

    public function render()
    {
        return view('livewire.shop.checkout');
    }

}
