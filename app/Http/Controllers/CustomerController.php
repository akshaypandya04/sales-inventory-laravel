<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use DB;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $customers = Customer::where('type', 'Customer')->orderBy('created_at', 'DESC')->get();
        return view('customer.index', compact('customers'));
    }
    
    
    public function party_list()
    {
        $customers = Customer::where('type', 'Party')->orderBy('created_at', 'DESC')->get();
        return view('customer.party_list', compact('customers'));
    }

      public function customer_report(Request $request)
    {
        $customers = Customer::orderBy('created_at', 'DESC')->get();
        return view('customer.report', compact('customers','request'));
    }



    public function customer_filter(Request $request)
    {


    $customers = Customer::orderBy('created_at', 'desc')
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


          return view('customer.report', compact('customers', 'request'));

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer.create');
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
            'name' => 'required|min:3|unique:customers',
            'mobile' => 'required|min:3|digits:10',

        ]);

        $customer = new Customer();
        $customer->name = $request->name;
        $customer->type = $request->type;
        $customer->address = $request->address;
        $customer->mobile = $request->mobile;
        $customer->email_id = $request->email_id;
        $customer->city = $request->city;

         if ($request->hasFile('document')){
            $imageName =request()->document->getClientOriginalName();
            request()->document->move(public_path('/uploads/customers/'), $imageName);
            $customer->document = $imageName;
        }

        $customer->save();

if ($request->type === 'Customer') {
    return redirect()->route('customer.index')->with('message', 'Customer Created Successfully');
} else {
    return redirect()->route('party.list')->with('message', 'Party Created Successfully');
}
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customers = Customer::findOrFail($id);
        $payments = Payment::where('customer_id' ,$customers->id)->get();

        $due_sum = Payment::where('customer_id' , $customers->id)->sum('due_amount');
        $recived_sum = Payment::where('customer_id' , $customers->id)->sum('recived_amount');

        return view('customer.show', compact('customers','payments','due_sum','recived_sum'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customer.edit', compact('customer'));
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
            'name' => 'required|min:3',
            'mobile' => 'required|min:3|digits:10',
        ]);

        $customer = Customer::findOrFail($id);
        $customer->name = $request->name;
        $customer->type = $request->type;
        $customer->address = $request->address;
        $customer->mobile = $request->mobile;
        $customer->email_id = $request->email_id;
        $customer->city = $request->city;

         if ($request->hasFile('document')){
            $image_path ="/uploads/customers/".$customer->document;
            if (file_exists($image_path)){
                unlink($image_path);
            }
            $imageName =request()->document->getClientOriginalName();
            request()->document->move(public_path('/uploads/customers/'), $imageName);
            $customer->document = $imageName;
        }


        $customer->save();

if ($request->type === 'Customer') {
    return redirect()->route('customer.index')->with('message', 'Customer Update Successfully');
} else {
    return redirect()->route('party.list')->with('message', 'Party Update Successfully');
}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        $customer->delete();
        return redirect()->back();

    }
}
