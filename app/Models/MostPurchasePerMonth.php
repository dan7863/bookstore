<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MostPurchasePerMonth extends Model
{
    use HasFactory;
    protected $table = 'most_purchases_per_month';

    public function books(){
        return $this->belongsTo('App\Models\Book');
    }
}
