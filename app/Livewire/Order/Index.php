<?php

namespace App\Livewire\Order;

use App\Models\Transaction;
use Livewire\Component;
use Livewire\Attributes\On;

class Index extends Component
{
    public $status;


    #[On('updateStatus')]
    public function mount() {
        $this->status = Transaction::with(['product', 'user', 'status'])
        ->where('user_id', auth()->user()->id)->get();
    }


    public function render()
    {
        return view('livewire.order.index');
    }
}
