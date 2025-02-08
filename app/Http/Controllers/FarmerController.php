<?php

namespace App\Http\Controllers;
use App\Models\Farmer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FarmerController extends Controller
{
    //get all farmers
    public function index()
    {
        $farmers = Farmer::all();
        return response()->json($farmers);
    }

    //create a new farmer
    public function store(Request $request)
    {
        $farmer = Farmer::create($request->all());
        return response()->json($farmer);
    }

    //get a single farmer
    public function show($id)
    {
        $farmer = Farmer::find($id);
        return response()->json($farmer);
    }

    //update a farmer's details
    public function update(Request $request, $id)
    {
        $farmer = Farmer::find($id);
        $farmer->update($request->all());
        return response()->json($farmer);
    }

    public function destroy($id)
    {
        Farmer::destroy($id);
        return response()->json(null, 204);
    }
}
