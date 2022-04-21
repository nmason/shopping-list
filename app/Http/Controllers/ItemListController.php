<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Item;
use App\Models\ItemList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ItemListController extends Controller
{
    /**
     * Display a listing of the resource.
     * Gets all itemLists, sorted in memory by department_name, then grouping the items in the collection by deparment_name,
     * Gets all items, sorted in memory by department_name, then grouping the items in the collection by deparment_name,
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $itemLists = ItemList::all()->sortBy('department_name')->groupBy('department_name');
        $items = Item::all()->sortBy('department_name')->groupBy('department_name');

        return Request()->expectsJson()
            ? Response()->json(compact('ItemLists'))
            : Inertia::render('ItemList/Index', compact('itemLists', 'items'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->validate([
           "quantity" => ["required",  "integer"],
           "item_id" => ["required", "exists:items,id"]
        ]);

        ItemList::create( $input );

        return Redirect::route('list.index');
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ItemList  $ItemList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $itemList = ItemList::findOrFail($id);

        $input = $request->validate([
           "quantity" => ["required",  "integer"],
           "purchased" => ["boolean"]
        ]);

        $result = $itemList->update( $input );
        return  Request()->expectsJson()
            ? Response()->json(['success' => $result])
            : Redirect::route('list.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ItemList  $ItemList
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {

        return  Request()->expectsJson()
            ? Response()->json(['success' => ItemList::findOrFail($id)->delete()])
            : Redirect::route('ItemLists.index');
    }
}
