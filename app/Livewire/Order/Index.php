<?php

namespace App\Livewire\Order;

use App\Models\Transaction;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $paginate = 5;

    // public function mount() {
        //     $this->status = Transaction::with(['product', 'user'])
        //     ->join('detail_transactions', 'transactions.id', '=', 'detail_transactions.transaction_id')
        //     ->where('user_id', auth()->user()->id)->paginate($this->paginate);
    // }

    #[On('updateStatus')]
    public function render()
    {
        return view('livewire.order.index', ['status' => Transaction::with(['product', 'user'])
            ->join('detail_transactions', 'transactions.id', '=', 'detail_transactions.transaction_id')
            ->orderBy('transactions.id', 'desc')
            ->where('user_id', auth()->user()->id)->paginate($this->paginate)]);
    }
}
