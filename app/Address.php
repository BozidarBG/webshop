<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    //
    use SoftDeletes;

    protected $fillable=['user_id', 'city', 'post_code', 'street', 'contact', 'phone1',
    'phone2', 'email', 'comment'];

    public function user(){
        $this->belongsTo(User::class);
    }
}
