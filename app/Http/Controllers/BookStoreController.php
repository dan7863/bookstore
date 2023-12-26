<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\BookPurchaseDetail;
use App\Models\Comment;
use App\Models\OrderLine;
use App\Models\Publisher;
use App\Models\Subgender;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

class BookStoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentDate = new DateTime();
        $firstDayOfMonth = new DateTime($currentDate->format('Y-m-01'));
        $lastDayOfMonth = new DateTime($currentDate->format('Y-m-t'));
        $books_release = Book::whereHas('new_book_releases', function ($query) use($firstDayOfMonth, $lastDayOfMonth){
            $query->where('first_of_month', $firstDayOfMonth)->where('last_of_month', $lastDayOfMonth);
        
        })
        ->with('book_purchase_detail')
        ->with('image')
        ->where('user_id', '<>', auth()->id())
        ->get();

        if(count($books_release) == 0){
            $books_release = Book::whereHas('book_purchase_detail', function ($query){
                $query->select('book_id')->where('available_state', 1)
                ->whereBetween('created_at', [
                    Carbon::now()->startOfMonth(),
                    Carbon::now()->endOfMonth()
                ]);
            })
            ->with('book_purchase_detail')
            ->with('image')
            ->where('user_id', '<>', auth()->id())
            ->take(100)->get();
        }

        
        $most_purchases_per_month = Book::whereHas('most_purchases_per_month',
        function ($query) use($firstDayOfMonth, $lastDayOfMonth){
            $query->where('first_of_month', $firstDayOfMonth)->where('last_of_month', $lastDayOfMonth);
        })
        ->with('book_purchase_detail')
        ->with('image')
        ->where('user_id', '<>', auth()->id())
        ->get();
        return view ('books.store.index', compact('books_release', 'most_purchases_per_month'));
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
        $this->authorize('available', $book);
        
        $related_books_by_author = $book->get_related_books_by_author();
        $related_books_by_subgenders = $book->get_related_books_by_subgenders();
        $own_book = $book->user->id == auth()->id();
        $bookId = $book->id;
        $buyed_book = OrderLine::whereHas('purchase_orders', function ($query) use ($bookId) {
            $query->where('book_id', $bookId);
        })->where('buyer_id', auth()->id())->exists();
        return view('books.store.show', [
            'book' => $book,
            'related_books_by_author' => $related_books_by_author,
            'related_books_by_subgenders' => $related_books_by_subgenders,
            'buyed_book' => $buyed_book,
            'buying_status' => $own_book || $buyed_book ? false : true,
        ]);
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
        return view('books.store.result-book-search',
        ['title' => 'Subgender', 'item' => $subgender,
        'input_placeholder' => 'Search through '.$subgender->name.'\'s books...']);
    }

    public function authorIndex(){
        return view('books.store.authors');
    }

    public function authorShow(Author $author){
        return view('books.store.result-book-search',
        ['title' => 'Author', 'item' => $author,
        'input_placeholder' => 'Search through '.$author->name.'\'s books...']);
    }

    public function genderIndex(){
        return view('books.store.genders');
    }

    public function publisherIndex(){
        return view('books.store.publishers');
    }

    public function publisherShow(Publisher $publisher){
        return view('books.store.result-book-search',
        ['title' => 'Publisher', 'item' => $publisher,
        'input_placeholder' => 'Search through '.$publisher->name.'\'s books...']);
    }

    public function rateBook(Request $request, Book $book){

        $request->validate([
            'stars' => 'required',
            'message' => 'required|max:500'
        ]);

        Comment::create([
            'message' => $request->message,
            'stars' => $request->stars,
            'user_id' => auth()->id(),
            'commentable_id' => $book->id,
            'commentable_type' => Book::class
        ]);

        return redirect()->route('books_store.show', compact('book'));
    }
}
