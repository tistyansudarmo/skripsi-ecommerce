<?php

namespace App\Livewire\Home;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\detail_transaction;

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

        $productRecom = null;

        // Cek apakah user sudah login
        if (Auth::guard('customers')->check()) {
            $productRecom = detail_transaction::join('transactions', 'transactions.id', '=', 'detail_transactions.transaction_id')
                ->join('customers', 'customers.id', '=', 'transactions.customer_id')
                ->join('products', 'products.id', '=', 'detail_transactions.product_id')
                ->join('product_recommendations', function ($join) {
                    $join->on('product_recommendations.product1_id', '=', 'products.id')
                        ->orOn('product_recommendations.product2_id', '=', 'products.id')
                        ->orOn('product_recommendations.product3_id', '=', 'products.id');
                })
                ->select(
                    'products.*',
                    'detail_transactions.product_id as transaction_product_id',
                    'product_recommendations.product1_id as product_recom1',
                    'product_recommendations.product2_id as product_recom2',
                    'product_recommendations.product3_id as product_recom3'
                )
                ->where('transactions.customer_id', '=', Auth::guard('customers')->user()->id)
                ->distinct()
                ->get();
        }


        return view('livewire.home.home-product', [
            'products' => $products,
            'categories' => $categories,
            'productRecom' => $productRecom
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

    public function recommendationProducts() {

    }

}
