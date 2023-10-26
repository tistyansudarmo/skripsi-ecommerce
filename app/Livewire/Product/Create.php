<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;

class Create extends Component
{
   use WithFileUploads;

    #[Rule('required')] 
    public $title = '';

    #[Rule('required')] 
    public $description = '';

    #[Rule('required')] 
    public $price = '';

    #[Rule('mimes:jpeg,jpg,png|max:1024')] // 1MB Max
    public $image;

    public function render()
    {
        return view('livewire.product.create');
    }

    public function save() {

        $this->validate();
        Product::create([
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'image' => $this->image->store('photos', 'public')
        ]);
        
        $this->dispatch('productStore');
    }
}
