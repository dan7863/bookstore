<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookPurchaseDetail;
use App\Services\BookService;
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
        $book_service = new BookService();
        $book_service->createBook($request);
        return redirect()->route('admin.books.index')
        ->with('info', $request->title . ' Book has been successfully loaded.');
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
        $request->merge(['book_id' => $book->id]);
        $book_purchase_detail = BookPurchaseDetail::where('book_id', $book->id)->first();
        if($book_purchase_detail){
            $book_purchase_detail->update($request->all());
        }
        else{
            BookPurchaseDetail::create($request->all());
        }
        return redirect()->route('admin.book-purchase-details.index')
        ->with('info', $book->title . ' Book Purchase Detail has been successfully placed for sale.');
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
        $request->validate([
            'file' => 'required|file|mimetypes:application/epub+zip,application/zip',
        ]);
        $auth_id = auth()->id();
        $file = $request->file('file');
        $path = storage_path('app/public/temporal/'.$auth_id);
        !file_exists($path) ?  mkdir($path, 0755, true) : '';
        $current_path = $file->storeAs('temporal/'.$auth_id, $file->getClientOriginalName(), 'public');
        $book_service = new BookService;
        $ebook = $book_service->processFile(public_path('/storage/'.$current_path));
        $book_validation = Book::where('user_id', $auth_id)->where('title', $ebook['title'])->first();
        if(!empty($book_validation)){
            $temporal_file_path = public_path('/storage/'.$current_path);
            if (file_exists($temporal_file_path)) {
                unlink($temporal_file_path);
            }
            return redirect()->route('admin.books.index')
            ->with('error', $ebook['title'] . ' Book is Already Loaded.');
        }

        return view('admin.books.create', compact('ebook'));
    }
}
