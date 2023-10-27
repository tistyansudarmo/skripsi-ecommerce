<?php
// https://www.codehim.com/bootstrap/bootstrap-5-product-card-template/

namespace App\Livewire\Product;

use App\Models\Product;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;

class Admin extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $paginate = 5;
    public $search;
    public $formVisible;
    public $productId;
    public $formUpdate = false;

    #[Rule('required')] 
    public $title;

    #[Rule('required')] 
    public $description;

    #[Rule('required')] 
    public $price;

    public $image;

    public $imageOld;

    protected $queryString = [
        'search', 
    ];

    protected $listeners = [
        'formClose' => 'formCloseHandler',
        'productStore' => 'productStoreHandler',
    ];

    
    public function render()
    {
        return view('livewire.product.admin-product', ['products' => $this->search === null ? Product::latest()->paginate($this->paginate) : Product::latest()->where('title', 'like', '%' . $this->search . '%' )->paginate($this->paginate)]);
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
        $this->productId = $product['id'];
        $this->title = $product['title'];
        $this->description = $product['description'];
        $this->price = $product['price'];
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
        ]);

        $this->formVisible = false;
        session()->flash('update', 'Your product was update');
    }

    public function delete($productId) {
        $data = Product::find($productId);
        $data->delete();
    }


}
