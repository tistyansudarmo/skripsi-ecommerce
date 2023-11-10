<?php

namespace App\Livewire\Product;

use App\Facades\Cart;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class HomeProduct extends Component
{
    use WithPagination;
    public $paginate = 8;
    public $search;
    protected $paginationTheme = 'bootstrap';

    protected $queryString = [
        'search', 
    ];


    public function render()
    {
        return view('livewire.product.home-product', ['products' => $this->search === null ? Product::latest()->paginate($this->paginate) : Product::latest()->where('title', 'like', '%' . $this->search . '%' )->paginate($this->paginate)]);
    }

    public function addToCart($productId)
    {
        $product = Product::find($productId);
        Cart::add($product);
        $this->dispatch('addToCart');
        // dd(Cart::get()['products']);
    }
}
