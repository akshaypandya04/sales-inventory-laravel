<?php

namespace App\Http\Controllers;
use App\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

class UnitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $units = Unit::orderBy('created_at', 'DESC')->get();
        $inr_sum = Unit::sum('inr');
        $cus_rate_sum = Unit::sum('cus_rate');
        $aed_sum = Unit::sum('aed');
        $pur_rate_sum = Unit::sum('pur_rate');
        $s_prices_sum = Unit::sum('s_prices');
        $profit_sum = Unit::sum('profit');
        return view('unit.index', compact('units','inr_sum','cus_rate_sum','aed_sum','pur_rate_sum','s_prices_sum','profit_sum'));
    }
    
    

   public function rates_report(Request $request)
    {
        $units = Unit::orderBy('created_at', 'DESC')->get();
        $inr_sum = Unit::sum('inr');
        $cus_rate_sum = Unit::sum('cus_rate');
        $aed_sum = Unit::sum('aed');
        $pur_rate_sum = Unit::sum('pur_rate');
        $s_prices_sum = Unit::sum('s_prices');
        $profit_sum = Unit::sum('profit');
        return view('unit.report', compact('units','request','inr_sum','cus_rate_sum','aed_sum','pur_rate_sum','s_prices_sum','profit_sum'));
    }
    
       public function rates_filter(Request $request)
    {
        
    
    $units = Unit::orderBy('created_at', 'desc')->where('customer_name', 'like', '%'.$request->name.'%')
            ->when(
                $request->start_date && $request->end_date,
                function (Builder $builder) use ($request) {
                    $builder->whereBetween(
                        DB::raw('DATE(created_at)'),
                        [
                            $request->start_date,
                            $request->end_date
                        ]
                    );
                }
            )->orderBy('created_at', 'DESC')->get();
    
          $inr_sum = Unit::sum('inr');
          $cus_rate_sum = Unit::sum('cus_rate');
          $aed_sum = Unit::sum('aed');
          $pur_rate_sum = Unit::sum('pur_rate');
          $s_prices_sum = Unit::sum('s_prices');
          $profit_sum = Unit::sum('profit');
          return view('unit.report', compact('units', 'request','inr_sum','cus_rate_sum','aed_sum','pur_rate_sum','s_prices_sum','profit_sum'));
        
    }    
    
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('unit.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $unit = new Unit();
        $unit->customer_name = $request->customer_name;
        $unit->inr = $request->inr;
        $unit->cus_rate = $request->cus_rate;
        $unit->aed = $request->aed;
        $unit->pur_rate = $request->pur_rate;
        $unit->s_prices = $request->s_prices;
        $unit->profit = $request->profit;
        $unit->party = $request->party;
        $unit->payment = $request->payment;
        $unit->save();

        return redirect()->route('unit.index')->with('message', 'Rates Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $unit = Unit::findOrFail($id);
        return view('unit.edit', compact('unit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
     

        $unit = Unit::findOrFail($id);
        $unit->customer_name = $request->customer_name;
        $unit->inr = $request->inr;
        $unit->cus_rate = $request->cus_rate;
        $unit->aed = $request->aed;
        $unit->pur_rate = $request->pur_rate;
        $unit->s_prices = $request->s_prices;
        $unit->profit = $request->profit;
        $unit->party = $request->party;
        $unit->payment = $request->payment;
        $unit->save();

        return redirect()->route('unit.index')->with('message', 'Rates Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $unit = Unit::find($id);
        $unit->delete();
        return redirect()->back();

    }
}
