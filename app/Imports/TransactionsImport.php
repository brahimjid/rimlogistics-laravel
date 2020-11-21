<?php

namespace App\Imports;

use App\Transaction;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;

class TransactionsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return Model|null
    */
    public function model(array $row)
    {

        return new Transaction([
            //'id',
            'Store_Location'    => $row[0],
            'Quantity'          => $row[1],
            'Driver_ID'         => $row[2],
        ]);
    }
}
