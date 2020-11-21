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
                   // dd($rows);
                  // dump(State::getId($val[1])->id);
                    //echo(substr($val[4],-2)) ." ";
                    DB::table('iftas')->insert(
                        [
                            // driver_id	state_id	distance

                            "driver_id"=>$val[0],
                            "state_id"=>State::getId($val[1])->id,
                            "distance"=>$val[2],


                        ]);
                }
            }

        }

}
