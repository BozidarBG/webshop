<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    //go to cart
    public function index(){

        return view('cart');
    }
}
