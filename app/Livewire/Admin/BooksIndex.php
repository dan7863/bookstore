<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Book;
use Livewire\WithPagination;

class BooksIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = "bootstrap";

    public $search;

    public $type;

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {
     
        if($this->type == 'book'){
            $books = Book::where('user_id', auth()->user()->id)
            ->where('title', 'LIKE', '%'.$this->search.'%')
            ->whereDoesntHave('book_purchase_detail')->latest()->paginate(10);
            return view('livewire.admin.books-index', compact('books'));
        }
        elseif($this->type == 'book-purchase-details'){
            $books = Book::where('user_id', auth()->user()->id)
            ->where('title', 'LIKE', '%'.$this->search.'%')
            ->with('book_purchase_detail')->latest()->paginate(10);
            return view('livewire.admin.books-index', compact('books'));
        }
    }
}
