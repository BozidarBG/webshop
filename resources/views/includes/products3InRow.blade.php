@php
$x=0;
$y=0;
$count=$products->count();
@endphp
@if($count != 0)
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
                                @if($products[$x]->discount)
                                <span class="item_price">{{$products[$x]->formatPrice()}}</span><br>
                                <del>{{$products[$x]->formatPriceWithoutDiscount()}}</del>
                                @else
                                    <span class="item_price">{{$products[$x]->formatPrice()}}</span>
                                @endif
                            </div>
                            <div>
                            @auth
                                    <fieldset data-id="{{$products[$x]->id}}">
                                        <input type="hidden" name="name" value="{{$products[$x]->name}}" />
                                        <input type="hidden" name="price" value="{{$products[$x]->price}}" />
                                        <input type="hidden" name="discount" value="{{$products[$x]->discount}}" />
                                        <input type="hidden" name="quantity" value="{{$products[$x]->quantity}}" />
                                        <input type="button" name="submit" value="Add to cart" class="btn btn-primary open_cart_modal" />
                                    </fieldset>
                            @endauth
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
    @else
    <div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mb-4">
        <div class="row">
            <h3 class="text-danger">There are no products for your query</h3>
        </div>
    </div>
@endif
{{--{{$products->links()}}--}}
{{ $products->appends(request()->input())->links() }}
<br>