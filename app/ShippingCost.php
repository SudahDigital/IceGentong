<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShippingCost extends Model
{
    protected $table ='shipping_cost';
    protected $fillable = ['id','price','set_cost'];
}
