<?php

namespace App\Livewire\Apriori;

use App\Models\detail_transaction;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\Rule;

class ProsesApriori extends Component
{
    public $itemset1;
    public $itemSupport;
    #[Rule('required')]
    public $minSupport;
    public $confident;
    public $jumlahTransaksi;
    public $jumlahItem;
    public $fromDate;
    public $toDate;
    public $formVisible = true;

    // Itemset 2 variables
    public $itemset2 = [];
    public $itemset2Support = [];

    public function generateItemset1() {

        $this->itemset1 = detail_transaction::whereBetween('date', [$this->fromDate, $this->toDate])->get();

        $this->jumlahItem = detail_transaction::distinct('product_id')->count();

        foreach($this->itemset1 as $items) {
            $itemCount = detail_transaction::where('product_id', $items->id)
                ->distinct('transaction_id')
                ->count('transaction_id');

            $this->jumlahTransaksi[$items->id] = $itemCount;
            $support = $itemCount / $this->jumlahItem * 100;
            $this->itemSupport[$items->id] = $support;
        }
    }

    public function mount() {
        $this->generateItemset1();
    }

    public function save() {
        $this->validate();
        $this->generateItemset1();
        $this->formVisible = false;
    }

    public function back() {
        $this->formVisible = true;
        $this->reset('minSupport');
    }

    public function generateItemset2() {

    }

    public function render()
    {
        return view('livewire.apriori.proses-apriori')->layout('components.layouts.admin-layout');
    }
}


