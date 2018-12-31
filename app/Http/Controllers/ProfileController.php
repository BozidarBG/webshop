<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Address;
use Auth;

class ProfileController extends Controller
{
    public function show(){
        return view('profile')->with('addresses', Address::where('user_id', Auth::id())->get());
    }


}
