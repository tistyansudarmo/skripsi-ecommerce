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
                                    ->join('customers', 'customers.id', '=', 'transactions.customer_id')
                                    ->select(
                                        'detail_transactions.transaction_id',
                                        'customers.name as customer_name', // Alias untuk nama customer
                                        'products.name as product_name',   // Alias untuk nama produk
                                        'products.size',
                                        'detail_transactions.price',
                                        'detail_transactions.date'
                                    )
                                    ->get();
    }
}
