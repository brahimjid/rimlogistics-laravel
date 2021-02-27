<?php

namespace App\Http\Controllers;

use App\Driver;
use App\Ifta;
use App\Imports\IftaImporte;
use App\Imports\PasImport;
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

    public function get_pas()
    {
        dd('index pas');
    }

    public function upload_pas()
    {
        return view('iftas.pas');
    }

    public function pas()
    {
        $data = Excel::import(new PasImport, request()->file('file'));
        if ($data)
             return view('iftas.pas_inx');

        return response()->json(false);
    }

    public function download($id)
    {
       $data =  DB::select("SELECT s.name,sum(i.distance) dist FROM iftas i, states s WHERE
                          s.id = i.state_id and i.driver_id = $id GROUP by i.state_id
                           UNION ALL
                         SELECT s.name, SUM(t.quantity) as fuel FROM
                              transactions t,states s
                              WHERE t.state_id = s.id
                        and t.driver_id = $id
                        GROUP by t.state_id");

       //return response()->json($data);
       $sumF=DB::select("SELECT s.name, SUM(t.quantity) as fuel FROM
                              transactions t,states s
                              WHERE t.state_id = s.id
                              and t.driver_id = $id
                        GROUP by t.state_id");

       $sumD = DB::select("SELECT s.name,sum(i.distance) distance FROM iftas i, states s WHERE
                          s.id = i.state_id and i.driver_id = $id GROUP by i.state_id");

        $results = collect($sumD)->merge($sumF)->groupBy("name");

        $driver=$id;
        //return view('iftas.index',compact('results','driver'));

        $pdf = PDF::loadView('iftas.index', compact('results', 'driver'));
        return $pdf->download('iftas_' . $id . '.pdf');

    }

    public function test()
    {
        $pdf = PDF::loadView('fact');
        return $pdf->stream('iftas_.pdf');
    }
}
