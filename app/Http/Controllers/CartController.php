<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Address;
use Auth;
use App\Product;
use App\Order;
use App\Cart;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Log;
use Illuminate\Support\Collection;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Cartalyst\Stripe\Exception\CardErrorException;

class CartController extends Controller
{
    //list of product ids that will be bought
    private $ordered_products_ids=[];
    private $existing_ordered_products=[];

    //go to cart
    public function index(){

        return view('checkout')
            ->with('addresses', Address::where('user_id', Auth::id())->get());
    }

    public function store(Request $request)
    {
        //Log::info($request->all());
        //validate request
        $this->validate($request, [
            'address'=>'required|integer',
            'order'=>'required'
        ]);

        //checks if address id exists
        $address=Address::find($request->address);

        if(!$address){
            return response()->json(['address_error']);
        }

        //$deliver_to=$address[0]->post_code.' '.$address[0]->city.' '.$address[0]->street;

        $order=json_decode($request->order, true);

        foreach($order as $item){
            array_push($this->ordered_products_ids, ['id'=>$item['id'], 'quantity'=>$item['ordered_quantity']]);
        }


        //check if products are available. if one is not available, payment will not go. if user has provided id that doesn't
        //exist, payment will go for existing ids
        if($productsArr=$this->checkIfProductsAreAvailable($order)){
            return response()->json(['quantity_error' =>$productsArr]);
        }

        $amount=$this->calculateOrder();
        if($amount == 0){
            //there are no valid ordered products = user has changed html/js
            return response()->json(['no_items_error']);
        }

        //determine order no. (take last order id from DB and add 1. if table is empty, order no. is 1)
        $order=Order::latest()->first();

        if($order){
            $order_no=$order->id+1;
        }else{
            $order_no=1;
        }

        try {
            $charge = Stripe::charges()->create([
                'amount' => $amount,
                'currency' => 'RSD',
                'source' => $request->stripeToken,
                'description' => $order_no."/".date('Y'),
                'receipt_email' => Auth::user()->email,


            ]);

            //payment is ok and we create new rows in the tables orders and carts
            $this->registerOrder($amount, $address);

            //foreach ordered/paid item, we decrease quantity in DB
            $this->decreaseQuantities();

            return view('thank-you');
            //if we have bad card number or some other error, this will alert
        } catch (CardErrorException $e) {
            return back()->withErrors('Error! ' . $e->getMessage());
        }
    }

    protected function decreaseQuantities(){
        foreach($this->existing_ordered_products as $product){
            $DB_product=Product::find($product['id']);
            $DB_product->quantity -= $product['quantity'];
            $DB_product->bought +=$product['quantity'];
            $DB_product->save();
        }
    }

    protected function registerOrder($amount, $address){
        //puts this order in orders table
        $order=new Order();
        $order->user_id=Auth::id();
        $order->total=$amount;
        $order->payment_status=true;
        $order->paid=Carbon::now()->toDateTimeString();
        $order->address_id=$address->id;
        $order->save();

        //puts all products in carts table
        foreach($this->existing_ordered_products as $product){
            $cart=new Cart();
            $cart->order_id=$order->id;
            $cart->user_id=Auth::id();
            $cart->product_id=$product['id'];
            $cart->quantity=$product['quantity'];
            $cart->price=$product['price'];
            $cart->tax=20;
            $cart->discount=$product['discount'];
            $cart->price_w_discount=$product['price']-$product['price']*$product['discount']/100;
            $cart->total=$product['quantity'] * $product['price'];
            $cart->total_w_discount=($product['price']-$product['price']*$product['discount']/100) * $product['quantity'];
            $cart->save();
        }

    }


    //check if ordered products exist and are available before we send payment request to stripe
    //we put in $this->existing_ordered_products only products that exist and they will be calculated in total order
    //if product doesn't exist (user has changed something in html/js) we don't give any response. payment will go for
    //other products
    protected function checkIfProductsAreAvailable($order){
        $noProducts=[];

        foreach($order as $item){
            $product=Product::find($item['id']);
            //if we have this product and enough quantities
            if(isset($product) && $product->quantity >= $item['ordered_quantity'] && $item['ordered_quantity'] > 0){
                //product exists so we put it in existing_products_ids
                array_push($this->existing_ordered_products, [
                    'id'=>$item['id'],
                    'quantity'=>$item['ordered_quantity'],
                    'price'=>$product->price,
                    'discount'=>$product->discount
                ]);

                //product doesn't exist or there are not enough quantities
            }else{
                //product exists but not enough quantities
                if(isset($product)){
                    array_push($noProducts, [
                        'id'=>$product->id,
                        'quantity'=>$product->quantity,
//                        'name'=>$product->name,
//                        'price'=>$product->price,
//                        'discount'=>$product->discount
                    ]);
                }
            }
        }
        return count($noProducts) >0 ? $noProducts : null;
    }

    //calculates total order of products that exist in our DB and returns amount
    protected function calculateOrder(){
        $amount=0;
        foreach($this->existing_ordered_products as $product){
            $amount +=$product['price'] * $product['quantity'] - $product['price'] * $product['quantity'] * $product['discount']/100;
        }
        return $amount;
    }


    //receives array of ids and returns price, available quantity, discount, image
    public function productsByAjax(Request $request){
        if($request->ajax()) {

            $rules = [
                'ids' => 'required|array',
                'ids.*.*' => 'integer', // check each item in the array
            ];

            $validator = Validator::make($request->toArray(), $rules);

            if ($validator->passes()) {
                $products=[];
                $images=[];
                foreach($request->ids as $arr){
                    $product = Product::where('id', $arr['id']) ? Product::where('id', $arr['id'])->select('id', 'name', 'quantity', 'price', 'discount', 'image')->first()->toArray() : null;
                   //if provided product id exists (user didn't touch html)
                    // we find that product, select: id, name, quantity, price and discount
                    //we add "ordered_quantity"=> ordered quantity from user to every $product
                    //we every found product to products array to return to frontend
                    if($product){
                        $productWithQuantity=array_add($product, 'ordered_quantity', $arr['ordered_quantity']);
                        array_push($products, $productWithQuantity);

                        array_push($images, Product::where('id', $arr['id'])->select('id', 'image')->first()->toArray());
                    }
                }

                if (count($products)) {
                    return response()->json(['success' => [$products, $images]]);
                } else {
                    //products don't exist, probably someone has changed html or local storage
                    return response()->json(['error']);
                }

            } else {
                //probably someone has changed html or local storage
                return response()->json(['error']);
            }
        }else{
            return redirect()->back();
        }
    }


}
