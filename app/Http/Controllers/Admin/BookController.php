<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.books.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
     
        return view('admin.books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return view('admin.books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        return view('admin.books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('admin.books.index')
        ->with('info', $book->title . ' Book has been successfully deleted.');
    }

    public function upload_file(Request $request){
        $file = $request->file('file');
        $path = storage_path('app/public/temporal'); // Set your desired folder name
        !file_exists($path) ?  mkdir($path, 0755, true) : '';
        $current_path = $file->storeAs('temporal', $file->getClientOriginalName(), 'public');
        $book = new Book;
        $ebook = $book->process_file(public_path('/storage/'.$current_path));
        return view('admin.books.create', compact('ebook'));
    }
}
