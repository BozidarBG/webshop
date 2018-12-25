<div class="col-lg-3 mt-lg-0 mt-4 p-lg-0">
    <div class="side-bar p-sm-4 p-3">
        <div class="search-hotel border-bottom py-2">
            <h3 class="agileits-sear-head mb-3">Search Here..</h3>
            <form action="#" method="post">
                <input type="search" placeholder="Product name..." name="search" required="">
                <button type="submit" class="btn btn-outline-primary"><i class="fas fa-search"></i></button>
            </form>
        </div>
        <!-- price -->
        <div class="range border-bottom py-2">
            <h3 class="agileits-sear-head mb-3">Sort By Price</h3>
            {{--<a href="{{route('low-to-high',['page_name'=>$title])}}">Low to high</a><br>--}}
            {{--<a href="{{route('high-to-low',['page_name'=>$title])}}">High to low</a>--}}

        </div>

        <div class="range border-bottom py-2">
            <h3 class="agileits-sear-head mb-3">Price range</h3>
            <form id="price_range" method="post" action="{{route('sortBy')}}">
                @csrf
                <div class="form-group">
                    <label for="price_from">From</label>
                    <input type="number" id="price_from" name="from" class="form-control" placeholder="0">
                </div>
                <div class="form-group">
                    <label for="price_to">To</label>
                    <input type="number" id="price_to" name="to" class="form-control" placeholder="9999999">
                </div>
                <div class="form-group">
                    <input type="hidden" id="page_name" name="page_name" value="{{$title}}">
                    <button type="submit" id="price_search" class="btn btn-outline-primary">Search</button>
                </div>
            </form>

        </div>
        <!-- //price -->
        <!-- discounts -->
        <div class="left-side border-bottom py-2">
            <h3 class="agileits-sear-head mb-3">Sort By Discount</h3>
            <ul>
                <li>
                    <input type="checkbox" class="checked">
                    <span class="span">5% or More</span>
                </li>
                <li>
                    <input type="checkbox" class="checked">
                    <span class="span">10% or More</span>
                </li>
                <li>
                    <input type="checkbox" class="checked">
                    <span class="span">20% or More</span>
                </li>
                <li>
                    <input type="checkbox" class="checked">
                    <span class="span">30% or More</span>
                </li>
                <li>
                    <input type="checkbox" class="checked">
                    <span class="span">50% or More</span>
                </li>
                <li>
                    <input type="checkbox" class="checked">
                    <span class="span">60% or More</span>
                </li>
            </ul>
        </div>
        <!-- //discounts -->
        <!-- reviews -->
        <div class="customer-rev border-bottom left-side py-2">
            <h3 class="agileits-sear-head mb-3">Customer Review</h3>
            <ul>
                <li>
                    <a href="#">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <span>5.0</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <span>4.0</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half"></i>
                        <span>3.5</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <span>3.0</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half"></i>
                        <span>2.5</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- //reviews -->
        <!-- electronics -->
        <div class="left-side border-bottom py-2">
            <h3 class="agileits-sear-head mb-3">Categories</h3>
            <ul>
                @foreach($categories as $category)
                    <li>
                        <i class="far fa-hand-point-right"></i>&nbsp;
                        <a href="{{route('category', ['slug'=>$category->slug])}}" class="span">{{$category->name}}</a>
                    </li>
                @endforeach
            </ul>
        </div>
        <!-- //electronics -->
        {{--<div class="side-bar p-sm-4 p-3">--}}
            <div class="search-hotel border-bottom py-2">
                <h3 class="agileits-sear-head mb-3">Brands</h3>
                <div class="left-side py-2">
                    <ul>
                        @foreach($brands as $brand)
                            <li>
                                <i class="far fa-hand-point-right"></i>&nbsp;
                                <a href="{{route('brand', ['slug'=>$brand->name])}}" class="span">{{$brand->name}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        <!-- arrivals -->
        <div class="left-side border-bottom py-2">
            <h3 class="agileits-sear-head mb-3">New Arrivals</h3>
            <ul>
                <li>
                    <input type="checkbox" class="checked">
                    <span class="span">Last 30 days</span>
                </li>
                <li>
                    <input type="checkbox" class="checked">
                    <span class="span">Last 90 days</span>
                </li>
            </ul>
        </div>
        <!-- //arrivals -->
        <!-- best seller -->
        {{--<div class="f-grid py-2">--}}
            {{--<h3 class="agileits-sear-head mb-3">Best Seller</h3>--}}
            {{--<div class="box-scroll">--}}
                {{--<div class="scroll">--}}
                    {{--<div class="row">--}}
                        {{--<div class="col-lg-3 col-sm-2 col-3 left-mar">--}}
                            {{--<img src="images/k1.jpg" alt="" class="img-fluid">--}}
                        {{--</div>--}}
                        {{--<div class="col-lg-9 col-sm-10 col-9 w3_mvd">--}}
                            {{--<a href="">Samsung Galaxy On7 Prime (Gold, 4GB RAM + 64GB Memory)</a>--}}
                            {{--<a href="" class="price-mar mt-2">$12,990.00</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="row my-4">--}}
                        {{--<div class="col-lg-3 col-sm-2 col-3 left-mar">--}}
                            {{--<img src="images/k2.jpg" alt="" class="img-fluid">--}}
                        {{--</div>--}}
                        {{--<div class="col-lg-9 col-sm-10 col-9 w3_mvd">--}}
                            {{--<a href="">Haier 195 L 4 Star Direct-Cool Single Door Refrigerator</a>--}}
                            {{--<a href="" class="price-mar mt-2">$12,499.00</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="row">--}}
                        {{--<div class="col-lg-3 col-sm-2 col-3 left-mar">--}}
                            {{--<img src="images/k3.jpg" alt="" class="img-fluid">--}}
                        {{--</div>--}}
                        {{--<div class="col-lg-9 col-sm-10 col-9 w3_mvd">--}}
                            {{--<a href="">Ambrane 13000 mAh Power Bank (P-1310 Premium)</a>--}}
                            {{--<a href="" class="price-mar mt-2">$1,199.00 </a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        <!-- //best seller -->
    </div>
    <!-- //product right -->
</div>