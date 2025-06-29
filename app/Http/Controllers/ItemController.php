<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

class ItemController extends Controller
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
        $items = Item::all();
        return view('items.index', compact('items'));
    }

    public function create()
    {
        
      $category = DB::table('category')->get();    
        return view('items.create',compact('category'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'qty' => 'required|numeric',
            'category_id' => 'required|numeric',
            'type' => 'required|in:sqfeet,direct',
        ]);

        Item::create($validated);
        return redirect()->route('items.index')->with('message', 'Item created successfully.');
    }

    public function show(Item $item)
    {
        return view('items.show', compact('item'));
    }

    public function edit(Item $item)
    {
        $category = DB::table('category')->get();  
        return view('items.edit', compact('item','category'));
    }

    public function update(Request $request, Item $item)
    {
        $validated = $request->validate([
            'item_name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'qty' => 'required|numeric',
            'category_id' => 'required|numeric',
            'type' => 'required|in:sqfeet,direct',
        ]);

        $item->update($validated);
        return redirect()->route('items.index')->with('message', 'Item updated successfully.');
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('items.index')->with('message', 'Item deleted.');
    } 
 
 
 
 
}
