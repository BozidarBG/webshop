<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    //code, brand id(1,14), tax_id(1,2), name, excerpt, description, price, quantity

    $brand=\DB::table('brands')->inRandomOrder()->first();
    $category=\DB::table('categories')->inRandomOrder()->first();
    return [
        'code'=>str_random(10),
        'brand_id'=>$brand->id,
        'tax_id'=>1,
        'name'=>$brand->name.' '.$category->name.' model '.$faker->word.' '.random_int(1,100),
        'excerpt'=>$faker->sentence(10),
        'description'=>"<li>$faker->sentence(7, true)</li><li>$faker->sentence(7, true)</li><li>$faker->sentence(7, true)</li><li>$faker->sentence(7, true)</li><li>$faker->sentence(7, true)</li><li>$faker->sentence(7, true)</li><li>$faker->sentence(7, true)</li><li>$faker->sentence(7, true)</li>",
        'price'=>$faker->randomFloat(2, 100, 200000),
        'quantity'=>random_int(0,100)
    ];
    \DB::table('category_product')->insert([
        'category_id'=>$category->id,
        'product_id'=>$product->id
    ]);
});
