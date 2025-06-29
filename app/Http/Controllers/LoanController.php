<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $invoices = Loan::orderBy('created_at', 'desc')->get();
        return view('loans.index', compact('invoices'));
    }

    public function loan_report(Request $request)
    {
        $invoices = Loan::orderBy('created_at', 'desc')->get();
        $customers = DB::table('customers')->get();
        return view('loans.report', compact('invoices','request','customers'));
    }


      public function loan_filter(Request $request)
    {


    $invoices = Loan::orderBy('created_at', 'desc')->where('customer_id', $request->customer_id)->orwhere('vecale', $request->vecale)
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
            )->orderBy('created_at', 'desc')->get();

          $customers = DB::table('customers')->get();
          return view('loans.report', compact('invoices', 'request','customers'));

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::all();
        return view('loans.create', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

                $num = str_pad(mt_rand(1,99999999),8,'0',STR_PAD_LEFT);

                $invoice = new Loan();
                $invoice->unique_no = $num;
                $invoice->customer_id = $request->customer_id;
                $invoice->amount_senctioned = $request->amount_senctioned;
                $invoice->amount_disbursed = $request->amount_disbursed;
                $invoice->rate_interest = $request->rate_interest;
                $invoice->tenor_month = $request->tenor_month;
                $invoice->vecale = $request->vecale;
                $invoice->start_date = $request->start_date;
                $invoice->end_date = $request->end_date;
                $invoice->emi_amount = $request->emi_amount;
                $invoice->save();

                return redirect()->route('loans.index')->with('message','Loan created Successfully');

    }

    public function findCustomer(Request $request){
        $data = DB::table('customers')->select('cif','mobile','address')->where('id', $request->id)->first();
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $loans = Loan::findOrFail($id);
        $customers = Customer::where('id', $loans->customer_id)->first();
        return view('loans.show', compact('loans','customers'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customers = Customer::all();
        $invoice = Loan::findOrFail($id);
        return view('loans.edit', compact('customers','invoice'));
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


                $invoice = Loan::findOrFail($id);
                $invoice->customer_id = $request->customer_id;
                $invoice->amount_senctioned = $request->amount_senctioned;
                $invoice->amount_disbursed = $request->amount_disbursed;
                $invoice->rate_interest = $request->rate_interest;
                $invoice->tenor_month = $request->tenor_month;
                $invoice->vecale = $request->vecale;
                $invoice->start_date = $request->start_date;
                $invoice->end_date = $request->end_date;
                $invoice->emi_amount = $request->emi_amount;
                $invoice->save();


        return redirect()->route('loans.index')->with('message','Loan update Successfully');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $invoice = Loan::findOrFail($id);
        $invoice->delete();
        return redirect()->route('loans.index')->with('message','Loan delete Successfully');

    }
}
