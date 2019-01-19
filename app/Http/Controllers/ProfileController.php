<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Address;
use App\Order;
use Auth;

class ProfileController extends Controller
{
    public function show(){
        return view('profile')
            ->with('addresses', Address::where('user_id', Auth::id())->get())
            ->with('orders', Order::with('address', 'carts')->where('user_id', Auth::id())->get());
    }


}
