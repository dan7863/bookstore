<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewBookRelease extends Model
{
    use HasFactory;

    public function books(){
        return $this->belongsTo('App\Models\Book');
    }
}
