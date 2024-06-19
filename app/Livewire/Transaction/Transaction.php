<?php

namespace App\Livewire\Transaction;

use App\Models\detail_transaction;
use Livewire\WithPagination;
use Livewire\Component;


class Transaction extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $transactions;
    public $transactionsId;
    public $newStatus;
    public $formVisible = false;


    public function render()
    {
        $transactionsPaginate = detail_transaction::paginate(5);
        return view('livewire.transaction.transaction', ['transactionsPaginate' => $transactionsPaginate])->layout('components.layouts.admin-layout');
    }


    public function allTransaction() {
        $this->transactions = detail_transaction::paginate(5);
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
}
