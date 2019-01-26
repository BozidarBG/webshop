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
        }elseif($this->delivery_status==1){
            return "In preparation";
        }elseif($this->delivery_status==2){
            return "In transit";
        }elseif($this->delivery_status==3){
            return "Delivered";
        }elseif($this->delivery_status==4){
            return "Returned";
        }else{
            return "Unknown";
        }
    }
}
