<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use Session;

class VoyagerOrdersController extends \TCG\Voyager\Http\Controllers\VoyagerBreadController
{
    public function show(Order $order){
        return view('vendor.voyager.orders.read')->with('order', $order);
    }

    public function updateDelivery(Request $request, Order $order){
        $this->validate($request, [
            'delivery_status'=>'required|integer'
        ]);

        $order->delivery_status=$request->delivery_status;
        $order->save();
        Session::flash('success', 'Delivery status changed successfully!');
        return redirect()->back();
    }
}
