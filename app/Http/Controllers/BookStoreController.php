<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Subgender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookStoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::has('book_purchase_detail')->with('book_purchase_detail')->get();
        $subgenders = Subgender::all(['name', 'id']);
        return view ('books.store.index', ['books' => $books, 'subgenders' => $subgenders]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
        $related_books_by_author = $book->get_related_books_by_author();
        $related_books_by_subgenders = $book->get_related_books_by_subgenders();
        return view('books.store.show', ['book' => $book, 'related_books_by_author' => $related_books_by_author, 'related_books_by_subgenders' => $related_books_by_subgenders]);
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

    public function subgender(Subgender $subgender){
        $books = $subgender->get_related_books();
        return view('books.store.subgender', compact('books', 'subgender'));
    }
}