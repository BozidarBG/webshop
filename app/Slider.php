<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    //
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
