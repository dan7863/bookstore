<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subgender extends Model
{
    use HasFactory;

    public function gender(){
        return $this->belongsTo('App\Models\Gender');
    }

    public function books(){
        return $this->belongsToMany('App\Models\Book');
    }

    public function description(){
        return $this->morphOne('App\Models\Description', 'descripteable');
    }
}
