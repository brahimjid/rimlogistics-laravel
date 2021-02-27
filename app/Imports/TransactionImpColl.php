<?php


namespace App\Imports;


use App\State;
use App\Transaction;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;

class TransactionImpColl implements ToCollection
{
    public function collection(Collection $rows)
    {

        DB::table('transactions')->truncate();
        foreach ($rows as $row=>$val)
        {


    if ($row>0){

        DB::table('transactions')->insert(
            [

                  "state_id"=>State::getId(substr(trim($val[4],' '),-2))->id,
                  "driver_id"=>empty($val[10])?0:$val[10],
                  "quantity"=>$val[11],
                  "card_num"=>$val[0],
            ]);
    }

        }

    }
}
