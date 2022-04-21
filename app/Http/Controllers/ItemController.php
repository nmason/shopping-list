<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all()->sortBy('department_name')->groupBy('department_name');

        return Request()->expectsJson()
            ? Response()->json(compact('items'))
            : Inertia::render('Item/Index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

         $departments = Department::all()->sortBy('name');

        return Inertia::render('Item/Create', compact('departments'));
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
           "name" => ["required",  "max:128"],
           "department_id" => ["required", "exists:departments,id"]
        ]);

        Item::create( $input );

        return Redirect::route('items.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        return $this->edit($item);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        $departments = Department::all()->sortBy('name');

        return Inertia::render('Item/Edit', compact('item', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $input = $request->validate([
           "name" => ["required", "max:128" ],
           "department_id" => ["required", "exists:departments,id"]
        ]);

        $item->update( $input );

        return Redirect::route('items.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        return  Request()->expectsJson()
            ? Response()->json(['success' => $item->delete()])
            : Redirect::route('items.index');
    }
}
