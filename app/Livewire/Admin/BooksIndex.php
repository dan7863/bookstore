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

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {
        $books = Book::where('user_id', auth()->user()->id)->where('title', 'LIKE', '%'.$this->search.'%')->latest()->paginate(10);
        return view('livewire.admin.books-index', compact('books'));
    }
}
