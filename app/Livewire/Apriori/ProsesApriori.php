<?php

namespace App\Livewire\Apriori;

use App\Imports\TransactionImport;
use App\Models\detail_transaction;
use Livewire\Component;
use Livewire\Attributes\Rule;
use App\Models\ProsesApriori as ModelsProsesApriori;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\WithFileUploads;
use App\Models\Product;


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
    // #[Rule('required|file|mimes:xlsx,xls,csv')]
    // public $importTransaction;


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
            $this->itemSupport[$item->product_id] = number_format($support,2);
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
            $this->totalTransactionItemset2 = DB::table('detail_transactions as proses1')
            ->join('detail_transactions as proses2', 'proses1.transaction_id', '=', 'proses2.transaction_id')
            ->where('proses1.product_id', $candidateItemset[0])
            ->where('proses2.product_id', $candidateItemset[1])
            ->count();

            // Menghitung support dari itemset 2
            $support = $this->totalTransactionItemset2 / $this->totalItem;

            // Mengambil name (nama) dari produk di dalam itemset
            $itemset1 = isset($candidateItemset[0]) ? Product::find($candidateItemset[0])->name : '';
            $itemset2 = isset($candidateItemset[1]) ? Product::find($candidateItemset[1])->name : '';

            // Menyimpan hasil perhitungan ke dalam array itemsets2
            $this->itemsets2[] = [
                'itemset1' => $itemset1,  // Menyimpan judul produk pertama
                'itemset2' => $itemset2,  // Menyimpan judul produk kedua
                'transaksi' => $this->totalTransactionItemset2, // Menyimpan hasil perhitungan transaksi
                'support' => number_format($support,2),    // Menyimpan nilai support
                'product' => $candidateItemset,
            ];

        }
    }

    public function generateItemset3() {
        // Array untuk menampung kandidat itemset 3
        $candidateItemsets3 = [];

        // Daftar itemset 2 yang lolos
        $passedItemset2 = [];
        foreach ($this->itemsets2 as $itemset2) {
            // Memeriksa apakah item dari Itemset 2 memenuhi syarat minimum support
            if ($itemset2['support'] >= $this->minSupport) {
                // Jika ya, tambahkan pasangan item dari itemset2 ke daftar passedItemset2
                $passedItemset2[] = $itemset2['product'];
            }
        }

        // Membentuk kandidat itemset 3 dari itemset 2 yang lolos
        for ($i = 0; $i < count($passedItemset2) - 1; $i++) {
            for ($j = $i + 1; $j < count($passedItemset2); $j++) {
                // Membentuk kandidat itemset 3 hanya jika dua item pertama cocok
                if ($passedItemset2[$i][0] == $passedItemset2[$j][0]) {
                    // Membentuk kombinasi itemset 3
                    $candidateItemsets3[] = [
                        $passedItemset2[$i][0], // Item pertama sama dari kedua itemset 2
                        $passedItemset2[$i][1], // Item kedua dari itemset 2 pertama
                        $passedItemset2[$j][1]  // Item kedua dari itemset 2 kedua
                    ];
                }
            }
        }

        // Array untuk menampung hasil akhir itemset 3 yang sudah dihitung
        $this->itemsets3 = [];

        // Loop untuk setiap kandidat itemset 3 yang terbentuk
        foreach ($candidateItemsets3 as $candidateItemset) {
            // Menghitung jumlah transaksi yang mengandung ketiga item tersebut
            $this->totalTransactionItemset3 = DB::table('detail_transactions as proses1')
                ->join('detail_transactions as proses2', 'proses1.transaction_id', '=', 'proses2.transaction_id')
                ->join('detail_transactions as proses3', 'proses1.transaction_id', '=', 'proses3.transaction_id')
                ->where('proses1.product_id', $candidateItemset[0])
                ->where('proses2.product_id', $candidateItemset[1])
                ->where('proses3.product_id', $candidateItemset[2])
                ->count();

            // Menghitung support dari itemset 3
            $support = $this->totalTransactionItemset3 / $this->totalItem;

            // Mengambil nama produk dari itemset
            $itemset1 = isset($candidateItemset[0]) ? Product::find($candidateItemset[0])->name : '';
            $itemset2 = isset($candidateItemset[1]) ? Product::find($candidateItemset[1])->name : '';
            $itemset3 = isset($candidateItemset[2]) ? Product::find($candidateItemset[2])->name : '';

            // Menyimpan hasil perhitungan ke dalam array itemsets3
            $this->itemsets3[] = [
                'itemset1' => $itemset1,  // Menyimpan judul produk pertama
                'itemset2' => $itemset2,  // Menyimpan judul produk kedua
                'itemset3' => $itemset3,  // Menyimpan judul produk ketiga
                'transaksi' => $this->totalTransactionItemset3, // Menyimpan hasil perhitungan transaksi
                'support' => number_format($support, 2),    // Menyimpan nilai support
                'product' => $candidateItemset, // Menyimpan kombinasi itemset
                'idItemset1' => $candidateItemset[0],
                'idItemset2' => $candidateItemset[1],
                'idItemset3' => $candidateItemset[2]
            ];
        }
    }


    public function generateAssociationRulesFromItemset3() {
    $this->associations = [];

    // Pastikan kita memiliki itemsets3 yang lolos seleksi
    if (empty($this->itemsets3)) {
        return; // Keluar jika itemsets3 kosong
    }

    // Loop melalui setiap itemset di itemsets3
    foreach ($this->itemsets3 as $itemset) {
        if($itemset['support'] >= $this->minSupport) {
        // Mendefinisikan item-item dari itemset3
        $item1 = $itemset['idItemset1'];
        $item2 = $itemset['idItemset2'];
        $item3 = $itemset['idItemset3'];

        // Menghitung jumlah transaksi
        $countItemset1 = DB::table('detail_transactions')
            ->where('product_id', $item1)
            ->count();

        $countItemset2 = DB::table('detail_transactions')
            ->where('product_id', $item2)
            ->count();

        $countItemset3 = DB::table('detail_transactions')
            ->where('product_id', $item3)
            ->count();

        $countItemset1Itemset2 = DB::table('detail_transactions as proses1')
            ->join('detail_transactions as proses2', 'proses1.transaction_id', '=', 'proses2.transaction_id')
            ->where('proses1.product_id', $item1)
            ->where('proses2.product_id', $item2)
            ->count();

        $countItemset1Itemset3 = DB::table('detail_transactions as proses1')
            ->join('detail_transactions as proses2', 'proses1.transaction_id', '=', 'proses2.transaction_id')
            ->where('proses1.product_id', $item1)
            ->where('proses2.product_id', $item3)
            ->count();

        $countItemset2Itemset3 = DB::table('detail_transactions as proses2')
            ->join('detail_transactions as proses3', 'proses2.transaction_id', '=', 'proses3.transaction_id')
            ->where('proses2.product_id', $item2)
            ->where('proses3.product_id', $item3)
            ->count();

        $countItemset123 = DB::table('detail_transactions as proses1')
            ->join('detail_transactions as proses2', 'proses1.transaction_id', '=', 'proses2.transaction_id')
            ->join('detail_transactions as proses3', 'proses1.transaction_id', '=', 'proses3.transaction_id')
            ->where('proses1.product_id', $item1)
            ->where('proses2.product_id', $item2)
            ->where('proses3.product_id', $item3)
            ->count();


        // Menghitung confidence untuk setiap aturan
        $confidence1 = $countItemset1Itemset2 / $countItemset1;
        $confidence2 = $countItemset1Itemset2 / $countItemset2;
        $confidence3 = $countItemset1Itemset3 / $countItemset1;
        $confidence4 = $countItemset1Itemset3 / $countItemset3;
        $confidence5 = $countItemset2Itemset3 / $countItemset2;
        $confidence6 = $countItemset2Itemset3 / $countItemset3;

        $item1name = isset($itemset['idItemset1']) ? Product::find($itemset['idItemset1'])->name : '';
        $item2name = isset($itemset['idItemset2']) ? Product::find($itemset['idItemset2'])->name : '';
        $item3name = isset($itemset['idItemset3']) ? Product::find($itemset['idItemset3'])->name : '';

        // Tambahkan asosiasi dengan confidence
        $this->associations[] = ['rule' => "$item1name -> $item2name", 'confidence' => $confidence1, 'conclusion' => "Jika pelanggan membeli $item1name, maka pelanggan juga akan membeli $item2name."];
        $this->associations[] = ['rule' => "$item2name -> $item1name", 'confidence' => $confidence2, 'conclusion' => "Jika pelanggan membeli $item2name, maka pelanggan juga akan membeli $item1name."];
        $this->associations[] = ['rule' => "$item1name -> $item3name", 'confidence' => $confidence3, 'conclusion' => "Jika pelanggan membeli $item1name, maka pelanggan juga akan membeli $item3name."];
        $this->associations[] = ['rule' => "$item3name -> $item1name", 'confidence' => $confidence4, 'conclusion' => "Jika pelanggan membeli $item3name, maka pelanggan juga akan membeli $item1name."];
        $this->associations[] = ['rule' => "$item2name -> $item3name", 'confidence' => $confidence5, 'conclusion' => "Jika pelanggan membeli $item2name, maka pelanggan juga akan membeli $item3name."];
        $this->associations[] = ['rule' => "$item3name -> $item2name", 'confidence' => $confidence6, 'conclusion' => "Jika pelanggan membeli $item3name, maka pelanggan juga akan membeli $item2name."];
        $this->associations[] = ['rule' => "$item1name, $item2name -> $item3name", 'confidence' => $countItemset123 / $countItemset1Itemset2, 'conclusion' => "Jika pelanggan membeli $item1name dan $item2name, maka pelanggan juga akan membeli $item3name."];
        $this->associations[] = ['rule' => "$item1name, $item3name -> $item2name", 'confidence' => $countItemset123 / $countItemset1Itemset3, 'conclusion' => "Jika pelanggan membeli $item1name dan $item3name, maka pelanggan juga akan membeli $item2name."];
        $this->associations[] = ['rule' => "$item2name, $item3name -> $item1name", 'confidence' => $countItemset123 / $countItemset2Itemset3, 'conclusion' => "Jika pelanggan membeli $item2name dan $item3name, maka pelanggan juga akan membeli $item1name."];
    }
}

    foreach ($this->associations as $association) {
        // Ambil conclusion dan pisahkan berdasarkan kata
        $conclusion = $association['conclusion'];

        if (preg_match('/membeli (.+?) dan (.+?), maka pelanggan juga akan membeli (.+)\./', $conclusion, $matches)) {
            # code...
        if (isset($matches[1]) && isset($matches[2]) && isset($matches[3])) {
            $item1 = $matches[1]; // Produk pertama
            $item2 = $matches[2]; // Produk kedua
            $item3 = $matches[3]; // Produk ketiga

            // Cari produk berdasarkan nama
            $product1 = Product::where('name', $item1)->first();
            $product2 = Product::where('name', $item2)->first();
            $product3 = Product::where('name', $item3)->first();

            // Pastikan produk ditemukan
            if ($product1 && $product2 && $product3 && number_format($association['confidence'], 2) >= $this->minConfidence) {
                // Simpan ke dalam database
                DB::table('product_recommendations')->insert([
                    'product1_id' => $product1->id,
                    'product2_id' => $product2->id,
                    'product3_id' => $product3->id,
                    'product1_name' => $product1->name,
                    'product2_name' => $product2->name,
                    'product3_name' => $product3->name,
                    'conclusion' => $association['conclusion'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
        } elseif (preg_match('/membeli (.+?), maka pelanggan juga akan membeli (.+)\./', $conclusion, $matches)) {
            # code...
            if (isset($matches[1]) && isset($matches[2])) {
                $item1 = $matches[1]; // Produk pertama
                $item2 = $matches[2]; // Produk kedua

                // Cari produk berdasarkan nama
                $product1 = Product::where('name', $item1)->first();
                $product2 = Product::where('name', $item2)->first();

                // Pastikan produk ditemukan
                if ($product1 && $product2 && number_format($association['confidence'], 2) >= $this->minConfidence) {
                    // Simpan ke dalam database
                    DB::table('product_recommendations')->insert([
                        'product1_id' => $product1->id,
                        'product2_id' => $product2->id,
                        'product3_id' => null,
                        'product1_name' => $product1->name,
                        'product2_name' => $product2->name,
                        'product3_name' => null,
                        'conclusion' => $association['conclusion'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
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
        // $this->import();
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

    // public function import()
    // {
    //     Excel::import(new TransactionImport, $this->importTransaction);
    // }


    public function render()
    {
        return view('livewire.apriori.proses-apriori')->layout('components.layouts.admin-layout');
    }
}


