<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Product;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;
use App\Models\Category;

class CreateProducts extends Component
{
    use WithFileUploads;

    #[Rule('required')]
    public $title = '';

    #[Rule('required')]
    public $description = '';

    #[Rule('required')]
    public $price = '';

    #[Rule('required')]
    public $quantity = '';

    #[Rule('required')]
    public $category = '';

    #[Rule('required')]
    public $selectedCategory;

    #[Rule('mimes:jpeg,jpg,png|max:1024')] // 1MB Max
    public $image;


    public function mount()
    {
    $this->category = Category::all();
    }

    public function render()
    {
        return view('livewire.admin.create-products');
    }

    public function save() {

        $this->validate();
        $product = Product::create([
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'category_id' => $this->selectedCategory,
            'image' => $this->image->store('photos', 'public')
        ]);

        $product->stock()->create([
            'quantity' => $this->quantity
        ]);

        $this->dispatch('productStore');
    }
}
