<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Book extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function getRouteKeyName(){
        return "slug";
    }


    //One to one relation

    public function book_purchase_detail(){
        return $this->hasOne('App\Models\BookPurchaseDetail');
    }

    //One to many relation

    public function purchase_orders(){
        return $this->hasMany('App\Models\PurchaseOrder');
    }
   
    //One to one relation (reverse)

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    //One to many relation (reverse)

    public function language(){
        return $this->belongsTo('App\Models\Language');
    }
    
    public function author(){
        return $this->belongsTo('App\Models\Author');
    }

    public function publisher(){
        return $this->belongsTo('App\Models\Publisher');
    }

    public function most_purchases_per_month(){
        return $this->hasMany('App\Models\MostPurchasePerMonth');
    }

    public function new_book_releases(){
        return $this->hasMany('App\Models\NewBookRelease');
    }

    //Many to many relation
    public function subgenders(){
        return $this->belongsToMany('App\Models\Subgender');
    }

    public function types(){
        return $this->belongsToMany('App\Models\Type');
    }

    //One to one polymorphic relation
    public function image(){
        return $this->morphOne('App\Models\Image', 'imageable');
    }

    public function description(){
        return $this->morphOne('App\Models\Description', 'describeable');
    }

    //One to many polymorphic relation

    public function comments(){
        return $this->morphMany('App\Models\Comment', 'commentable');
    }

    public function progress_states(){
        return $this->morphOne('App\Models\ProgressState', 'progress_stateable');
    }

    //Others

    public function get_related_books_by_author(){
        return Book::where('author_id', $this->author_id)
        ->where('id', '<>', $this->id)
        ->has('book_purchase_detail')
        ->with('book_purchase_detail')
        ->where(function ($query) {
            // Check for books that have purchase orders
            $query->whereHas('purchase_orders', function ($subquery) {
                $subquery->whereHas('order_line', function ($subquery2) {
                    $subquery2->where('buyer_id', '<>', auth()->id());
                });
            })// Or books that don't have any purchase orders
            ->orWhere(function ($subquery) {
                $subquery->doesntHave('purchase_orders');
            });
        })
        // Exclude books by the current user
        ->where('user_id', '<>', auth()->id())
        ->latest('id')
        ->take(3)
        ->get();
    }
    

    public function get_related_books_by_subgenders() {
        return Book::whereHas('subgenders', function ($query) {
                $query->whereIn('subgender_id', $this->subgenders->pluck('id'));
            })
        ->where('user_id', '<>', auth()->id())
        ->whereHas('book_purchase_detail')
        ->where(function ($query) {
            $query->whereHas('purchase_orders', function ($subquery) {
                $subquery->whereHas('order_line', function ($subquery2) {
                    $subquery2->where('buyer_id', '<>', auth()->id());
                });
            })
            ->orWhereDoesntHave('purchase_orders');
        })
        ->where('id', '<>', $this->id)
        ->with('book_purchase_detail')
        ->latest('id')
        ->take(3)
        ->get();
    }

}
