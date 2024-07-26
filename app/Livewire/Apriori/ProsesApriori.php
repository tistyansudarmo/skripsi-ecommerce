<?php

namespace App\Livewire\Apriori;

use App\Models\detail_transaction;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\DB;

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

    public $frequentItemsets2 = [];
    public $itemset2Support = [];

    public function generateItemset1() {
        // Mendapatkan transaksi antara tanggal yang diberikan dan mengelompokkan berdasarkan produk
        $this->itemset1 = detail_transaction::whereBetween('date', [$this->fromDate, $this->toDate])
            ->select('product_id')
            ->distinct()
            ->get();

        // Menghitung jumlah produk unik
        $this->jumlahItem = detail_transaction::whereBetween('date', [$this->fromDate, $this->toDate])
            ->distinct('product_id')
            ->count();

        // Menghitung jumlah transaksi unik dan dukungan untuk setiap produk
        foreach($this->itemset1 as $item) {
            $itemCount = detail_transaction::where('product_id', $item->product_id)
                ->whereBetween('date', [$this->fromDate, $this->toDate])
                ->distinct('transaction_id')
                ->count('transaction_id');

            $this->jumlahTransaksi[$item->product_id] = $itemCount;
            $support = $itemCount / $this->jumlahItem;
            $this->itemSupport[$item->product_id] = $support;
        }
    }

    public function generateItemset2()
    {
        $candidateItemsets2 = [];

        // Daftar item yang lolos pada Itemset 1
        $passedItemset1 = [];
        foreach ($this->itemset1 as $item1) {
            if ($this->itemSupport[$item1->product_id] >= $this->minSupport) {
                $passedItemset1[] = $item1->product_id;
            }
        }

        // Membuat kandidat itemset 2 hanya dari item yang lolos di itemset 1
        for ($i = 0; $i < count($passedItemset1) - 1; $i++) {
            for ($j = $i + 1; $j < count($passedItemset1); $j++) {
                $candidateItemsets2[] = [$passedItemset1[$i], $passedItemset1[$j]];
            }
        }

        $this->frequentItemsets2 = [];
        $this->itemset2Support = [];

        foreach ($candidateItemsets2 as $candidateItemset) {
            $itemCount = detail_transaction::whereBetween('date', [$this->fromDate, $this->toDate])
                ->whereIn('product_id', $candidateItemset)
                ->distinct('transaction_id')
                ->count('transaction_id');

            $support = $itemCount / $this->jumlahItem;

            if ($support >= $this->minSupport) {
                $this->frequentItemsets2[] = $candidateItemset;
                $this->itemset2Support[] = $support;
            }
        }
    }




    public function mount() {
        $this->generateItemset1();
        $this->generateItemset2();
    }

    public function save() {
        $this->validate();
        $this->generateItemset1();
        $this->generateItemset2();
        $this->formVisible = false;
    }

    public function back() {
        $this->formVisible = true;
        $this->reset('minSupport');
    }


    public function render()
    {
        return view('livewire.apriori.proses-apriori')->layout('components.layouts.admin-layout');
    }
}


