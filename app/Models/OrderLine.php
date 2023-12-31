<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderLine extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function order_invoice(){
        return $this->hasOne('App\Models\OrderInvoice');
    }

    public function purchase_orders(){
        return $this->hasMany('App\Models\PurchaseOrder');
    }

    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id', 'buyer_id');
    }
}
