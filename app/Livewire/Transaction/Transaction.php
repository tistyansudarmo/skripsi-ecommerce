<?php

namespace App\Livewire\Transaction;

use App\Livewire\Order\Index;
use App\Models\statusTransaction;
use App\Models\Transaction as ModelsTransaction;
use Livewire\Component;

class Transaction extends Component
{

    public $transactions;
    public $transactionsId;
    public $newStatus;
    public $status;
    public $formVisible = false;

    public function render()
    {
        return view('livewire.transaction.transaction')->layout('components.layouts.admin-layout');
    }


    public function allTransaction() {
        $this->transactions = ModelsTransaction::all();
    }


    public function mount() {

        $this->allTransaction();
        $this->status = statusTransaction::all();
    }

    public function viewStatus($transactionId) {

        $this->formVisible = true;
        $currentStatus = ModelsTransaction::find($transactionId);
        $this->newStatus = $currentStatus->status_id;
        $this->transactionsId = $transactionId;
    }


    public function update() {

        $updateStatus = ModelsTransaction::find($this->transactionsId);
        if (empty($this->newStatus)) {
            return;
        }
        $updateStatus->update([
            'status_id' => $this->newStatus
        ]);

        $this->allTransaction();
        session()->flash('updateStatus', 'Transaction status has been updated');

    }
}
