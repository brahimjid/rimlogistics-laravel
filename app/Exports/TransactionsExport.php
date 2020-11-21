<?php


namespace App\Exports;


use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;


class TransactionsExport implements FromView
{
    public function view(): View
    {
        $data =  DB::table('transactions')
        ->select(DB::raw('store_Location,SUM(quantity) as quantity_total'))
        ->groupBy('store_location')
        ->get();
        return view('download', [
            'data' => $data
        ]);
    }

}
