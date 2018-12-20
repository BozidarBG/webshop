<?php

use Illuminate\Database\Seeder;
use App\Brand;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $arr=['Beko', 'Vox', 'Panasonic', 'Sony', 'Lenovo', 'LG', 'Samsung', 'Nokia', 'Huawei',
        'Siemens', 'Acer', 'Toshiba', 'Sharp', 'Electrolux'];


        //name, slug, description, www, logo,
    foreach($arr as $item){
        $brand=new Brand();
        $brand->name=$item;
        $brand->description=$item.' is lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi assumenda corporis cupiditate esse exercitationem expedita fuga impedit iste minus modi mollitia nisi officiis, omnis quaerat quasi rerum, suscipit tenetur unde';
        $brand->www='https://www.'.strtolower($item).'.com';
        $brand->logo='logo.jpg';
        $brand->save();
    }

    }
}
