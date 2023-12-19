<?php

namespace App\Livewire;

use App\Models\Gender;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class GenderSearch extends Component
{

    public $char;

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {
        $alphabet = range('A', 'Z');
        $gender_alphabet = Gender::select(DB::raw('UPPER(SUBSTRING(name, 1, 1)) as first_letter'))
        ->distinct()
        ->orderBy('name', 'ASC')
        ->pluck('first_letter')
        ->toArray();

        if(!empty($gender_alphabet) && empty($this->char)){
            $this->char = $gender_alphabet[0];
        }

        $genders = Gender::where('name', 'LIKE', $this->char.'%')
        ->orderBy('name', 'ASC')->get();

        return view('livewire.gender-search', ['alphabet' => $alphabet,
        'gender_alphabet' => $gender_alphabet, 'genders' => $genders]);
    }
}
