<?php

namespace App\Http\Controllers;
use App\Purchase;
use App\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

class PurchaseController extends Controller
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


// Show all purchases
    public function index()
    {
        $purchases = Purchase::latest()->get();
        return view('purchases.index', compact('purchases'));
    }

    // Show create form
    public function create()
    {
        $customers = DB::table('customers')->where('type', 'Party')->get();
        $items = DB::table('items')->get();
        $category = DB::table('category')->get();
        return view('purchases.create',compact('customers','items','category'));
    }
    
    
        public function getByCategory($id)
{
    $items = Item::where('category_id', $id)->get();
    return response()->json($items);
}
    

   public function store(Request $request)
{
    $request->validate([
        'invoice_no' => 'required',
        'purchase_date' => 'required|date',
        'party_id' => 'required',
        'item_id' => 'required',
        'category_id' => 'required',
        'purchase_price' => 'required|numeric',
        'qty' => 'required|integer',
        'total' => 'required|numeric',
        'final_amount' => 'required|numeric',
        'paid_amount' => 'required|numeric',
        'remain_amount' => 'required|numeric',
    ]);

    $purchase = Purchase::create($request->all());

    // Increase item stock
    $item = Item::find($request->item_id);
    if ($item) {
        $item->qty += $request->qty;
        $item->save();
    }

    return redirect()->route('purchases.index')->with('message', 'Purchase created & stock updated.');
}

 public function edit(Purchase $purchase)
    { 
        $customers = DB::table('customers')->get();
        $items = DB::table('items')->get();
        $category = DB::table('category')->get();
        return view('purchases.edit', compact('purchase','customers','items','category'));
    }



public function update(Request $request, Purchase $purchase)
{
    $request->validate([
        'invoice_no' => 'required',
        'purchase_date' => 'required|date',
        'party_id' => 'required',
        'item_id' => 'required',
        'category_id' => 'required',
        'purchase_price' => 'required|numeric',
        'qty' => 'required|integer',
        'total' => 'required|numeric',
        'final_amount' => 'required|numeric',
        'paid_amount' => 'required|numeric',
        'remain_amount' => 'required|numeric',
    ]);

    // Revert old qty from stock
    $oldItem = Item::find($purchase->item_id);
    $oldItem->qty -= $purchase->qty;
    $oldItem->save();

    $purchase->update($request->all());

    // Add new qty to stock
    $newItem = Item::find($request->item_id);
    $newItem->qty += $request->qty;
    $newItem->save();

    return redirect()->route('purchases.index')->with('message', 'Purchase updated & stock adjusted.');
}

public function destroy(Purchase $purchase)
{
    // Revert stock
    $item = Item::find($purchase->item_id);
    $item->qty -= $purchase->qty;
    $item->save();

    $purchase->delete();

    return redirect()->route('purchases.index')->with('message', 'Purchase deleted & stock reverted.');
}


    
      public function purchases_report(Request $request)
    {
        $purchases = Purchase::orderBy('created_at', 'desc')->get();
        return view('purchases.purchase_report', compact('purchases','request'));
    }
    



     public function purchases_filter(Request $request)
    {


    $purchases = Purchase::orderBy('created_at', 'desc')
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


          return view('purchases.purchase_report', compact('purchases', 'request'));

    }


}