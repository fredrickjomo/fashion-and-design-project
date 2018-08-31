<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    //
    protected $fillable=[
        'product_id','product_quantity','product_price','designer_id'
    ];
}
