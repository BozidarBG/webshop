<?php

use Faker\Generator as Faker;

$factory->define(App\Address::class, function (Faker $faker) {

    return [
        'user_id'=>random_int(1,19),
        'city'=>$faker->city,
        'post_code'=>$faker->postcode,
        'street'=>$faker->address,
        'contact'=>$faker->name,
        'phone1'=>$faker->phoneNumber,
        'phone2'=>$faker->phoneNumber,
        'email'=>$faker->email,
        'comment'=>$faker->sentence(8)
    ];
});

