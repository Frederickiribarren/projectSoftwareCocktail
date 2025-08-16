<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\inventories;

class inventoriesController extends Controller
{
    public function index()
    {
        $inventories = inventories::all();
        return view('inventories.index', compact('inventories'));
    }

    public function create()
    {
        return view('inventories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        inventories::create($request->all());
        return redirect()->route('inventories.index')->with('success', 'Inventory created successfully.');
    }

    public function show($id)
    {
        $inventory = inventories::findOrFail($id);
        return view('inventories.show', compact('inventories'));
    }

    public function edit($id)
    {
        $inventory = inventories::findOrFail($id);
        return view('inventories.edit', compact('inventories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        $inventory = inventories::findOrFail($id);
        $inventory->update($request->all());
        return redirect()->route('inventories.index')->with('success', 'Inventorie updated successfully.');
    }

    public function destroy($id)
    {
        $inventory = inventories::findOrFail($id);
        $inventory->delete();
        return redirect()->route('inventories.index')->with('success', 'Inventorie deleted successfully.');
    }
}
