<?php

namespace App\Livewire\Home;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
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
        return view('livewire.home.home-product', [
            'products' => $this->search === null ?
                Product::with('category')
                ->orderBy('id', 'desc')->paginate($this->paginate) :
                Product::with('category')
                ->where('title', 'like', '%' . $this->search . '%')
                    ->orderBy('id', 'desc')
                    ->paginate($this->paginate)
        ]);

    }

    public function addToCart($productId)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        $product = Product::find($productId);

        // Simpan ke database
        $cartModel = new Cart;
        $cartModel->user_id = auth()->user()->id;
        $cartModel->product_id = $product->id;
        $cartModel->save();
        $this->dispatch('addToCart');
        // dd(Cart::get()['products']);
    }
}
