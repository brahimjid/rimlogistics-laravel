<?php

namespace App\Http\Controllers;

use App\Driver;
use App\Imports\TransactionImpColl;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class TransactionController extends Controller
{
    public function index()
    {

        return view("index",['drivers'=>Driver::all()]);
    }

    public function import()
    {
        $data = Excel::import(new TransactionImpColl, request()->file('file'));
        if ($data)
            return response()->json(true);

        return response()->json(false);

    }

    public function download($id)
    {
        $data = DB::select("SELECT s.name,  t.driver_id, SUM(t.quantity) as quantity_total, t.card_num FROM
                              transactions t,states s
                              WHERE t.state_id = s.id
                              and t.driver_id = $id
                        GROUP by t.state_id ,t.card_num");


        $grouped =collect($data)->mapToGroups(function ($item) {

            return [$item->name => [$item->card_num, 'total' => $item->quantity_total]];
        });


        $res = $grouped->toArray();
        // return response()->json($res);
        $driver_id = $data[0]->driver_id;
        // return view('download',compact('res','driver_id'));
        $pdf = PDF::loadView('download', compact('res', 'driver_id'));
        return $pdf->stream('transactions_' . $driver_id . '.pdf');

 }


}
