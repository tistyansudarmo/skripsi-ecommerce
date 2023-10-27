<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class HomeProduct extends Component
{
    use WithPagination;
    public $paginate = 4;
    public $search;
    public $nama = 'tistyan';
    protected $paginationTheme = 'bootstrap';


    public function render()
    {
        return view('livewire.product.home-product', ['products' => $this->search === null ? Product::latest()->paginate($this->paginate) : Product::latest()->where('title', 'like', '%' . $this->search . '%' )->paginate($this->paginate)]);
    }
}
