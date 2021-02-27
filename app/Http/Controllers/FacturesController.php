<?php

namespace App\Http\Controllers;

use App\Driver;
use App\Facture;
use App\Fuel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use stdClass;

class FacturesController extends Controller
{
    public function index(Request $request)
    {

        //    $dt = Facture::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        if (($request->has('date1') || $request->has('date1')) && $request->has('driver_id')) {
            $date1 = Carbon::parse($request->date1)->toDateString();
            $date2 = Carbon::parse($request->date2)->toDateString();
            if ($date1 === $date2) {
                $factures = Facture::whereDate('date', $date1)->where('driver_id', $request->driver_id)->orderBy('fact_num')->get();
                $drivers = Driver::all();
                return view('facture.index', compact('factures', 'drivers'));
            }
            $factures = Facture::whereBetween('date',
                [
                    Carbon::parse($date1)->toDateString(),
                    Carbon::parse($date2)->addDay()
                ]

            )->where('driver_id', $request->driver_id)->orderBy('fact_num')->get();
            $drivers = Driver::all();
            return view('facture.index', compact('factures', 'drivers'));
        }

        if ($request->has('date1') || $request->has('date1')) {
            $date1 = Carbon::parse($request->date1)->toDateString();
            $date2 = Carbon::parse($request->date2)->toDateString();
            if ($date1 === $date2) {
                $factures = Facture::whereDate('date', $date1)->orderBy('fact_num')->get();
                //  dd($factures);
                $drivers = Driver::all();
                return view('facture.index', compact('factures', 'drivers'));
            }
            // $fd = Carbon::parse()
            $factures = Facture::whereBetween('date',
                [
                    Carbon::parse($date1)->toDateString(),
                    Carbon::parse($date2)->addDay()
                ]

            )->orderBy('fact_num')->get();
            $drivers = Driver::all();
            return view('facture.index', compact('factures', 'drivers'));
        }

        if (request()->query('all') != null) {

            $factures = Facture::Latest()->get();
            $drivers = Driver::all();
            return view('facture.index', compact('factures', 'drivers'));
        }

        $factures = Facture::whereDate('date', Carbon::now()->toDateString())->orderBy('fact_num')->get();

        $drivers = Driver::all();

        return view('facture.index', compact('factures', 'drivers'));
    }


    public function create()
    {
        return view('facture.create', ['drivers' => Driver::all()]);
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $facture = new Facture();
        $facture->fact_num = $request->num;
        $facture->amount = $request->amount;
        $facture->driver_id = $request->driver_id;
        $facture->date = $request->date;
        $facture->extra = $request->extra;
        $facture->created_at = $request->date;
        $facture->updated_at = $request->date;
        if ($facture->save())
            return redirect()->route('invoice.create');
        return back();
    }

    public function edit($id)
    {
        $facture = Facture::find($id);
        return view('facture.edit', ['facture' => $facture]);
    }

    public function update(Request $request)
    {
         // dd($request->all());
        $facture = Facture::find($request->id);
        $facture->fact_num = $request->num;
        $facture->amount = $request->amount;
        $facture->driver_id = $request->driver_id;
        $facture->date = $request->date;
         $facture->extra=$request->extra;
        $facture->created_at = $request->date;
        $facture->updated_at = $request->date;
        if ($facture->save())
            return redirect()->route('invoices');
        return back();
    }

    public function delete(Request $request)
    {

        $f = Facture::find($request->id)->delete();
        if ($f)
            return response()->json(true);
        return response()->json(false);

    }

//    public function weeklyPaycheck()
//    {
//        $startOfWeek = Carbon::now()->startOfWeek();
//        $endOfWeek = Carbon::now()->endOfWeek();
//        $invoicesSum = DB::select(" SELECT d.full_name ,SUM(f.amount) invoiceTotal FROM factures f,drivers d WHERE f.driver_id = d.id and f.date BETWEEN
//              '$startOfWeek' and '$endOfWeek' and f.extra =0 GROUP BY f.driver_id
//              UNION
//              SELECT d.full_name ,SUM(fe.fuel) fuelTotal FROM drivers d,fuels fe WHERE fe.driver_id = d.id  and fe.created_at BETWEEN
//     '$startOfWeek' and '$endOfWeek' GROUP BY fe.driver_id");
//
//         //dd($invoicesSum);
//        $gr = (collect($invoicesSum)->groupBy('full_name'));
//
//        $y = [];
//
//        foreach ($gr as $k => $v) {
//
//            $name = $v[0]->full_name;
//            $it = isset($v[1])?$v[0]->invoiceTotal:0;
//            $ft = isset($v[1]) ? $v[1]->invoiceTotal : $v[0]->invoiceTotal;
//
//
//            $tf = number_format(($it - $ft) * (1 - 10.5 / 100), 2);
//            array_push($y,
//                [
//                    'name' => $name,
//                    'invoicesTotal' => $it,
//                    'fuel' => $ft,
//                    'total' => $tf
//
//                ]);
//        }
//
//        return view('facture.weeklyPaycheck', ['invoiceData' => Facture::hydrate($y)]);
//
//    }

  public function paycheck()
  {
      $startOfWeek = Carbon::now()->startOfWeek();

      $endOfWeek = Carbon::now()->endOfWeek();
      //dd($startOfWeek);
//        $t = Facture::with(['driver'=>function($q) use ($startOfWeek,$endOfWeek){
//             $q->with(['fuel'=>function($q) use($startOfWeek,$endOfWeek){
//                 $q->whereDate('created_at','>=',$startOfWeek)->where('driver_id',3);
//             }]);
//      }])->whereBetween('date',[$startOfWeek,$endOfWeek])->where([['driver_id',3],['extra',0]])->get();
//        return response()->json($t);

      $invoicesAndFuels  = Driver::with(["facture"=>function ($q) use($startOfWeek,$endOfWeek){
          $q->select('id',"date",'amount','driver_id')->whereBetween('date', [$startOfWeek, $endOfWeek])->where("extra",0);
      }])->with(['fuel'=>function($q) use($startOfWeek,$endOfWeek){

          $q->select('id','fuel','driver_id')->whereBetween('created_at', [$startOfWeek, $endOfWeek]);
      }])->get(["id","full_name"]);

      $groupedData = $invoicesAndFuels->mapToGroups(function ($item){
              //dd($item->driver->fuel);
          return [$item->full_name=>["invoices"=>count($item->facture)?$item->facture:[],
                                    "fuels"=>count($item->fuel)>0?$item->fuel:[],
                                    'sumInvoices'=>($item->facture->sum('amount')),
                                    'sumFuels'=>$item->fuel->sum('fuel'),
                                    ]];
     });

      if (request()->ajax()){
          return response()->json($invoicesAndFuels);
      }

      return view('facture.wp',["data"=>$groupedData,'drivers'=>Driver::all()]);


//
   }

}
