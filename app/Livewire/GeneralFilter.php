<?php

namespace App\Livewire;

use App\Models\Book;
use Livewire\Component;

class GeneralFilter extends Component
{
    public $search;

    public function render()
    {
        $books_search = [];

        if(!empty($this->search)){
            $books_search = Book::get_related_books($this->search);
        }
        
        return view('livewire.general-filter', compact('books_search'));
    }
}
