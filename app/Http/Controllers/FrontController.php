<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Brand;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

class FrontController extends Controller
{
    public function welcome(Request $request){

        $products=Product::where('quantity', '>', 0)->where('price', '>', 0);

        $products=$this->sortProducts($request, $products);

        $products=$products->get();

        $products=$this->customPaginate($products);
        return view('products')
            ->with('title', 'Our products')
            ->with('products', $products);

    }
    //show all products that belongs to the given category
    public function category(Request $request, $slug){

        $category=Category::where('slug', $slug)->first();
        if(!isset($category)){
            return redirect()->back();
        }

        $products=Category::find($category->id)->products()->where('quantity', '>', 0)->where('price', '>', 0);

        $products=$this->sortProducts($request, $products);

        $products=$products->get();

        $products=$this->customPaginate($products);


        return view('products')
            ->with('title', $category->name)
            ->with('products', $products);
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
    public function brand(Request $request, $slug){
        //dd($request->all());
        $brand=Brand::where('slug', $slug)->first();
        if(!isset($brand)){
            return redirect()->back();
        }

        $products=Product::where('brand_id', $brand->id)->where('quantity', '>', 0)->where('price', '>', 0);

        $products=$this->sortProducts($request, $products);

        $products=$products->get();

        $products=$this->customPaginate($products);



        //$products=Product::where('brand_id', $brand->id)->paginate(15);
        //dd($products);
        return view('products')
            ->with('title', $brand->name)
            ->with('products', $products);
    }

    protected function sortProducts($request, $products){
        //dd($products);
        if($request->has('sort')){
            if($request->sort=="low_high"){
                return $products->orderBy('price', 'asc');
            }elseif($request->sort=="high_low"){
                return $products->orderBy('price', 'desc');
            }else{
                return $products;
            }
        }else{
            return $products;
        }
    }

    //shows about page
    public function about(){
        return view('about');
    }

    //shows contact page
    public function contact(){
        return view('contact');
    }

    //stores message sent via contact form
    public function contactUs(Request $request){

        $this->validate($request, [
            'name'=>'required|max:200',
            'email'=>'required|email',
            'body'=>'required|string'
        ]);

        $contact=new \App\Contact();
        $contact->name=$request->name;
        $contact->email=$request->email;
        $contact->body=$request->body;
        if($contact->save()){
            return response()->json('success');
        }else{
            return response()->json('error');
        }

    }

    public function range(Request $request){
       // \Log::info($request->all());
        $this->validate($request, [

            'page_name'=>'required|string'
        ]);
        if(!isset($request->from)){
            $request->from=0;
        }

        if(!isset($request->to)){
            $request->to=9999999;
        }

        $page=$request->page_name;


        if($category=Category::where('name', $page)->first()){
            //return all products from that category, with price range

            $products=Category::find($category->id)->products()->whereBetween('price', [$request->from, $request->to])->orderBy('price', 'asc')->paginate(15);
            $title=$category->name.' - price range from: '.number_format($request->from, 2, ',', '.').' to: '.number_format($request->to, 2, ',', '.');
        }elseif($brand=Brand::where('name', $page)->first()){
            //it is all product by brand, with price range
            $products=Product::where('brand_id', $brand->id)->whereBetween('price', [$request->from, $request->to])->orderBy('price', 'asc')->paginate(15);
            $title=$brand->name.' - price range from: '.number_format($request->from, 2, ',', '.').' to: '.number_format($request->to, 2, ',', '.');
        }else{
            //it is root page or user changed html
            $products=$this->customPaginate(Product::whereBetween('price', [$request->from, $request->to])->orderBy('price', 'asc')->get());
            $title=$request->page_name.' - price range from: '.number_format($request->from, 2, ',', '.').' to: '.number_format($request->to, 2, ',', '.');
        }


        return view('products')->with('title', $title)->with('products', $products);
    }

    private function customPaginate($productsCollection){

        $page=LengthAwarePaginator::resolveCurrentPage();
        $perPage=15;

        //from which element in collection we slice and how many elements
        //index starts at 0. if we are on the first page, (1-1)*0=0. from 0 to 10th element (without id 10)
        //if we are on the second page, it will be (2-1)*10 = 10, from 10th to ...
        $results=$productsCollection->slice(($page-1)*$perPage, $perPage)->values();

        //results, number of elements, per page (15), current page and options
        //path will help us to find next and previous page
        $paginated = new LengthAwarePaginator($results, $productsCollection->count(), $perPage, $page,[
            'path'=>LengthAwarePaginator::resolveCurrentPath()
        ]);

        //we need to state to include other parameters in order not to ignore per_page=$x
        //http://simpleapi.test/api/articles?per_page=3&page=2
        //$paginated->appends(request()->all());

        return $paginated;
    }

    public function search(Request $request){
        $this->validate($request, [
            'item'=>'string|required'
        ]);

        $products=Product::where('name', 'like', '%'.$request->item.'%') ? Product::where('name', 'like', '%'.$request->item.'%')->paginate(15) : null;

        return view('products')
            ->with('title', 'Search')
            ->with('products', $products);
    }

}
