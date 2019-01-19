<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use DebugBar\DebugBar;

class Product extends Model
{
    //
    use Sluggable;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function category(){
        return $this->belongsToMany(Category::class);
    }

    public function tax(){
        return $this->belongsTo(Tax::class);
    }

    public function getImage($img){
        $image=isset($img) ? str_replace('\\', '/', $img) : null;
        return  $image !=null && file_exists('storage/'.$image) ? asset('storage/'.$image) : asset('storage/placeholders/noimage.jpg');
    }



    public function formatPrice(){
        //return number_format($this->price, 2, ',', '.')
        return number_format($this->price -($this->price*$this->discount/100), 2 ,',', '.').' RSD';
    }

    public function formatPriceWithoutDiscount(){
        return number_format($this->price, 2 ,',', '.').' RSD';
    }

    public function questions(){
        return $this->hasMany(Question::class);
    }
}
