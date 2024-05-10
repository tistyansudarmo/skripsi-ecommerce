<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;

class AdminProducts extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $paginate = 5;
    public $search;
    public $formVisible;
    public $productId;
    public $formUpdate = false;
    public $category;

    #[Rule('required')]
    public $selectedCategory;

    #[Rule('required')]
    public $title;

    #[Rule('required')]
    public $description;

    #[Rule('required')]
    public $price;

    #[Rule('required')]
    public $quantity;

    public $image;

    public $imageOld;

    protected $queryString = [
        'search',
    ];

    protected $listeners = [
        'formClose' => 'formCloseHandler',
        'productStore' => 'productStoreHandler',
    ];


    public function mount() {
        $this->category = Category::all();
    }


    public function render()
    {
        return view('livewire.admin.admin-products', ['products' => $this->search === null ? Product::orderBy('id', 'desc')->paginate($this->paginate) : Product::where('title', 'like', '%' . $this->search . '%' )->orderBy('id', 'desc')->paginate($this->paginate)])->layout('components.layouts.admin-layout');
    }

    public function formCloseHandler() {
        $this->formVisible = false;
    }

    public function productStoreHandler() {
        $this->formVisible = false;
        session()->flash('store', 'Your product was stored');
    }

    public function showUpdate($productId) {
        $this->formUpdate = true;
        $this->formVisible = true;

        $product = Product::find($productId);
         // Ambil stock terkait dengan produk
        $stock = Stock::where('product_id', $product->id)->first();

        // Periksa apakah stock ditemukan sebelum mengakses quantity
        if ($stock) {
            $this->quantity = $stock->quantity;
        } else {
            // Jika stock tidak ditemukan, Anda bisa mengatasi sesuai kebutuhan, misalnya, memberi nilai default atau memberikan pesan kesalahan.
            $this->quantity = 0; // Atau sesuaikan dengan nilai default yang sesuai.
        }
        $this->productId = $product['id'];
        $this->title = $product['title'];
        $this->description = $product['description'];
        $this->price = $product['price'];
        $this->selectedCategory = $product['category_id'];
        $this->imageOld = asset('storage/' .  $product['image']);

    }

    public function update() {

        $this->validate();
        $product = Product::find($this->productId);

        if($this->image) {
            File::delete(public_path('storage/' . $product->image));
            $this->validate(['image' => 'mimes:jpeg,jpg,png|max:1024']);
            $product->image = $this->image->store('photos', 'public');
        }

        $product->update([
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'category_id' => $this->selectedCategory
        ]);

        // Periksa apakah ada model Stock terkait dengan produk
        $stock = Stock::where('product_id', $product->id)->first();

        // Update quantity pada model Stock
        $stock->quantity = $this->quantity;
        $stock->update();

        $this->formVisible = false;
        session()->flash('update', 'Your product was updated');
    }

    public function delete($productId) {
        $data = Product::find($productId);
        $data->delete();
        // Periksa apakah ada model Stock terkait dengan produk
        $stock = Stock::where('product_id', $productId)->first();

        // Update quantity pada model Stock
        $stock->quantity = $this->quantity;
        $stock->delete();
    }
}
