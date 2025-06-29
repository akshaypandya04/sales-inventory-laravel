<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

class InvoiceController extends Controller
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
        $invoices = Invoice::orderBy('created_at', 'desc')->get();
        return view('invoice.index', compact('invoices'));
    }
    
    
     public function invoice_report(Request $request)
    {
        $invoices = Invoice::orderBy('created_at', 'DESC')->get();
        return view('invoice.report', compact('invoices','request'));
    }
    
       public function invoice_filter(Request $request)
    {
        
    
    $invoices = Invoice::orderBy('created_at', 'desc')->where('name', 'like', '%'.$request->name.'%')
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
    
          
          return view('invoice.report', compact('invoices', 'request'));
        
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::all();

        return view('invoice.create', compact('customers'));
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
        
                $invoice = new Invoice();
                $invoice->name = $request->name;
                $invoice->bank_name = $request->bank_name;
                $invoice->account_no = $request->account_no;
                $invoice->ifsc_code = $request->ifsc_code;
                $invoice->sender_no = $request->sender_no;
                $invoice->date = $request->date;
                $invoice->transcation_id = $request->transcation_id;
                $invoice->bank_ref_no = $num;
                $invoice->method = $request->method;
                $invoice->status = $request->status;
                $invoice->amount = $request->amount;
                $invoice->save();

                return redirect('invoice/'.$invoice->id)->with('message','invoice created Successfully');

    }

    public function findPrice(Request $request){
        $data = DB::table('products')->select('sales_price')->where('id', $request->id)->first();
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
        $invoice = Invoice::findOrFail($id);
        return view('invoice.show', compact('invoice'));

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
        $invoice = Invoice::findOrFail($id);

        return view('invoice.edit', compact('customers','invoice'));
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

                $invoice = Invoice::findOrFail($id);
      
                $invoice->name = $request->name;
                $invoice->bank_name = $request->bank_name;
                $invoice->account_no = $request->account_no;
                $invoice->ifsc_code = $request->ifsc_code;
                $invoice->sender_no = $request->sender_no;
                $invoice->date = $request->date;
                $invoice->transcation_id = $request->transcation_id;
                // $invoice->bank_ref_no = $num;
                $invoice->method = "PIMPS";
                $invoice->status = "Success";
                $invoice->amount = $request->amount;
                $invoice->save();

        return redirect('invoice/'.$invoice->id)->with('message','invoice created Successfully');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();
        return redirect()->back();

    }
}
