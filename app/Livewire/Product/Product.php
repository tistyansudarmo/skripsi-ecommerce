<?php

namespace App\Livewire\Product;

use App\Models\Product as ModelsProduct;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Product extends Component
{

    public $selectedProduct;
    public $quantity = 1;
    public $totalPrice;
    public $alamat;
    public $no_telepon;
    public $name;
    public $email;

    public function mount($name)
    {
        $this->selectedProduct = ModelsProduct::where('name', $name)->first();
        $this->totalPrice = $this->calculateTotalPrice();
    }

    public function render()
    {
        return view('livewire.product.product');
    }

    public function increment()
    {
        $this->quantity++;
        $this->totalPrice = $this->calculateTotalPrice();
    }

    public function decrement()
    {
        if($this->quantity > 1) {
            $this->quantity--;
            $this->totalPrice = $this->calculateTotalPrice();
        }
    }


    public function calculateTotalPrice()
    {
        $totalPrice = 0;

        if ($this->selectedProduct) {
            $totalPrice += $this->selectedProduct->price * $this->quantity;
        }

        return $totalPrice;

    }

    public function redirectToCheckout(){

        if($this->quantity > $this->selectedProduct->stock->quantity) {
                session()->flash('errorCheckout', 'The quantity of product is not enough!');
                return;
        }

        session()->put('totalPrice', $this->totalPrice);
        session()->put('qty', $this->quantity);
        return redirect()->route('checkout', ['name' => $this->selectedProduct->name]);
    }
}
