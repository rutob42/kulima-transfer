<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Supplier;
use App\Models\User;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::with('user')->get();
        return view('suppliers.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'company_name'=>'required',
            'supplies'=>'required',
        ]);

        Supplier::create([
            'user_id'=>auth()->id(),
            'company_name'=>$request->company_name,
            'supplies'=>$request->supplies,
        ]);

        return redirect()->route('suppliers.index')->with('success','Suppliers registered successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier, string $id)
    {
        return view('suppliers.show', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, Supplier $supplier)
    {
        return view('suppliers.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'company_name'=>'required',
            'supplies'=>'required',
        ]);

        $supplier->update($request->all());

        return redirect()->route('suppliers.index')->with('success','Supplier updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Supplier $supplier)
    {
        $supplier->delete();

        return redirect()->route('suppliers.index')->with('success', 'supplier deleted');
    }
}
