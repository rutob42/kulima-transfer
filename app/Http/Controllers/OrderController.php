<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */

       
    
    public function index()
    {
        $orders = Order::with('product','buyer')->get();
        return view('orders.index',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        return view('orders.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'You must be logged in to place an order.');
    }

    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer',
    ]);

    $product = Product::find($request->product_id);
    $total_price = $product->price * $request->quantity;

    Order::create([
        'product_id' => $request->product_id,
        'buyer_id' => Auth::id(), // Ensured user is logged in
        'quantity' => $request->quantity,
        'total_price' => $total_price,
        'status' => 'pending',
    ]);

    return redirect()->route('orders.index')->with('success', 'Order placed successfully.');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
