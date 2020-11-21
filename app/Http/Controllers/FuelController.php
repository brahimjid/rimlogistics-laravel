<?php

namespace App\Http\Controllers;

use App\Driver;
use App\Fuel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FuelController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('date1') || $request->has('date1')){
            $date1 =  Carbon::parse($request->date1)->toDateString();
            $date2 =  Carbon::parse($request->date2)->toDateString();
            if ($date1===$date2){
                $fuels=Fuel::whereDate('created_at',$date1)->get();
                //  dd($fuels);
                return view('fuel.index',compact('fuels'));
            }
            $fuels=Fuel::whereBetween('created_at',[$date1, $date2])->get();

            return view('fuel.index',compact('fuels'));
        }
           $fuels = Fuel::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();

        return view('fuel.index',['fuels'=>$fuels]);

    }
    public function create()
    {

        return view('fuel.create',['drivers'=>Driver::all()]);

    }
    public function store(Request $request)
    {
      //   dd($request->all());
        $fuel= new Fuel();
        $fuel->fuel=$request->amount;
        $fuel->driver_id=$request->driver_id;

//        $fuel->created_at=$request->date;
//        $fuel->updated_at=$request->date;
        if($fuel->save())
            return redirect()->route('fuel.create');
        return back();
    }
}
