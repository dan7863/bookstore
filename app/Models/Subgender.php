<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subgender extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'gender_id'];

    public function getRouteKeyName(){
        return "slug";
    }

    public function gender(){
        return $this->belongsTo('App\Models\Gender');
    }

    public function books(){
        return $this->belongsToMany('App\Models\Book');
    }

    public function description(){
        return $this->morphOne('App\Models\Description', 'describeable');
    }

    //Others

    public function get_related_books($search) {
        return Book::whereHas('subgenders', function ($query) {
                $query->where('subgender_id', $this->id);
            })
        ->where('title', 'LIKE', '%'.$search.'%')
        ->where('user_id', '<>', auth()->id())
        ->whereHas('book_purchase_detail')
        ->with('book_purchase_detail')
        ->latest('id')
        ->paginate(20);
    }

}
