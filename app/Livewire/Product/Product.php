<?php

namespace App\Livewire\Product;

use App\Models\Product as ModelsProduct;
use Livewire\Component;
use App\Models\detail_transaction;
use App\Models\Transaction;
use App\Models\Stock;
use Illuminate\Support\Carbon;

class Product extends Component
{

    public $selectedProduct;
    public $quantity = 1;
    public $totalPrice;

    public function mount($title)
    {
        $this->selectedProduct = ModelsProduct::where('title', $title)->first();
        $this->totalPrice = $this->calculateTotalPrice();
    }

    public function render()
    {
        return view('livewire.product.product');
    }

    public function increment()
    {
        $this->quantity++;
        $this->totalPrice = $this->calculateTotalPrice();
    }

    public function decrement()
    {
        if($this->quantity > 1) {
            $this->quantity--;
            $this->totalPrice = $this->calculateTotalPrice();
        }
    }

    public function checkout() {

        $transaction = new Transaction();
        $transaction->user_id = auth()->user()->id;
        $transaction->total_price = $this->selectedProduct->price * $this->quantity;
        $transaction->date = Carbon::now()->format('Y-m-d');
        $transaction->status = 'Sedang Diproses';
        $transaction->save();

        $detailTransaction = new detail_transaction();
        $detailTransaction->transaction_id = $transaction->id;
        $detailTransaction->product_id = $this->selectedProduct->id;
        $detailTransaction->quantity = $this->quantity;
        $detailTransaction->price = $this->selectedProduct->price;
        $detailTransaction->total_price = $transaction->total_price;
        $detailTransaction->date = Carbon::now()->format('Y-m-d');
        $detailTransaction->save();

        $stock = Stock::where('product_id', $this->selectedProduct->id)->first();
        $stock->quantity -= $this->quantity;
        $stock->save();

        return redirect('/order');


    }

    public function calculateTotalPrice()
    {
        $totalPrice = 0;

        if ($this->selectedProduct) {
            $totalPrice += $this->selectedProduct->price * $this->quantity;
        }

        return $totalPrice;

    }


}
