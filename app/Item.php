<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //
    protected $fillable = [
        'supplier_id', 'name', 'image', 'price'
    ];
}
