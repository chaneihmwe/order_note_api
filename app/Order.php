<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = [
        'customer_id', 'order_date', 'confirmed_date', 'delivered_date', 'qty', 'total_price'
    ];
}
