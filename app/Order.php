<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = [
        'customer_name', 'customer_phone_no', 'customer_address', 'order_date', 'confirmed_date', 'delivered_date', 'qty', 'total_price'
    ];
}
