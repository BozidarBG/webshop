<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    //go to cart
    public function index(){

        return view('checkout');
    }

    //ads a product to the cart. if product exists, update quantity
    public function add(){

    }

    //reduces the quantity of the product
    public function deduct(){

    }




}
