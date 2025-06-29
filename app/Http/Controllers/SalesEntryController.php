<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Item;
use App\SalesEntry;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use DB;

class SalesEntryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


     public function index()
    {
        $entries = SalesEntry::all();
        return view('sales.index', compact('entries'));
    }

    public function create()
    {
        $customers = DB::table('customers')->where('type', 'Customer')->get();
        $items = DB::table('items')->get();
        $category = DB::table('category')->get();
        return view('sales.create', compact('customers','items','category'));
    }
    
    public function getItemsByCategory($id)
{
    $items = Item::where('category_id', $id)->get();
    return response()->json($items);
}
    
    
public function getItem($id)
{
    $item = Item::find($id);

    if (!$item) {
        return response()->json(['error' => 'Item not found'], 404);
    }

    return response()->json($item);
}



  public function store(Request $request)
{
    $item = Item::find($request->item_id);

    $height = $request->height;
    $width = $request->width;
    $qty = $request->qty;

    SalesEntry::create([
        'sale_date' => $request->sale_date,
        'customer_id' => $request->customer_id,
        'category_id' => $request->category_id,
        'item_id' => $request->item_id,
        'width' => $request->width,
        'height' => $request->height,
        'sq_ft' => $request->sq_ft,
        'qty' => $qty,
        'price' => $item->price,
        'total' => $request->total,
        'remarks' => $request->remarks,
        'discount' => $request->discount ?? 0,
        'discount_type' => $request->discount_type,
        'final_amount' => $request->final_amount, // apply discount if needed
        'paid_amount' => $request->paid_amount ?? 0,
        'remain_amount' => $request->remain_amount,
    ]);
    
    // Decrease item stock
    $item = Item::find($request->item_id);
    if ($item) {
        $item->qty -= $request->qty;
        $item->save();
    }

    return redirect()->route('sales.index')->with('message', 'Sales entry added.');
}

    public function show(SalesEntry $salesEntry)
    {
        return view('sales.show', compact('salesEntry'));
    }

    public function edit(SalesEntry $salesEntry)
    { 
        $customers = DB::table('customers')->get();
        $items = DB::table('items')->get();
        $category = DB::table('category')->get();
        return view('sales.edit', compact('salesEntry','customers','items', 'category'));
    }

    public function update(Request $request, SalesEntry $salesEntry)
    {
        $data = $request->all(); // validate same as store()
        $salesEntry->update($data);
        return redirect()->route('sales.index')->with('message', 'Sales entry updated.');
    }

    public function destroy(SalesEntry $salesEntry)
    {
        $salesEntry->delete();
        return redirect()->route('sales.index')->with('message', 'Sales entry deleted.');
    }
    
    
   
      public function sales_report(Request $request)
    {
        $entries = SalesEntry::orderBy('created_at', 'desc')->get();
        return view('sales.sales_report', compact('entries','request'));
    }
    
    
    
        public function sales_filter(Request $request)
    {


    $entries = SalesEntry::orderBy('created_at', 'desc')
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


          return view('sales.sales_report', compact('entries', 'request'));

    }
    
    
    
}
