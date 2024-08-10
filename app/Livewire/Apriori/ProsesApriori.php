<?php

namespace App\Livewire\Apriori;

use App\Models\detail_transaction;
use Livewire\Component;
use Livewire\Attributes\Rule;
use App\Models\Product;


class ProsesApriori extends Component
{
    public $itemset1;
    public $itemSupport;
    #[Rule('required')]
    public $minSupport;
    public $confident;
    public $totalTransactionItemset1;
    public $totalTransactionItemset2;
    public $totalItem;
    public $fromDate;
    public $toDate;
    public $formVisible = true;
    public $itemsets2;
    public $frequentItemsets2 = [];
    public $itemset2Support = [];


    public function generateItemset1() {
        // Mendapatkan daftar produk unik yang ada dalam transaksi antara tanggal yang diberikan
        $this->itemset1 = detail_transaction::whereBetween('date', [$this->fromDate, $this->toDate])
            ->select('product_id')
            ->distinct()
            ->get();

        // Menghitung jumlah produk unik dalam transaksi antara tanggal yang diberikan
        $this->totalItem = detail_transaction::whereBetween('date', [$this->fromDate, $this->toDate])
            ->distinct('product_id')
            ->count();

        // Menghitung jumlah transaksi unik dan support untuk setiap produk
        foreach($this->itemset1 as $item) {
            // Menghitung jumlah transaksi unik yang melibatkan produk tertentu dalam rentang tanggal yang diberikan
            $itemCount = detail_transaction::where('product_id', $item->product_id)
                ->whereBetween('date', [$this->fromDate, $this->toDate])
                ->distinct('transaction_id')
                ->count('transaction_id');

            // Menyimpan jumlah transaksi unik untuk setiap produk ke dalam array
            $this->totalTransactionItemset1[$item->product_id] = $itemCount;

            // Menghitung support untuk setiap produk
            $support = $itemCount / $this->totalItem;

            // Menyimpan nilai support untuk setiap produk ke dalam array
            $this->itemSupport[$item->product_id] = $support;
        }
    }


    public function generateItemset2() {
        // Array untuk menampung kandidat itemset 2
        $candidateItemsets2 = [];

        // Daftar item yang lolos pada Itemset 1
        $passedItemset1 = [];
        foreach ($this->itemset1 as $item1) {
            // Memeriksa apakah item dari Itemset 1 memenuhi syarat minimum support
            if ($this->itemSupport[$item1->product_id] >= $this->minSupport) {
                // Jika ya, tambahkan product_id ke daftar passedItemset1
                $passedItemset1[] = $item1->product_id;
            }
        }

        // Membuat kandidat itemset 2 hanya dari item yang lolos di itemset 1
        for ($i = 0; $i < count($passedItemset1) - 1; $i++) {
            for ($j = $i + 1; $j < count($passedItemset1); $j++) {
                // Membentuk pasangan item dari daftar passedItemset1
                $candidateItemsets2[] = [$passedItemset1[$i], $passedItemset1[$j]];
            }
        }

        // Array untuk menampung hasil akhir itemset 2 yang sudah dihitung
        $this->itemsets2 = [];

        // Loop untuk setiap kandidat itemset 2 yang terbentuk
        foreach ($candidateItemsets2 as $candidateItemset) {
            // Menghitung jumlah transaksi yang mengandung pasangan item tersebut
            $this->totalTransactionItemset2 = detail_transaction::whereHas('product', function ($query) use ($candidateItemset) {
                $query->whereIn('product_id', $candidateItemset);
            })
            ->distinct('transaction_id')
            ->count('transaction_id');

            // Menghitung support dari itemset 2
            $support = $this->totalTransactionItemset2 / $this->totalItem;

            // Mengambil judul (title) dari produk di dalam itemset
            $itemset1 = isset($candidateItemset[0]) ? Product::find($candidateItemset[0])->title : '';
            $itemset2 = isset($candidateItemset[1]) ? Product::find($candidateItemset[1])->title : '';

            // Menyimpan hasil perhitungan ke dalam array itemsets2
            $this->itemsets2[] = [
                'itemset1' => $itemset1,  // Menyimpan judul produk pertama
                'itemset2' => $itemset2,  // Menyimpan judul produk kedua
                'transaksi' => $this->totalTransactionItemset2, // Menyimpan hasil perhitungan transaksi
                'support' => $support    // Menyimpan nilai support
            ];
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


