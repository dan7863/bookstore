<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderInvoice extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function order_line(){
        return $this->belongsTo('App\Models\OrderLine');
    }
}
