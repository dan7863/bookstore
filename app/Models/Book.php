<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    //One to one relation

    public function book_purchase_detail(){
        $this->hasOne('App\Models\BookPurchaseDetail');
    }

    //One to many relation

    public function purchase_orders(){
        $this->hasMany('App\Models\PurchaseOrder');
    }
    
    //One to one relation (reverse)

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function author(){
        return $this->belongsTo('App\Models\Author');
    }

    public function publisher(){
        return $this->belongsTo('App\Models\Publisher');
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
        return $this->morphOne('App\Models\Description', 'descripteable');
    }

    //One to many polymorphic relation

    public function comments(){
        return $this->morphMany('App\Models\Comment', 'commenteable');
    }

    public function progress_states(){
        return $this->morphOne('App\Models\ProgressState', 'progress_stateable');
    }

}
