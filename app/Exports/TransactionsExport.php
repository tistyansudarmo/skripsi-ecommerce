<?php

namespace App\Exports;

use App\Models\detail_transaction;
use Maatwebsite\Excel\Concerns\FromCollection;

class TransactionsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return detail_transaction::join('products', 'detail_transactions.product_id', '=', 'products.id')
                                    ->join('transactions', 'transactions.id', '=', 'detail_transactions.transaction_id')
                                    ->join('costumers', 'costumers.id', '=', 'transactions.user_id')
                                    ->select('detail_transactions.transaction_id','costumers.name', 'products.name', 'detail_transactions.quantity', 'detail_transactions.price', 'detail_transactions.date')
                                    ->get();
    }
}
