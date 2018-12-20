@php
$x=0;
$y=0;
$count=$products->count();
@endphp
@for($i=0; $i<ceil($count/3); $i++)
{{--@dd($products)--}}
    <div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mb-4">

        <div class="row">
            @while($y<3)
                <div class="col-md-4 product-men mt-5">
                    <div class="men-pro-item simpleCart_shelfItem">
                        <div class="men-thumb-item text-center">
                            <img src="{{$products[$x]->getImage($products[$x]->image)}}" alt="{{$products[$x]->name}}" class="welcome_images">
                            <div class="men-cart-pro">
                                <div class="inner-men-cart-pro">
                                    <a href="{{route('product', ['slug'=>$products[$x]->slug])}}" class="link-product-add-cart">Quick View</a>
                                </div>
                            </div>
                        </div>
                        <div class="item-info-product text-center border-top mt-4">
                            <h4 class="pt-1">
                                <a href="{{route('product', ['slug'=>$products[$x]->slug])}}">{{$products[$x]->name}}</a>
                            </h4>
                            <div class="info-product-price my-2">
                                <span class="item_price">{{$products[$x]->formatPrice()}}</span>
                                {{--<del>$280.00</del>--}}
                            </div>
                            <div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
                                <form action="#" method="post">
                                    <fieldset>
                                        <input type="hidden" name="cmd" value="_cart" />
                                        <input type="hidden" name="add" value="1" />
                                        <input type="hidden" name="business" value=" " />
                                        <input type="hidden" name="item_name" value="{{$products[$x]->name}}" />
                                        <input type="hidden" name="amount" value="{{$products[$x]->price}}" />
                                        <input type="hidden" name="discount_amount" value="{{$products[$x]->discount}}" />
                                        <input type="hidden" name="currency_code" value="USD" />
                                        <input type="hidden" name="return" value=" " />
                                        <input type="hidden" name="cancel_return" value=" " />
                                        <input type="submit" name="submit" value="Add to cart" class="button btn" />
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @php
                $x++;
            if($x==$count){
            break;
            }
                $y++;
                @endphp
            @endwhile
            @php
            $y=0;
    @endphp
        </div>
    </div>
@endfor