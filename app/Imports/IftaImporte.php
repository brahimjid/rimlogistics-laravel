<?php


namespace App\Imports;


use App\Ifta;
use App\State;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;

class IftaImporte  implements ToCollection
{

    public function collection(Collection $rows)
    {
        DB::table('iftas')->truncate();

        foreach ($rows as $row=>$val)
            {


                if ($row>0){

                    DB::table('iftas')->insert(
                        [
                            "driver_id"=>$val[1],
                            "state_id"=>State::getId($val[2])->id,
                            "distance"=>$val[3],

                        ]);
                }
            }

        }

}
