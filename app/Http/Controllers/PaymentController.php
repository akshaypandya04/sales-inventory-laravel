<?php

namespace App\Http\Controllers;

use App\Payment;
use App\SalesEntry;
use App\Purchase;
use App\Expense;
use DB;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $payments = Payment::all();
        return view('payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  
          $customers = DB::table('customers')->get();
          $loans = DB::table('loans')->get();
          return view('payments.create',compact('customers','loans'));
    }
    
    
    
      public function fetch_loan_code(Request $request)
    {
        $data['loans'] = Loan::where("customer_id",$request->customer_id)->get(["unique_no"]);
        return response()->json($data);
    }
    
    
      public function findLoan(Request $request){
        $data = DB::table('loans')->select('amount_senctioned','tenor_month','amount_disbursed','vecale','rate_interest','emi_amount')->where('unique_no', $request->id)->first();
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required',
            'product_name' => 'required',
            'amount' => 'required',
            'due_amount' => 'required',
            'date' => 'required',
            'recived_amount' => 'required',

        ]);

        $payments = new Payment();
        $payments->customer_name = $request->customer_name;
        $payments->product_name = $request->product_name;
        $payments->amount = $request->amount;
        $payments->date = $request->date;
        $payments->mode = $request->mode;
        $payments->due_amount = $request->due_amount;
        $payments->recived_amount = $request->recived_amount;
        $payments->save();

        return redirect()->route('payment.index')->with('message', 'Payment Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

         public function show($id)
    {
        $payments = Payment::findOrFail($id);
        $customers = DB::table('customers')->where('id' , $payments->customer_id)->first();
        $loans = DB::table('loans')->where('unique_no' , $payments->loan_id)->first();
        
        
        return view('payments.show', compact('payments','customers','loans'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $payments = Payment::findOrFail($id);
        $customers = DB::table('customers')->get();
        $loans = DB::table('loans')->get();
        return view('payments.edit', compact('payments','customers','loans'));
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
        $request->validate([
            'customer_name' => 'required',
            'product_name' => 'required',
            'amount' => 'required',
            'due_amount' => 'required',
            'date' => 'required',
            'recived_amount' => 'required',

        ]);

        $payments = Payment::findOrFail($id);
        $payments->customer_name = $request->customer_name;
        $payments->product_name = $request->product_name;
        $payments->amount = $request->amount;
        $payments->date = $request->date;
        $payments->mode = $request->mode;
        $payments->due_amount = $request->due_amount;
        $payments->recived_amount = $request->recived_amount;
        $payments->save();

        return redirect()->route('payment.index')->with('message', 'Payment update Successfully');
    }
    
    
 
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $payments = Payment::find($id);
        $payments->delete();
        return redirect()->back();

    }
    
    
    
 
     public function dayWiseProfitReport(Request $request)
    {


   $from = $request->from;
    $to = $request->to;

    $sales = SalesEntry::whereBetween('sale_date', [$from, $to])->sum('final_amount');
    $purchases = Purchase::whereBetween('purchase_date', [$from, $to])->sum('final_amount');
    $expenses = Expense::whereBetween('date', [$from, $to])->sum('paid_amount');

    $profit = $sales - ($purchases + $expenses);


          return view('payments.profit_report', compact('sales', 'purchases', 'expenses', 'profit', 'from', 'to'));

    } 
    
    
}
