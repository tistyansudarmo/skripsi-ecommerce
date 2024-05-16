<?php

namespace App\Livewire\Apriori;

use App\Models\detail_transaction;
use Livewire\Component;
use Livewire\Attributes\Rule;

class ProsesApriori extends Component
{

    public $itemset1;
    #[Rule('required')]
    public $support;
    public $confident;
    public $jumlahTransaksi;
    public $formVisible = true;

    public function itemset1() {
        $this->itemset1 = detail_transaction::all();
        $this->jumlahTransaksi = $this->itemset1->count();
    }

    public function mount() {
        $this->itemset1();
    }

    public function proses() {
        $this->support;
    }

    public function back() {
        $this->formVisible = true;
        $this->reset('support');
    }


    public function render()
    {
        return view('livewire.apriori.proses-apriori')->layout('components.layouts.admin-layout');
    }
}
