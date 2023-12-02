<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gender;
use App\Models\Subgender;
use Illuminate\Http\Request;

class SubgenderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subgenders = Subgender::all();
        return view('admin.subgenders.index', compact('subgenders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genders = Gender::pluck('name', 'id')->toArray();;
        return view('admin.subgenders.create', compact('genders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:subgenders',
            'gender_id' => 'required'
       ]);

       Subgender::create($request->all());

       return redirect()->route('admin.subgenders.index')
       ->with('info', $request->name . ' Subgender has been successfully added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subgender $subgender)
    {
        return view('admin.subgenders.show', compact('subgender'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subgender $subgender)
    {
        $genders = Gender::pluck('name', 'id')->toArray();;
        return view('admin.subgenders.edit', compact('subgender', 'genders'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subgender $subgender)
    {
        $request->validate([
            'name' => 'required',
            'slug' => "required|unique:subgenders,slug,$subgender->id",
            'gender_id' => 'required'
       ]);

       $subgender->update($request->all());

       return redirect()->route('admin.subgenders.index', $subgender)
       ->with('info', $subgender->name . ' Subgender has been successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subgender $subgender)
    {
        $subgender->delete();

        return redirect()->route('admin.subgenders.index')
        ->with('info', $subgender->name . ' Subgender has been successfully deleted.');
    }
}
