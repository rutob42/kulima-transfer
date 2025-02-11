<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Farmer;
use App\Models\User;


class FarmerController extends Controller
{
    //get all farmers
    public function index()
    {
        $farmers = Farmer::all();
        return view('farmers.index', compact('farmers'));
    }

    public function create()
    {
        return view('farmers.create');  
    }

    //create a new farmer
    public function store(Request $request, )
    {
        $request->validate([
            'farm_name'=>'required',
            'location'=>'required'
        ]);

        Farmer::create([
            'user_id' => auth()->id(),
            'farm_name'=>$request->farm_name,
            'location'=>$request->location,
        ]);

        return redirect()->route('farmers.index')->with('success','Farmer register successfully.');
    }

    //get a single farmer
    public function show(Farmer $farmer)
    {
        return view('farmers.show', compact('farmer'));
    }

    public function edit(Farmer $farmer)
    {
        return view('farmers.edit', compact('farmer'));
    }

    //update a farmer's details
    public function update(Request $request, Farmer $farmer)
    {
        $request->validate([
            'farm_name'=>'required',
            'location'=>'required',
        ]);

        $farmer->update($request->all());

        return redirect()->route('farmers.index')->with('success','Farmer updated successfully');
    }

    public function destroy(Farmer $farmer)
    {
        $farmer->delete();

        return redirect()->route('farmers.index')->with('success','Farmer deleted');
    }
}
