<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'gender_id'];

    public function getRouteKeyName(){
        return "slug";
    }

    public function books(){
        return $this->hasMany('App\Models\Book');
    }

    //One to many polymorphic relation

    public function comments(){
        return $this->morphMany('App\Models\Comment', 'commentable');
    }

    //Others

    public function get_related_books($search) {
        return Book::where('author_id', $this->id)
        ->whereHas('book_purchase_detail', function($query){
            $query->where('available_state', 1);
        })
        ->where('user_id', '<>', auth()->id())
        ->where('title', 'LIKE', '%'.$search.'%')
        ->latest('id')
        ->paginate(10);
    }
}
