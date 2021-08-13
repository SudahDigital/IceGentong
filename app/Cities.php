<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    protected $table ='cities';
    protected $fillable = ['province_id','city_name','type','postal_code','area_id'];
}
