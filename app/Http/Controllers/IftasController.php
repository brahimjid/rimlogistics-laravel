<?php

namespace App\Http\Controllers;

use App\Driver;
use App\Ifta;
use App\Imports\IftaImporte;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class IftasController extends Controller
{
    public function index()
    {

        return view('iftas.importe', ['drivers' => Driver::all()]);
    }

    public function importe()
    {
        $data = Excel::import(new IftaImporte, request()->file('file'));
        if ($data)
            return response()->json(true);

        return response()->json(false);
    }

    public function download($id)
    {
        $driver =$id;
       $data =  DB::select("SELECT s.name,i.distance FROM iftas i, states s WHERE
                          s.id = i.state_id and i.driver_id = $id
                           UNION ALL
                         SELECT s.name,SUM(t.quantity) FROM states s , transactions t  WHERE
                               t.state_id = s.id
                              and t.driver_id = $id
                        GROUP by t.state_id");
       $groupedData = collect($data)->mapToGroups(function ($item){
      return [$item->name => $item->distance];
       });

       $finalData = [];

        foreach ($groupedData as $index => $item) {
              array_push($finalData,["state"=>$index,"distance"=>$item[0],"fuel"=>isset($item[1])?$item[1]:0]);
       }

        $results = Ifta::hydrate($finalData);

        $pdf = PDF::loadView('iftas.index', compact('results', 'driver'));
        return $pdf->stream('iftas_' . $id . '.pdf');

    }
}
