<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookPurchaseDetail;
use App\Services\BookService;
use Illuminate\Http\Request;
use App\Traits\Cacheable;

class BookController extends Controller
{
    use Cacheable;
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
        $this->flushCache();
        return redirect()->route('admin.books.index')
        ->with('info', $request->title . ' Book has been successfully loaded.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        $this->authorize('userOrPurchased', $book);
        return view('admin.books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $this->authorize('user', $book);
        return view('admin.books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $this->authorize('user', $book);
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
        $this->authorize('user', $book);
        $book->delete();
        $this->flushCache();
     
        return redirect()->route('admin.books.index')
        ->with('info', $book->title . ' Book has been successfully deleted.');
    }

    public function upload_file(Request $request){
        $request->validate([
            'file' => 'required|file|mimetypes:application/epub+zip,application/zip|max:10240',
        ]);
        $book_service = new BookService;
        $result = $book_service->saveTemporalFile($request);
        if($result['exists']){
            return redirect()->route('admin.books.index')
            ->with('error', $result['ebook']['title'] . ' Book is Already Loaded.');
        }
        
        return view('admin.books.create', ['ebook' => $result['ebook']]);
    }

    public function read(Book $book)
    {
        $this->authorize('userOrPurchased', $book);
        return view('admin.books.read', compact('book'));
    }
}
