<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $property="";
        for($i=1; $i<8; $i++){
            $property .="<li>property ".$i."</li>";
        }
        for($i=0; $i<100; $i++){
            $brand=DB::table('brands')->inRandomOrder()->first();
            $category=DB::table('categories')->inRandomOrder()->first();
            $product=new \App\Product();
            $product->code=str_random(10);
                $product->brand_id=$brand->id;
            $product->tax_id=1;
            $product->name=$brand->name.' '.$category->name.' model '.random_int(1,100);
            $product->excerpt=$brand->name.' '.$category->name.' dolores sit sint laboriosam dolorem culpa et autem. Beatae nam sunt fugit';
            $product->description=$property;
            $product->price=random_int(100, 200000);
            $product->quantity=random_int(0,100);
            $product->save();

            DB::table('category_product')->insert([
                'category_id'=>$category->id,
                'product_id'=>$product->id
            ]);

        }

    }
}
