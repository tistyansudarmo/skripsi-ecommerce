<?php

namespace App\Imports;

use App\Models\ProsesApriori;
use Maatwebsite\Excel\Concerns\ToModel;

class TransactionImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new ProsesApriori([
           'transaction_id' => $row[0],
           'customer' => $row[1],
           'product' => $row[2],
           'size' => $row[3],
           'price' => $row[4],
           'created_at' => $row[5]
        ]);
    }
}
