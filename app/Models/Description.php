<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Description extends Model
{
    use HasFactory;

    //One to one polymorphic relation
    public function describeable(){
        return $this->morphTo();
    }
}
