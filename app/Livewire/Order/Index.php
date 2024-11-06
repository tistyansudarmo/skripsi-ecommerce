<?php

namespace App\Livewire\Order;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $paginate = 5;

    #[On('updateStatus')]
    public function render()
    {
        $status = Transaction::with(['product', 'customer'])
        ->join('detail_transactions', 'transactions.id', '=', 'detail_transactions.transaction_id')
        ->orderBy('transactions.id', 'desc')
        ->where('customer_id', Auth::guard('customers')->user()->id)->paginate($this->paginate);

        $offset = ($status->currentPage() - 1) * $this->paginate;
        return view('livewire.order.index', ['status' => $status, 'offset' => $offset]);
    }
}
