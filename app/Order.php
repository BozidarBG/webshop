<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //carts = items in order
    public function carts(){
        return $this->hasMany(Cart::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function formatPrice(){
        return number_format($this->total, 2, ',', '.').' RSD';
    }

    public function deliveryStatus(){
        if($this->delivery_status == 0){
            return "Undelivered";
        }elseif($this->delivery_statuy==1){
            return "In Transit";
        }elseif($this->delivery_statuy==2){
            return "Delivered";
        }else{
            return "In Preparation";
        }
    }
}
