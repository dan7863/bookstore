<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    use HasFactory;

    //One to many relation
    public function subgenders(){
        return $this->hasMany('App\Models\Subgender');
    }

    public function description(){
        return $this->morphOne('App\Models\Description', 'descripteable');
    }
}
