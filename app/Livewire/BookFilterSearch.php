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
        $class_item = get_class($this->item);
        if($class_item == "App\Models\Author" || $class_item == "App\Models\Subgender"
        || $class_item == "App\Models\Publisher"){
            $books_search = $this->item->get_related_books($this->search);
            return view('livewire.book-filter-search', compact('books_search'));
        }
    }
}
