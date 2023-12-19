<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function order_line(){
        return $this->belongsTo('App\Models\OrderLine');
    }

    public function book(){
        return $this->belongsTo('App\Models\Book');
    }

    public function progress_states(){
        return $this->morphOne('App\Models\ProgressState', 'progress_stateable');
    }
}
