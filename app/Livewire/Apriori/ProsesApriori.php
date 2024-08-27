<?php

namespace App\Livewire\Apriori;

use App\Models\detail_transaction;
use Livewire\Component;
use Livewire\Attributes\Rule;
use App\Models\Product;
use Illuminate\Support\Facades\DB;


class ProsesApriori extends Component
{
    public $itemset1;
    public $itemSupport;
    #[Rule('required')]
    public $minSupport;
    public $confident;
    public $totalTransactionItemset1;
    public $totalTransactionItemset2;
    public $totalTransactionItemset3;
    public $totalItem;
    public $fromDate;
    public $toDate;
    public $formVisible = true;
    public $itemsets2;
    public $itemsets3;
    public $passedItems;



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
            $this->totalTransactionItemset2 = DB::table('detail_transactions as dt1')
            ->join('detail_transactions as dt2', 'dt1.transaction_id', '=', 'dt2.transaction_id')
            ->where('dt1.product_id', $candidateItemset[0])
            ->where('dt2.product_id', $candidateItemset[1])
            ->count();

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
                'support' => $support,    // Menyimpan nilai support
                'product_id' => $candidateItemset,
            ];

        }
    }

    public function generateItemset3() {
        // Menggabungkan Itemsets 2 dengan item yang tersisa untuk menghasilkan kandidat Itemsets 3
        $candidateItemsets3 = [];
        foreach ($this->itemsets2 as $itemset2) {
            foreach ($this->itemset1 as $item1) {
                if (!in_array($item1->product_id, $itemset2['product_id'])) {
                    $newItemset = array_merge($itemset2['product_id'], [$item1->product_id]);
                    sort($newItemset);
                    $candidateItemsets3[] = $newItemset;
                }
            }
        }

        // Menghapus duplikat kandidat Itemsets 3
        $candidateItemsets3 = array_unique($candidateItemsets3, SORT_REGULAR);

        // Filter kandidat Itemsets 3 berdasarkan nilai support dan tambahkan ke Itemset 3 yang final
        $this->itemsets3 = [];
        foreach ($candidateItemsets3 as $candidateItemset) {
            $totalTransactionItemset3 = DB::table('detail_transactions as dt1')
                ->join('detail_transactions as dt2', 'dt1.transaction_id', '=', 'dt2.transaction_id')
                ->join('detail_transactions as dt3', 'dt1.transaction_id', '=', 'dt3.transaction_id')
                ->where('dt1.product_id', $candidateItemset[0])
                ->where('dt2.product_id', $candidateItemset[1])
                ->where('dt3.product_id', $candidateItemset[2])
                ->count();

            $support = $totalTransactionItemset3 / $this->totalItem;
            if ($support >= $this->minSupport) {
                $this->itemsets3[] = [
                    'itemset1' => Product::find($candidateItemset[0])->title,
                    'itemset2' => Product::find($candidateItemset[1])->title,
                    'itemset3' => Product::find($candidateItemset[2])->title,
                    'transaksi' => $totalTransactionItemset3,
                    'support' => $support
                ];
            }
        }
    }

    public function mount() {
        $this->generateItemset1();
        $this->generateItemset2();
        $this->generateItemset3();
    }

    public function save() {
        $this->validate();
        $this->generateItemset1();
        $this->generateItemset2();
        $this->generateItemset3();
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


