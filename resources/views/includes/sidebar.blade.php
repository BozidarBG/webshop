<div class="col-lg-3 mt-lg-0 mt-4 p-lg-0">
    <div class="side-bar p-sm-4 p-3">

        <!-- price -->
        <div class="range border-bottom py-2">
            <h3 class="agileits-sear-head mb-3">Sort By Price</h3>
            <a href="{{route(Request::route()->getName(),['page_name'=>$title, 'sort' => 'low_high'])}}">Low to high</a><br>
            <a href="{{route(Request::route()->getName(),['page_name'=>$title, 'sort' => 'high_low'])}}">High to low</a>
        </div>

        <div class="range border-bottom py-2">
            <h3 class="agileits-sear-head mb-3">Price range</h3>
            <form id="price_range" method="post" action="{{route('range')}}">
                @csrf
                <div class="form-group">
                    <label for="price_from">From</label>
                    <input type="number" id="price_from" name="from" class="form-control" placeholder="min price">
                </div>
                <div class="form-group">
                    <label for="price_to">To</label>
                    <input type="number" id="price_to" name="to" class="form-control" placeholder="max price">
                </div>
                <div class="form-group">
                    <input type="hidden" id="page_name" name="page_name" value="{{$title}}">
                    <button type="submit" id="price_search" class="btn btn-outline-primary">Search</button>
                </div>
            </form>

        </div>
        <!-- //price -->
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
                            <a href="{{route('brand', ['slug'=>$brand->slug])}}" class="span">{{$brand->name}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

    </div>
</div>