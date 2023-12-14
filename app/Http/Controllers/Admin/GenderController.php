<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gender;
use Illuminate\Http\Request;
use App\Traits\Cacheable;

class GenderController extends Controller
{
    use Cacheable;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $genders = Gender::all();
        return view('admin.genders.index', compact('genders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //USING LARAVEL COLLECTIVE TO MAKE FORMS
        return view('admin.genders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:genders'
        ]);
        Gender::create($request->all());
        $this->forgetCache('gendersCount');
        return redirect()->route('admin.genders.index')
        ->with('info', $request->name . ' Gender has been successfully added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gender $gender)
    {
        return view('admin.genders.show', compact('gender'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gender $gender)
    {
        return view('admin.genders.edit', compact('gender'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gender $gender)
    {
        $request->validate([
            'name' => 'required',
            'slug' => "required|unique:genders,slug,$gender->id"
        ]);
        
        $gender->update($request->all());

        return redirect()->route('admin.genders.index')
        ->with('info', $gender->name . ' Gender has been successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gender $gender)
    {
        $gender->delete();
        $this->forgetCache('gendersCount');
        return redirect()->route('admin.genders.index')
        ->with('info', $gender->name . ' Gender has been successfully deleted.');
    }
}
