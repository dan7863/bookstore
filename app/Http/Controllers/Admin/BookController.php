<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use App\Models\Description;
use App\Models\Image;
use App\Models\Subgender;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        $request->merge(['user_id' => auth()->id()]);
        if(!empty($request->author)){
            $author_name = ucwords($request->author);
            $author = Author::firstOrCreate(['name' => $author_name, 'slug' => Str::slug($author_name)]);
            $request->merge(['author_id' => $author->id]);
            unset($request['author']);
        }

        $request->merge(['url' => 'ebooks/'.auth()->id().'/'.$request->file_name.$request->type]);
        unset($request['type']);
        unset($request['file_name']);

        unset($request['publisher']);
        $request->merge(['publisher_id' => null]);

        //Otras tablas
        unset($request['language']);
        unset($request['subgenders']);
        
        // if(!empty($request->subgenders)){
        //     $subgenders = explode('/', $request->subgenders);
        //     foreach($subgenders as $subgender){
        //         $upper_subgender = ucwords($subgender);
        //         $subgender = Subgender::firstOrCreate(['name' => $upper_subgender, 'slug' => Str::slug($upper_subgender)]);
        //         $subgender->books()->attach()

        //     }
        // }

        $image = $request['image'];
        $description = $request['description'];

        unset($request['image']);
        unset($request['description']);
        $book = Book::create($request->all());
        $image_url = $book->save_book_image($image);
        Image::create([
            'url' => $image_url,
            'imageable_id' => $book->id,
            'imageable_type' => Book::class
        ]);

        Description::create([
            'description' => $description,
            'describeable_id' => $book->id,
            'describeable_type' => Book::class
        ]);

        return $request->all();
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
        $path = storage_path('app/public/temporal');
        !file_exists($path) ?  mkdir($path, 0755, true) : '';
        $current_path = $file->storeAs('temporal', $file->getClientOriginalName(), 'public');
        $book = new Book;
        $ebook = $book->process_file(public_path('/storage/'.$current_path));
        $cover = $ebook['cover'];
        return view('admin.books.create', compact('ebook'));
    }
}
