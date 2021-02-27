<?php

namespace App\Imports;

use App\Pas;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class PasImport implements ToCollection
{
    /**

     *
     */

    public function collection(Collection $rows)
    {
        foreach ($rows as $row=>$val) {
            if ($row>0){
                DB::table('pass')->insert(
                    [
                        "driver_id"=>$val[0],
                        "toll"=>($val[1]),

                    ]);
            }

//            User::create([
//                'name' => $row[0],
//            ]);
        }
    }
}
