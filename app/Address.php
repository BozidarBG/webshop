<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //
    protected $fillable=['user_id', 'city', 'post_code', 'street', 'contact', 'phone1',
    'phone2', 'email', 'comment'];
    public function user(){
        $this->belongsTo(User::class);
    }
}
