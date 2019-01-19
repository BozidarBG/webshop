@extends('layouts.layout')

@section('title')
    Checkout
@endsection

@section('styles')

<script src="https://js.stripe.com/v3/"></script>
<style>
    /**
 * The CSS shown here will not be introduced in the Quickstart guide, but shows
 * how you can use CSS to style your Element's container.
 */
    .StripeElement {
        background-color: white;
        /*height: 40px;*/
        padding: 10px 12px;

        border: 1px solid black;
        box-shadow: 0 1px 3px 0 #e6ebf1;

        transition: box-shadow 150ms ease;
    }

    .StripeElement--focus {
        box-shadow: 0 1px 3px 0 #cfd7df;
    }

    .StripeElement--invalid {
        border-color: #fa755a;
    }

    .StripeElement--webkit-autofill {
        background-color: #fefde5 !important;
    }
</style>
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
            <div id="message" class="py-2"></div>
            <div class="row bg-dark text-center text-white checkout-header">
                <div class="col-md-1 col-sm-1 col-xs-1  border-h-r ">
                    ID
                </div>
                <div class="col-md-1 col-sm-1 col-xs-1 border-h-r">
                    Image
                </div>
                <div class="col-md-2 col-sm-2 col-xs-2 border-h-r">
                    Qty
                </div>
                <div class="col-md-4 col-sm-4 col-xs-4 border-h-r">
                    Name
                </div>
                <div class="col-md-1 col-sm-1 col-xs-1 border-h-r">
                    Price
                </div>
                <div class="col-md-1 col-sm-1 col-xs-1 border-h-r">
                    Discount
                </div>
                <div class="col-1half border-h-r">
                    Price with<br>discount
                </div>
                <div class="col-half">
                    Del
                </div>
            </div>

            <div id="products">

            </div>

            {{--start totals--}}
            <div class="row" id="total1">

            </div>
            <div class="row" id="total2">

            </div>
            <div class="row" id="total3">

            </div>

        </div>
        <div class="checkout-left">
            <div class="address_form_agile mt-sm-5 mt-4">
                <form action="{{route('checkout.store')}}" method="POST" id="payment-form">
                    @csrf
                    <h4 class="mb-sm-4 mb-3">Chose delivery address or <a href="{{route('address.create')}}" class="text-warning">add new address</a></h4>
                    <div class="form-group w-50">
                        <select class="form-control" name="address" required>
                            <option selected disabled>Please select...</option>
                            @forelse($addresses as $address)
                                <option value="{{$address->id}}">{{$address->street}} {{$address->city}}</option>
                            @empty
                                <option>You don't have any addresses to deliver to</option>
                            @endforelse
                        </select>
                    </div>

                    <div class="form-group w-50">
                        <label for="card-element">
                            Credit or debit card
                        </label>
                        <div id="card-element">
                            <!-- A Stripe Element will be inserted here. -->
                        </div>

                        <!-- Used to display form errors. -->
                        <div id="card-errors" role="alert"></div>
                    </div>

                    <div class="checkout-right-basket">
                        <button class="btn btn-dark" type="submit" id="complete-order">Make a Payment
                            <span class="far fa-hand-point-right"></span>
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- //checkout page -->
@endsection

@section('scripts')
    <script src="{{asset('js/cart-modal.js')}}"></script>
    <script src="{{asset('js/checkout.js')}}"></script>
    <script src="{{asset('js/stripe.js')}}">



    </script>
@endsection