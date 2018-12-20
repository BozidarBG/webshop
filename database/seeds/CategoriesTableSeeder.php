<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr=['Android Phones',  'Smartphones', 'Tablets', 'CDMA Phones', 'Laptops', 'Printers','Routers','Ink & Toner Cartridges', 'Monitors', 'Video Games',
            'TVs & DTH',  'Home Theatre Systems', 'Hidden Cameras & CCTVs', 'Refrigerators','Washing Machines', 'Air Conditioners', 'Cameras', 'Speakers'
        ];
        foreach($arr as $item){
            $cat=new Category();
            $cat->name=$item;
            $cat->save();
        }
    }
}
