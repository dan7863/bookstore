<?php

namespace App\Livewire;

use App\Models\Publisher;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PublisherSearch extends Component
{

    public $char;

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {
        $alphabet = range('A', 'Z');
        $publisher_alphabet = publisher::select(DB::raw('UPPER(SUBSTRING(name, 1, 1)) as first_letter, name'))
        ->whereHas('books', function ($query) {
            $query->whereHas('book_purchase_detail', function ($subQuery) {
                $subQuery->where('available_state', 1);
            });
        })
        ->distinct()
        ->orderBy('name', 'ASC')
        ->pluck('first_letter')
        ->toArray();

        if(!empty($publisher_alphabet) && empty($this->char)){
            $this->char = $publisher_alphabet[0];
        }

        $publishers = publisher::where('name', 'LIKE', $this->char.'%')
        ->whereHas('books', function ($query) {
            $query->whereHas('book_purchase_detail', function ($subQuery) {
                $subQuery->where('available_state', 1);
            });
        })
        ->orderBy('name', 'ASC')
        ->get();

        return view('livewire.publisher-search', ['alphabet' => $alphabet,
        'publisher_alphabet' => $publisher_alphabet, 'publishers' => $publishers]);
    }
}
