<?php

namespace App\Livewire\Home;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class HomeProduct extends Component
{
    use WithPagination;
    public $paginate = 8;
    public $search;
    public $categoryId;
    protected $paginationTheme = 'bootstrap';

    protected $queryString = [
        'search',
    ];


    public function render()
    {
        $products = $this->search === null ?
        Product::with('category')
        ->where('category_id', 'like', '%' . $this->categoryId . '%')
        ->orderBy('id', 'desc')->paginate($this->paginate) :
        Product::with('category')
        ->where('name', 'like', '%' . $this->search . '%')
        ->orderBy('id', 'desc')
        ->paginate($this->paginate);

        $categories = Category::all();

        return view('livewire.home.home-product', [
            'products' => $products,
            'categories' => $categories
        ]);

    }

    public function addToCart($productId)
    {
        if (!Auth::guard('customers')->check()) {
            return redirect('/login');
        }

        $product = Product::find($productId);

        // Simpan ke database
        $cartModel = new Cart;
        $cartModel->customer_id = Auth::guard('customers')->user()->id;
        $cartModel->product_id = $product->id;
        $cartModel->save();
        $this->dispatch('addToCart');
        // dd(Cart::get()['products']);
    }

}
