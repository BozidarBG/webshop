@extends('layouts.layout')

@section('title')
    {{$product->name}}
@endsection

@section('styles')
<!-- flexslider -->
<link rel="stylesheet" href="{{asset('css/flexslider.css')}}" type="text/css" media="screen" />
@endsection
@section('content')
            <!-- Single Page -->
    <div class="banner-bootom-w3-agileits py-5">
        <div class="container py-xl-4 py-lg-2">
            <!-- tittle heading -->
            <h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
                {{$product->name}}</h3>
            <!-- //tittle heading -->
            <div class="row">
                <div class="col-lg-5 col-md-8 single-right-left ">
                    <div class="grid images_3_of_2">
                        <div class="flexslider">
                            <ul class="slides">
                                <li data-thumb="{{$product->getImage($product->image)}}">
                                    <div class="thumb-image">
                                        <img src="{{$product->getImage($product->image)}}" data-imagezoom="true" class="img-fluid" alt="{{$product->name}}"> </div>
                                </li>
                                @if(strpos($product->getImage($product->image2), 'noimage.jpg') ==-1)
                                <li data-thumb="{{$product->getImage($product->image2)}}">
                                    <div class="thumb-image">
                                        <img src="{{$product->getImage($product->image2)}}" data-imagezoom="true" class="img-fluid" alt="{{$product->name}}"> </div>
                                </li>
                                @endif
                                @if(strpos($product->getImage($product->image3), 'noimage.jpg') ==-1)
                                <li data-thumb="{{$product->getImage($product->image3)}}">
                                    <div class="thumb-image">
                                        <img src="{{$product->getImage($product->image3)}}" data-imagezoom="true" class="img-fluid" alt="{{$product->name}}"> </div>
                                </li>
                                @endif
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7 single-right-left simpleCart_shelfItem">
                    <h3 class="mb-3">{{$product->excerpt}}</h3>
                    <p class="mb-3">
                        <span class="item_price">{{$product->formatPrice()}}</span>
                        <del class="mx-2 font-weight-light">$280.00</del>
                        <label>Free delivery</label>
                    </p>
                    <div class="single-infoagile">
                        <ul>
                            <li class="mb-3">
                                Cash on Delivery Eligible.
                            </li>
                            <li class="mb-3">
                                Shipping Speed to Delivery.
                            </li>
                            <li class="mb-3">
                                EMIs from $655/month.
                            </li>
                            <li class="mb-3">
                                Bank OfferExtra 5% off* with Axis Bank Buzz Credit CardT&C
                            </li>
                        </ul>
                    </div>
                    <div class="product-single-w3l">
                        <p class="my-3">
                            <i class="far fa-hand-point-right mr-2"></i>
                            <label>1 Year</label>Manufacturer Warranty</p>
                        <ul>
                            {!! $product->description !!}
                        </ul>
                        <p class="my-sm-4 my-3">
                            <i class="fas fa-retweet mr-3"></i>Net banking & Credit/ Debit/ ATM card
                        </p>
                    </div>
                    <div class="occasion-cart">
                        <div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
                            <form action="#" method="post">
                                <fieldset>
                                    <input type="hidden" name="cmd" value="_cart" />
                                    <input type="hidden" name="add" value="1" />
                                    <input type="hidden" name="business" value=" " />
                                    <input type="hidden" name="item_name" value="{{$product->name}}" />
                                    <input type="hidden" name="amount" value="{{$product->price}}" />
                                    <input type="hidden" name="discount_amount" value="{{$product->discount}}" />
                                    <input type="hidden" name="currency_code" value="USD" />
                                    <input type="hidden" name="return" value=" " />
                                    <input type="hidden" name="cancel_return" value=" " />
                                    <input type="submit" name="submit" value="Add to cart" class="button" />
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- //Single Page -->
    @endsection

@section('scripts')
            <!-- imagezoom -->
<script src="{{asset('js/imagezoom.js')}}"></script>
<!-- //imagezoom -->


<script src="{{asset('js/jquery.flexslider.js')}}"></script>
<script>
    // Can also be used with
    $(document).ready(function(){
    //$(window).load(function () {
        $('.flexslider').flexslider({
            animation: "slide",
            controlNav: "thumbnails"
        });
    });
</script>
<!-- //FlexSlider-->
@endsection