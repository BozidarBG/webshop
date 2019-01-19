<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //
    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function formatPrice($price){
        return number_format($price, 2, ',', '.');
    }

    /*
                $table->integer('order_id');
            $table->integer('user_id');
            $table->integer('product_id');
            $table->integer('quantity');
            $table->double('price');
            $table->double('tax');
            $table->double('discount');
            $table->double('price_w_discount');
            $table->double('total');
            $table->double('total_w_discount');

    */
}
