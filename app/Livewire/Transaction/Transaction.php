<?php

namespace App\Livewire\Transaction;

use App\Models\detail_transaction;
use App\Models\Transaction as ModelsTransaction;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Transaction extends Component
{

    public $transactions;
    public $transactionsId;
    public $newStatus;
    public $formVisible = false;


    public function render()
    {
        return view('livewire.transaction.transaction')->layout('components.layouts.admin-layout');
    }


    public function allTransaction() {
        $this->transactions = detail_transaction::all();
    }


    public function mount() {

        $this->allTransaction();
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
