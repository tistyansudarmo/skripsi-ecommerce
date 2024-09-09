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
    public $paginate = 5;
    public $formVisible = false;


    public function render()
    {
        $transactionsPaginate = detail_transaction::orderBy('id', 'desc')->paginate($this->paginate);
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
        $this->transactionsId = $transactionId;
    }


    public function update() {

        $updateStatus = detail_transaction::find($this->transactionsId);
        if (empty($this->newStatus)) {
            return;
        }
        $updateStatus->transaction->update([
            'status' => $this->newStatus
        ]);

        $this->allTransaction();
        session()->flash('updateStatus', 'Transaction status has been updated');

    }

    public function export()
    {
        return Excel::download(new TransactionsExport, 'transactions.xlsx');
    }
}
