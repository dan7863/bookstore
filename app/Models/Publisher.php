<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    use HasFactory;

    public function books(){
        return $this->hasMany('App\Models\Book');
    }

    //One to many polymorphic relation

    public function comments(){
        return $this->morphMany('App\Models\Comment', 'commenteable');
    }
}
