<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Admin extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $paginate = 5;
    public $search;
    public $formVisible;

    protected $queryString = [
        'search', 
    ];

    protected $listeners = [
        'formClose' => 'formCloseHandler',
        'productStore' => 'productStoreHandler'
    ];
    
    public function render()
    {
        
        return view('livewire.product.admin', ['products' => $this->search === null ? Product::latest()->paginate($this->paginate) : Product::latest()->where('title', 'like', '%' . $this->search . '%' )->paginate($this->paginate)]);
    }
    
    public function test() {
        return view('test');
    }


    public function formCloseHandler() {
        $this->formVisible = false;
    }

    public function productStoreHandler() {
        $this->formVisible = false;
        session()->flash('store', 'Your product was stored');
    }

}
