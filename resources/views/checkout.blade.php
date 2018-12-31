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
                <h4 class="mb-sm-4 mb-3">Add a new Details</h4>
                <form action="payment.html" method="post" class="creditly-card-form agileinfo_form">
                    <div class="creditly-wrapper wthree, w3_agileits_wrapper">
                        <div class="information-wrapper">
                            <div class="first-row">
                                <div class="controls form-group">
                                    <input class="billing-address-name form-control" type="text" name="name" placeholder="Full Name" required="">
                                </div>
                                <div class="w3_agileits_card_number_grids">
                                    <div class="w3_agileits_card_number_grid_left form-group">
                                        <div class="controls">
                                            <input type="text" class="form-control" placeholder="Mobile Number" name="number" required="">
                                        </div>
                                    </div>
                                    <div class="w3_agileits_card_number_grid_right form-group">
                                        <div class="controls">
                                            <input type="text" class="form-control" placeholder="Landmark" name="landmark" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="controls form-group">
                                    <input type="text" class="form-control" placeholder="Town/City" name="city" required="">
                                </div>
                                <div class="controls form-group">
                                    <select class="option-w3ls">
                                        <option>Select Address type</option>
                                        <option>Office</option>
                                        <option>Home</option>
                                        <option>Commercial</option>

                                    </select>
                                </div>
                            </div>
                            <button class="submit check_out btn">Delivery to this Address</button>
                        </div>
                    </div>
                </form>
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

    @endsection