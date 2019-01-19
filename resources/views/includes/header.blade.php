<!-- header-bottom-->
<div class="header-bot">
    <div class="container">
        <div class="row header-bot_inner_wthreeinfo_header_mid">
            <!-- logo -->
            <div class="col-md-3 logo_agile">
                <h1 class="text-center">
                    <a href="{{route('welcome')}}" class="font-weight-bold font-italic">
                        {{setting('site.title')}}
                    </a>
                </h1>
            </div>
            <!-- //logo -->
            <!-- header-bot -->
            <div class="col-md-9 header mt-4 mb-md-0 mb-4">
                <div class="row">
                    <!-- search -->
                    <div class="col-10 agileits_search">
                        <form class="form-inline" action="{{route('search')}}" method="post">
                            @csrf
                            <input name="item" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" required>
                            <button class="btn my-2 my-sm-0" type="submit">Search</button>
                        </form>
                    </div>
                    <!-- //search -->
                    <!-- cart details -->
                    <div class="col-2 top_nav_right text-center mt-sm-0 mt-2">
                    @if(Request::route()->getName() !="checkout")
                    @auth
                        <a href=""  class="btn btn-lg btn-dark show_cart_modal" data-toggle="tooltip" data-placement="top" title="Go to your cart">
                            <i class="fas fa-cart-arrow-down"></i>
                        </a>
                    @endauth
                    @endif
                    </div>
                    <!-- //cart details -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- shop locator (popup) -->
<!-- //header-bottom -->
<!-- navigation -->
<div class="navbar-inner">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto text-center mr-xl-5 ">
                    <li class="nav-item {{Request::is("/") ? 'active' : ''}} mr-lg-2 mb-lg-0 mb-2">
                        <a class="nav-link" href="{{route('welcome')}}">Home
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown {{Request::is("category*") ? 'active' : ''}} mr-lg-2 mb-lg-0 mb-2">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Categories
                            <?php $count=$categories->count();
                            $num=$count%2 == 0 ? $count/2 : floor($count/2) + 1;

                            ?>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="agile_inner_drop_nav_info p-4">
                                <h5 class="mb-3">Please select a category</h5>
                                <div class="row">

                                    <div class="col-sm-6 multi-gd-img">
                                        <ul class="multi-column-dropdown">
                                            @for($i=0; $i<$num; $i++)
                                            <li>
                                                <a href="{{route('category', ['slug'=>$categories[$i]->slug])}}">{{$categories[$i]->name}}</a>
                                            </li>
                                            @endfor
                                        </ul>
                                    </div>
                                    <div class="col-sm-6 multi-gd-img">
                                        <ul class="multi-column-dropdown">
                                            @for($i=$num; $i<$count; $i++)
                                                <li>
                                                    <a href="{{route('category', ['slug'=>$categories[$i]->slug])}}">{{$categories[$i]->name}}</a>
                                                </li>
                                            @endfor
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item {{Request::is("about") ? 'active' : ''}} mr-lg-2 mb-lg-0 mb-2">
                        <a class="nav-link" href="{{route('about')}}">About Us</a>
                    </li>
                    <li class="nav-item {{Request::is("checkout") ? 'active' : ''}} mr-lg-2 mb-lg-0 mb-2">
                        <a class="nav-link" href="{{ route('checkout') }}">Checkout</a>
                    </li>

                    <li class="nav-item {{Request::is("contact") ? 'active' : ''}} mr-lg-2 mb-lg-0 mb-2">
                        <a class="nav-link" href="{{route('contact')}}">Contact Us</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
<!-- //navigation -->