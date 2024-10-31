<?php

namespace App\Livewire\Transaction;

use App\Models\detail_transaction;
use Livewire\WithPagination;
use Livewire\Component;
use App\Exports\TransactionsExport;
use Maatwebsite\Excel\Facades\Excel;


class Transaction extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $transactions;
    public $transactionsId;
    public $newStatus;
    public $receiptNumber;
    public $paginate = 5;
    public $formVisible = false;


    public function render()
    {
        $transactionsPaginate = detail_transaction::with(['transaction.customer','product'])
        ->join('transactions', 'transactions.id', 'detail_transactions.transaction_id')
        ->join('customers', 'customers.id', 'transactions.customer_id')
        ->join('products', 'products.id', 'detail_transactions.product_id')
        ->select('customers.name as customer_name', 'detail_transactions.*','transactions.status', 'transactions.receipt_number', 'products.name as product_name', 'products.size as product_size')
        ->orderBy('detail_transactions.id', 'desc')->paginate($this->paginate);
        $offset = ($transactionsPaginate->currentPage() -1) * $this->paginate;
        return view('livewire.transaction.transaction', ['transactionsPaginate' => $transactionsPaginate, 'offset' => $offset])->layout('components.layouts.admin-layout');
    }

    public function allTransaction() {
        $this->transactions = detail_transaction::orderBy('id', 'desc')->paginate($this->paginate)->toArray();
    }


    public function viewStatus($transactionId) {

        $this->formVisible = true;
        $currentStatus = detail_transaction::find($transactionId);
        $this->newStatus = $currentStatus->transaction->status;
        $this->receiptNumber = $currentStatus->transaction->receipt_number;
        $this->transactionsId = $transactionId;
    }


    public function update() {

        $updateStatus = detail_transaction::find($this->transactionsId);
        if (empty($this->newStatus)) {
            return;
        }
        $updateStatus->transaction->update([
            'status' => $this->newStatus,
            'receipt_number' => $this->receiptNumber
        ]);

        $this->allTransaction();
        session()->flash('updateStatus', 'Transaction status has been updated');

    }

    public function export()
    {
        return Excel::download(new TransactionsExport, 'transactions.xlsx');
    }
}
