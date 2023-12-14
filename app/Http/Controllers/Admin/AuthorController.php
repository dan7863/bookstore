<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;
use App\Traits\Cacheable;

class AuthorController extends Controller
{
    use Cacheable;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = Author::all();
        return view('admin.authors.index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         //USING LARAVEL COLLECTIVE TO MAKE FORMS
         return view('admin.authors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:authors'
        ]);
        Author::create($request->all());
        $this->forgetCache('authorsCount');
        return redirect()->route('admin.authors.index')
        ->with('info', $request->name . ' Author has been successfully added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        return view('admin.authors.show', compact('author'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author)
    {
        return view('admin.authors.edit', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Author $author)
    {
        $request->validate([
            'name' => 'required',
            'slug' => "required|unique:authors,slug,$author->id"
        ]);
        
        $author->update($request->all());

        return redirect()->route('admin.authors.index')
        ->with('info', $author->name . ' Author has been successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        $author->delete();
        $this->forgetCache('authorsCount');
        return redirect()->route('admin.authors.index')
        ->with('info', $author->name . ' Author has been successfully deleted.');
    }
}
