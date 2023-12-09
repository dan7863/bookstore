<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'gender_id'];

    public function getRouteKeyName(){
        return "slug";
    }

    public function books(){
        return $this->hasMany('App\Models\Book');
    }

    public function description(){
        return $this->morphOne('App\Models\Description', 'describeable');
    }
    

    //One to many polymorphic relation

    public function comments(){
        return $this->morphMany('App\Models\Comment', 'commentable');
    }
}
