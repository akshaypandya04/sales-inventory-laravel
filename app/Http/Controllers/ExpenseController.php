<?php

namespace App\Http\Controllers;
use App\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

class ExpenseController extends Controller
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


// Show all expenses
    public function index()
    {
        $expenses = Expense::latest()->get();
        return view('expenses.index', compact('expenses'));
    }

    // Show create form
    public function create()
    {
        return view('expenses.create');
    }

    // Store expense to DB
    public function store(Request $request)
    {
        $request->validate([
            'item' => 'required|string|max:255',
            'to' => 'required|string|max:255',
            'date' => 'required|date',
            'item_description' => 'nullable|string',
            'paid_amount' => 'required|numeric',
            'remarks' => 'nullable|string',
        ]);

        Expense::create($request->all());

        return redirect()->route('expenses.index')->with('message', 'Expense added successfully.');
    }

    // Show edit form
    public function edit(Expense $expense)
    {
        return view('expenses.edit', compact('expense'));
    }

    // Update the expense
    public function update(Request $request, Expense $expense)
    {
        $request->validate([
            'item' => 'required|string|max:255',
            'to' => 'required|string|max:255',
            'date' => 'required|date',
            'item_description' => 'nullable|string',
            'paid_amount' => 'required|numeric',
            'remarks' => 'nullable|string',
        ]);

        $expense->update($request->all());

        return redirect()->route('expenses.index')->with('message', 'Expense updated successfully.');
    }

    // Delete an expense
    public function destroy(Expense $expense)
    {
        $expense->delete();
        return redirect()->route('expenses.index')->with('message', 'Expense deleted successfully.');
    }
    
    
      public function expenses_report(Request $request)
    {
        $expenses = Expense::orderBy('created_at', 'desc')->get();
        return view('expenses.expenses_report', compact('expenses','request'));
    }
    
     public function expenses_filter(Request $request)
    {


    $expenses = Expense::orderBy('created_at', 'desc')
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


          return view('expenses.expenses_report', compact('expenses', 'request'));

    }


}
