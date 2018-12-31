<?php

namespace App\Http\Controllers;

use App\Address;
use Illuminate\Http\Request;
use Session;
use Auth;
use Log;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('add-address');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //\Log::info($request->all());
        $this->validate($request, [
            'city'=>'required|string',
            'post_code'=>'required|string',
            'street'=>'required|string',
            'contact'=>'nullable|string',
            'phone1'=>'required|string',
            'phone2'=>'nullable|string',
            'email'=>'nullable|email',
            'comment'=>'nullable|string'
        ]);

        $address=new Address();
        $address->user_id=Auth::id();
        $address->city=$request->city;
        $address->post_code=$request->post_code;
        $address->street=$request->street;

        if($request->contact == null){
            $address->contact=Auth::user()->name;
        }else{
            $address->contact=$request->contact;
        }
        $address->phone1=$request->phone1;
        $address->phone2=$request->phone2;

        if($request->email == null){
            $address->email=Auth::user()->email;
        }else{
            $address->email=$request->email;
        }

        $address->comment=$request->comment;

        if($address->save()){
            Session::flash('success', 'Address '.$address->street.' created successfully!');
            return redirect()->route('profile.show');
        }else{
            Session::flash('error', 'There was some error on the server');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function show(Address $address)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function edit(Address $address)
    {
        return view('edit-address')->with('address', $address);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Address $address)
    {
        $this->validate($request, [
            'city'=>'required|string',
            'post_code'=>'required|string',
            'street'=>'required|string',
            'contact'=>'nullable|string',
            'phone1'=>'required|string',
            'phone2'=>'nullable|string',
            'email'=>'nullable|email',
            'comment'=>'nullable|string'
        ]);


        //$address->user_id=Auth::id();
        $address->city=$request->city;
        $address->post_code=$request->post_code;
        $address->street=$request->street;

        if($request->contact == null){
            $address->contact=Auth::user()->name;
        }else{
            $address->contact=$request->contact;
        }
        $address->phone1=$request->phone1;
        $address->phone2=$request->phone2;

        if($request->email == null){
            $address->email=Auth::user()->email;
        }else{
            $address->email=$request->email;
        }

        $address->comment=$request->comment;

        if($address->save()){
            Session::flash('success', 'Address '.$address->street.' changed successfully!');
            return redirect()->route('profile.show');
        }else{
            Session::flash('error', 'There was some error on the server');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address)
    {
        if($address->delete()){
            return response()->json('success');
        }else{
            return response()->json('error');
        }

    }
}
