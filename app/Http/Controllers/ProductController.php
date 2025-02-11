<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Farmer;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('farmer')->get();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $farmers = Farmer::all();
        return view('products.create', compact('farmers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'price'=>'required|numeric',
            'quantity'=>'required|integer',
            'farmer_id'=>'required|exists:farmers,id',
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')->with('success','Product added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, Product $product)
    {
        $farmers = Farmer::all();
        return view('products.edit', compact('product', 'farmers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Product $product, Request $request, string $id)
    {
        $request->validate([
            'name'=>'required',
            'price'=>'required|numeric',
            'quantity'=>'required|integer',
            'farmer_id'=>'required|exists:farmers,id',
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product, string $id)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success','Product deleted');
    }
}
