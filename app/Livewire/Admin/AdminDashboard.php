<?php
// https://www.codehim.com/bootstrap/bootstrap-5-product-card-template/

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Transaction;
use Livewire\Component;

class AdminDashboard extends Component
{
    public $product;
    public $categories;
    public $transactions;
    public $user;

    public function render()
    {
        return view('livewire.admin.admin-dashboard')->layout('components.layouts.admin-layout');
    }

    public function mount() {
        $this->product = Product::all()->count();
        $this->categories = Category::all()->count();
        $this->transactions = Transaction::all()->count();
        $this->user = Customer::all()->count();
    }


}
