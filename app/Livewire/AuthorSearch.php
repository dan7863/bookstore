<?php

namespace App\Livewire;

use App\Models\Author;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AuthorSearch extends Component
{

    public $char;

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {
        $alphabet = range('A', 'Z');
        $author_alphabet = Author::select(DB::raw('UPPER(SUBSTRING(name, 1, 1)) as first_letter, name'))
        ->whereHas('books', function ($query) {
            $query->whereHas('book_purchase_detail', function ($subQuery) {
                $subQuery->where('available_state', 1);
            });
        })
        ->distinct()
        ->orderBy('name', 'ASC')
        ->pluck('first_letter')
        ->toArray();

        if(!empty($author_alphabet) && empty($this->char)){
            $this->char = $author_alphabet[0];
        }

        $authors = Author::where('name', 'LIKE', $this->char.'%')
        ->whereHas('books', function ($query) {
            $query->whereHas('book_purchase_detail', function ($subQuery) {
                $subQuery->where('available_state', 1);
            });
        })
        ->orderBy('name', 'ASC')
        ->get();

        return view('livewire.author-search', ['alphabet' => $alphabet,
        'author_alphabet' => $author_alphabet, 'authors' => $authors]);
    }
}
