@extends('layouts.layout')

@section('title')
    Checkout
    @endsection

    @section('content')
            <!-- checkout page -->
    <div class="privacy py-sm-5 py-4">
        <div class="container py-xl-4 py-lg-2">
            <!-- tittle heading -->
            <h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
                <span>C</span>heckout
            </h3>
            <!-- //tittle heading -->
            <div class="checkout-right">
                <h4 class="mb-sm-4 mb-3">Your shopping cart contains:
                    <span>3 Products</span>
                </h4>

                <div class="row table_header bg-dark">
                    <div class="col-md-1 col-sm-1 col-xs-1">
                        ID
                    </div>
                    <div class="col-md-1 col-sm-1 col-xs-1">
                        Image
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-2">
                        Qty
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-4">
                        Name
                    </div>
                    <div class="col-md-1 col-sm-1 col-xs-1">
                        Price
                    </div>
                    <div class="col-md-1 col-sm-1 col-xs-1">
                        Discount
                    </div>
                    <div class="col-md-1 col-sm-1 col-xs-1">
                        Price with<br>discount
                    </div>
                    <div class="col-md-1 col-sm-1 col-xs-1">
                        Remove
                    </div>
                </div>
                {{--            @foreach($products as $product)--}}
                <div class="row table_row">
                    <div class="col-md-1 col-sm-1 col-xs-1">
                        1
                    </div>
                    <div class="col-md-1 col-sm-1 col-xs-1">
                        img
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-2">
                        <div class="quantity_selector">
                            <button class="btn btn-outline-danger" > - </button>
                            <button class="btn btn-success quantity_selected" disabled>5</button>
                            <button class="btn btn-outline-primary" > + </button>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-4">
                        Name
                    </div>
                    <div class="col-md-1 col-sm-1 col-xs-1">
                        55
                    </div>
                    <div class="col-md-1 col-sm-1 col-xs-1">
                        0
                    </div>
                    <div class="col-md-1 col-sm-1 col-xs-1">
                        55
                    </div>
                    <div class="col-md-1 col-sm-1 col-xs-1">
                        -
                    </div>
                </div>
                {{--@endforeach--}}
                {{--start totals--}}
                <div class="row table_row ">
                    <div class="col-md-9 col-sm-9 col-xs-9 without_discount">

                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-2">
                        Total without discount
                    </div>
                    <div class="col-md-1 col-sm-1 col-xs-1 ">
                        1.231,12
                    </div>
                </div>
                <div class="row table_row ">
                    <div class="col-md-9 col-sm-9 col-xs-9 with_discount">

                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-2">
                        Total discount
                    </div>
                    <div class="col-md-1 col-sm-1 col-xs-1 ">
                        30,00
                    </div>
                </div>
                <div class="row table_row">
                    <div class="col-md-9 col-sm-9 col-xs-9 ">

                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-2">
                        Total with discount
                    </div>
                    <div class="col-md-1 col-sm-1 col-xs-1 ">
                        1.201,12
                    </div>
                </div>

            </div>
            <div class="checkout-left">
                <div class="address_form_agile mt-sm-5 mt-4">
                    <h4 class="mb-sm-4 mb-3">Chose delivery address or <a href="{{route('address.create')}}" class="text-warning">add new address</a></h4>
                    <div class="form-group">
                        <select class="form-control" name="address">
                            @forelse($addresses as $address)
                                <option value="{{$address->id}}">{{$address->street}} {{$address->city}}</option>
                            @empty
                                <option>You don't have any addresses to deliver to</option>
                            @endforelse
                        </select>
                    </div>
                    <div class="checkout-right-basket">
                        <a href="payment.html">Make a Payment
                            <span class="far fa-hand-point-right"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- //checkout page -->
@endsection

@section('scripts')
    <script src="{{asset('js/checkout.js')}}"></script>
@endsection


<div class="row bg-dark text-center text-white">
    <div class="col-md-1 col-sm-1 col-xs-1  border border-right border-white">
        ID
    </div>
    <div class="col-md-1 col-sm-1 col-xs-1 border border-right border-white">
        Image
    </div>
    <div class="col-md-2 col-sm-2 col-xs-2 border border-right border-white">
        Qty
    </div>
    <div class="col-md-4 col-sm-4 col-xs-4 border border-right border-white">
        Name
    </div>
    <div class="col-md-1 col-sm-1 col-xs-1 border border-right border-white">
        Price
    </div>
    <div class="col-md-1 col-sm-1 col-xs-1 border border-right border-white">
        Discount
    </div>
    <div class="col-md-1 col-sm-1 col-xs-1 border border-right border-white">
        Price with<br>discount
    </div>
    <div class="col-md-1 col-sm-1 col-xs-1 border border-right-0">
        Remove
    </div>
</div>

<div class="row text-center text-dark">
    <div class="col-md-1 col-sm-1 col-xs-1  border border-right border-dark">
        ID
    </div>
    <div class="col-md-1 col-sm-1 col-xs-1 border border-right border-dark">
        Image
    </div>
    <div class="col-md-2 col-sm-2 col-xs-2 border border-right border-white">
        Qty
    </div>
    <div class="col-md-4 col-sm-4 col-xs-4 border border-right border-white">
        Name
    </div>
    <div class="col-md-1 col-sm-1 col-xs-1 border border-right border-white">
        Price
    </div>
    <div class="col-md-1 col-sm-1 col-xs-1 border border-right border-white">
        Discount
    </div>
    <div class="col-md-1 col-sm-1 col-xs-1 border border-right border-white">
        Price with<br>discount
    </div>
    <div class="col-md-1 col-sm-1 col-xs-1 border border-right-0">
        Remove
    </div>
</div>