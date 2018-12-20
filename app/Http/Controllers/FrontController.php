<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Brand;

class FrontController extends Controller
{
    public function welcome(){
        return view('welcome')
            ->with('title', 'Our products')
            ->with('products', Product::where('quantity','>', 0)->inRandomOrder()->take(15)->get());

    }
//show all products that belongs to the given category
    public function category($slug){

        $category=Category::where('slug', $slug)->first();
        if(!isset($category)){
            return redirect()->back();
        }
        $products=Category::find($category->id)->products()->get();
        //dd($products);
        return view('welcome')
            ->with('title', $category->name)
            ->with('products', Category::find($category->id)->products()->where('quantity','>', 0)->paginate(15));
    }

    //show single product, by slug. if slug doesn't exist, return back without error msg
    public function product($slug){
        $product=Product::where('slug', $slug)->first();
        if(!isset($product)){
            return redirect()->back();
        }
        return view('single-product')->with('product', $product);
    }

    //show all products for a given brand.
    public function brand($slug){
        $brand=Brand::where('slug', $slug)->first();
        if(!isset($brand)){
            return redirect()->back();
        }
        $products=Product::where('brand_id', $brand->id)->where('quantity','>', 0)->paginate(15);
        //dd($products);
        return view('welcome')
            ->with('title', $brand->name)
            ->with('products', $products);
    }
}
