<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class BookFilterSearch extends Component
{
    use WithPagination;
    
    public $search;
    public $type;
    public $item;
    public $input_placeholder;

    public function updatingSearch(){
        $this->resetPage();
    }
    
    public function render()
    {
        if(get_class($this->item) == "App\Models\Author"){
            $books_search = $this->item->get_related_author($this->search);
            return view('livewire.book-filter-search', compact('books_search'));
        }
        elseif(get_class($this->item) == "App\Models\Subgender"){
            $books_search = $this->item->get_related_books($this->search);
            return view('livewire.book-filter-search', compact('books_search'));
        }
    }
}
