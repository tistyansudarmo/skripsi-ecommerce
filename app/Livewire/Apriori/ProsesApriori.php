<?php

namespace App\Livewire\Apriori;

use App\Imports\TransactionImport;
use Livewire\Component;
use Livewire\Attributes\Rule;
use App\Models\ProsesApriori as ModelsProsesApriori;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\WithFileUploads;


class ProsesApriori extends Component
{
    use WithFileUploads;

    public $itemset1;
    public $itemSupport;
    #[Rule('required')]
    public $minSupport;
    #[Rule('required')]
    public $minConfidence;
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
    public $associations = [];
    #[Rule('required|file|mimes:xlsx,xls,csv')]
    public $importTransaction;


    public function generateItemset1() {
        // Mendapatkan daftar produk unik yang ada dalam transaksi antara tanggal yang diberikan
        $this->itemset1 = ModelsProsesApriori::whereBetween('created_at', [$this->fromDate, $this->toDate])
            ->select('product')
            ->distinct()
            ->get();

        // Menghitung jumlah produk unik dalam transaksi antara tanggal yang diberikan
        $this->totalItem = ModelsProsesApriori::whereBetween('created_at', [$this->fromDate, $this->toDate])
            ->distinct('product')
            ->count();

        // Menghitung jumlah transaksi unik dan support untuk setiap produk
        foreach($this->itemset1 as $item) {
            // Menghitung jumlah transaksi unik yang melibatkan produk tertentu dalam rentang tanggal yang diberikan
            $itemCount = ModelsProsesApriori::where('product', $item->product)
                ->whereBetween('created_at', [$this->fromDate, $this->toDate])
                ->distinct('transaction_id')
                ->count('transaction_id');

            // Menyimpan jumlah transaksi unik untuk setiap produk ke dalam array
            $this->totalTransactionItemset1[$item->product] = $itemCount;

            // Menghitung support untuk setiap produk
            $support = $itemCount / $this->totalItem;

            // Menyimpan nilai support untuk setiap produk ke dalam array
            $this->itemSupport[$item->product] = $support;
        }
    }


    public function generateItemset2() {
        // Array untuk menampung kandidat itemset 2
        $candidateItemsets2 = [];

        // Daftar item yang lolos pada Itemset 1
        $passedItemset1 = [];
        foreach ($this->itemset1 as $item1) {
            // Memeriksa apakah item dari Itemset 1 memenuhi syarat minimum support
            if ($this->itemSupport[$item1->product] >= $this->minSupport) {
                // Jika ya, tambahkan product_id ke daftar passedItemset1
                $passedItemset1[] = $item1->product;
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
            $this->totalTransactionItemset2 = DB::table('proses_aprioris as proses1')
            ->join('proses_aprioris as proses2', 'proses1.transaction_id', '=', 'proses2.transaction_id')
            ->where('proses1.product', $candidateItemset[0])
            ->where('proses2.product', $candidateItemset[1])
            ->count();

            // Menghitung support dari itemset 2
            $support = $this->totalTransactionItemset2 / $this->totalItem;

            // Mengambil name (nama) dari produk di dalam itemset
            $itemset1 = $candidateItemset[0];
            $itemset2 = $candidateItemset[1];

            // Menyimpan hasil perhitungan ke dalam array itemsets2
            $this->itemsets2[] = [
                'itemset1' => $itemset1,  // Menyimpan judul produk pertama
                'itemset2' => $itemset2,  // Menyimpan judul produk kedua
                'transaksi' => $this->totalTransactionItemset2, // Menyimpan hasil perhitungan transaksi
                'support' => $support,    // Menyimpan nilai support
                'product' => $candidateItemset,
            ];

        }
    }

    public function generateItemset3() {
        // Menggabungkan Itemsets 2 dengan item yang tersisa untuk menghasilkan kandidat Itemsets 3
        $candidateItemsets3 = [];
        foreach ($this->itemsets2 as $itemset2) {
            foreach ($this->itemset1 as $item1) {
                if (!in_array($item1->product, $itemset2['product'])) {
                    $newItemset = array_merge($itemset2['product'], [$item1->product]);
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
            $totalTransactionItemset3 = DB::table('proses_aprioris as proses1')
                ->join('proses_aprioris as proses2', 'proses1.transaction_id', '=', 'proses2.transaction_id')
                ->join('proses_aprioris as proses3', 'proses1.transaction_id', '=', 'proses3.transaction_id')
                ->where('proses1.product', $candidateItemset[0])
                ->where('proses2.product', $candidateItemset[1])
                ->where('proses3.product', $candidateItemset[2])
                ->count();

            $support = $totalTransactionItemset3 / $this->totalItem;
            if ($support >= $this->minSupport) {
                $this->itemsets3[] = [
                    'itemset1' => $candidateItemset[0],
                    'itemset2' => $candidateItemset[1],
                    'itemset3' => $candidateItemset[2],
                    'transaksi' => $totalTransactionItemset3,
                    'support' => $support
                ];
            }
        }
    }

    public function generateAssociationRulesFromItemset3()
{
    $this->associations = [];

    // Pastikan kita memiliki itemsets3 yang lolos seleksi
    if (empty($this->itemsets3)) {
        return; // Keluar jika itemsets3 kosong
    }

    // Loop melalui setiap itemset di itemsets3
    foreach ($this->itemsets3 as $itemset) {
        // Mendefinisikan item-item dari itemset3
        $item1 = $itemset['itemset1'];
        $item2 = $itemset['itemset2'];
        $item3 = $itemset['itemset3'];

        // Menghitung jumlah transaksi
        $countItemset1 = DB::table('proses_aprioris')
            ->where('product', $item1)
            ->count();

        $countItemset2 = DB::table('proses_aprioris')
            ->where('product', $item2)
            ->count();

        $countItemset3 = DB::table('proses_aprioris')
            ->where('product', $item3)
            ->count();

        $countItemset1Itemset2 = DB::table('proses_aprioris as proses1')
            ->join('proses_aprioris as proses2', 'proses1.transaction_id', '=', 'proses2.transaction_id')
            ->where('proses1.product', $item1)
            ->where('proses2.product', $item2)
            ->count();

        $countItemset1Itemset3 = DB::table('proses_aprioris as proses1')
            ->join('proses_aprioris as proses2', 'proses1.transaction_id', '=', 'proses2.transaction_id')
            ->where('proses1.product', $item1)
            ->where('proses2.product', $item3)
            ->count();

        $countItemset2Itemset3 = DB::table('proses_aprioris as proses2')
            ->join('proses_aprioris as proses3', 'proses2.transaction_id', '=', 'proses3.transaction_id')
            ->where('proses2.product', $item2)
            ->where('proses3.product', $item3)
            ->count();

        $countItemset123 = DB::table('proses_aprioris as proses1')
            ->join('proses_aprioris as proses2', 'proses1.transaction_id', '=', 'proses2.transaction_id')
            ->join('proses_aprioris as proses3', 'proses1.transaction_id', '=', 'proses3.transaction_id')
            ->where('proses1.product', $item1)
            ->where('proses2.product', $item2)
            ->where('proses3.product', $item3)
            ->count();


        // Menghitung confidence untuk setiap aturan
        $confidence1 = $countItemset1Itemset2 / $countItemset1;
        $confidence2 = $countItemset1Itemset2 / $countItemset2;
        $confidence3 = $countItemset1Itemset3 / $countItemset1;
        $confidence4 = $countItemset1Itemset3 / $countItemset3;
        $confidence5 = $countItemset2Itemset3 / $countItemset2;
        $confidence6 = $countItemset2Itemset3 / $countItemset3;

        // Tambahkan asosiasi dengan confidence
        $this->associations[] = ['rule' => "$item1 -> $item2", 'confidence' => $confidence1, 'conclusion' => "Jika pelanggan membeli $item1, maka pelanggan juga akan membeli $item2."];
        $this->associations[] = ['rule' => "$item2 -> $item1", 'confidence' => $confidence2, 'conclusion' => "Jika pelanggan membeli $item2, maka pelanggan juga akan membeli $item1."];
        $this->associations[] = ['rule' => "$item1 -> $item3", 'confidence' => $confidence3, 'conclusion' => "Jika pelanggan membeli $item1, maka pelanggan juga akan membeli $item3."];
        $this->associations[] = ['rule' => "$item3 -> $item1", 'confidence' => $confidence4, 'conclusion' => "Jika pelanggan membeli $item3, maka pelanggan juga akan membeli $item1."];
        $this->associations[] = ['rule' => "$item2 -> $item3", 'confidence' => $confidence5, 'conclusion' => "Jika pelanggan membeli $item2, maka pelanggan juga akan membeli $item3."];
        $this->associations[] = ['rule' => "$item3 -> $item2", 'confidence' => $confidence6, 'conclusion' => "Jika pelanggan membeli $item3, maka pelanggan juga akan membeli $item2."];
        $this->associations[] = ['rule' => "$item1, $item2 -> $item3", 'confidence' => $countItemset123 / $countItemset1Itemset2, 'conclusion' => "Jika pelanggan membeli $item1 dan $item2, maka pelanggan juga akan membeli $item3."];
        $this->associations[] = ['rule' => "$item1, $item3 -> $item2", 'confidence' => $countItemset123 / $countItemset1Itemset3, 'conclusion' => "Jika pelanggan membeli $item1 dan $item3, maka pelanggan juga akan membeli $item2."];
        $this->associations[] = ['rule' => "$item2, $item3 -> $item1", 'confidence' => $countItemset123 / $countItemset2Itemset3, 'conclusion' => "Jika pelanggan membeli $item2 dan $item3, maka pelanggan juga akan membeli $item1."];
    }
}

    public function mount() {
        $this->generateItemset1();
        $this->generateItemset2();
        $this->generateItemset3();
        $this->generateAssociationRulesFromItemset3();
    }

    public function save() {
        $this->validate();
        $this->import();
        $this->generateItemset1();
        $this->generateItemset2();
        $this->generateItemset3();
        $this->generateAssociationRulesFromItemset3();
        $this->formVisible = false;
    }

    public function back() {
        $this->formVisible = true;
        $this->reset(['minSupport','minConfidence']);
        ModelsProsesApriori::truncate();
    }

    public function import()
    {
        Excel::import(new TransactionImport, $this->importTransaction);
    }


    public function render()
    {
        return view('livewire.apriori.proses-apriori')->layout('components.layouts.admin-layout');
    }
}


