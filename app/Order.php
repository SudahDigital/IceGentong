<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    
    public function products(){
        return $this->belongsToMany('App\product')->withPivot('quantity','id');
    }

    public function getTotalQuantityAttribute(){
        $total_quantity = 0;
        foreach($this->products as $p){
        $total_quantity += $p->pivot->quantity;
        }
        return $total_quantity;
    }

}
