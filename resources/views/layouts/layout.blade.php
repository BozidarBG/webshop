<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{{config('app.name')}} - @yield('title')</title>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta name="keywords" content=""/>
    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- //Meta tag Keywords -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Custom-Files -->
    <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet" type="text/css" media="all" />
    <!-- Bootstrap css -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css" media="all" />
    <!-- Main css -->
    {{--<link rel="stylesheet" href="{{asset('css/fontawesome-all.css')}}">--}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <!-- Font-Awesome-Icons-CSS -->
    <link href="{{asset('css/popuo-box.css')}}" rel="stylesheet" type="text/css" media="all" />
    <!-- pop-up-box -->
    <link href="{{asset('css/menu.css')}}" rel="stylesheet" type="text/css" media="all" />
    <!-- menu style -->

    <!-- //Custom-Files -->
    @yield('styles')


</head>

<body>
<!-- top-header -->
<div class="agile-main-top">
    <div class="container-fluid">
        <div class="row main-top-w3l py-2">
            <div class="col-lg-4 header-most-top">
                <p class="text-white text-lg-left text-center">Offer Top Deals & Discounts
                    <i class="fas fa-shopping-cart ml-1"></i>
                </p>
            </div>
            <div class="col-lg-8 header-right mt-lg-0 mt-2">
                <!-- header lists -->
                <ul>
                    <li class="text-center border-right text-white">
                        <a href="#" data-toggle="modal" data-target="#exampleModal" class="text-white">
                            <i class="fas fa-truck mr-2"></i>Track Order</a>
                    </li>
                    <li class="text-center border-right text-white">
                        <i class="fas fa-phone mr-2"></i> {{setting('site.phone1')}}
                    </li>
                    @guest
                    <li class="text-center border-right text-white">
                        <a href="#" data-toggle="modal" data-target="#exampleModal" class="text-white start-login-modal">
                            <i class="fas fa-sign-in-alt mr-2"></i> Log In </a>
                    </li>
                    <li class="text-center text-white">
                        <a href="#" data-toggle="modal" data-target="#exampleModal2" class="text-white start-register-modal">
                            <i class="fas fa-sign-out-alt mr-2"></i>Register </a>
                    </li>
                    @else
                    <li class="text-center text-white">{{Auth::user()->name}}</li>
                    <li class="dropdown w-25">
                        <a id="navbarDropdown" class="text-white nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>

                            <a class="dropdown-item py-3" href="{{ route('profile.show') }}">Profile</a>
                            <a class="dropdown-item py-3" href="{{ route('checkout') }}">Checkout</a>
                        </div>

                    </li>
                    @endauth
                </ul>
                <!-- //header lists -->
            </div>
        </div>
    </div>
</div>


<!-- //shop locator (popup) -->

<!-- modals -->
@include('includes.register-login1')
<!-- //modal -->
<!-- //top-header -->

@include('includes.header')

{{--@include('includes.slider')--}}



@yield('content')

{{--@include('includes.special')--}}


{{--@include('includes.footer')--}}
<!-- //copyright -->
@include('includes.cart-modal')
<!-- js-files -->
<!-- jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
{{--<script src="{{asset('js/jquery-2.2.3.min.js')}}"></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<!-- //jquery -->

<!-- nav smooth scroll -->
<script>
    $(document).ready(function () {
        $(".dropdown").hover(
                function () {
                    $('.dropdown-menu', this).stop(true, true).slideDown("fast");
                    $(this).toggleClass('open');
                },
                function () {
                    $('.dropdown-menu', this).stop(true, true).slideUp("fast");
                    $(this).toggleClass('open');
                }
        );
    });
</script>
<!-- //nav smooth scroll -->

<!-- popup modal (for location)-->
<script src="{{asset('js/jquery.magnific-popup.js')}}"></script>
<script>
    $(document).ready(function () {
        $('.popup-with-zoom-anim').magnificPopup({
            type: 'inline',
            fixedContentPos: false,
            fixedBgPos: true,
            overflowY: 'auto',
            closeBtnInside: true,
            preloader: false,
            midClick: true,
            removalDelay: 300,
            mainClass: 'my-mfp-zoom-in'
        });

    });
</script>
<!-- //popup modal (for location)-->

<!-- cart-js -->
{{--<script src="{{asset('js/minicart.js')}}"></script>--}}
<script>
//    paypals.minicarts.render(); //use only unique class names other than paypals.minicarts.Also Replace same class name in css and minicart.min.js
//
//    paypals.minicarts.cart.on('checkout', function (evt) {
//        var items = this.items(),
//                len = items.length,
//                total = 0,
//                i;
//
//        // Count the number of each item in the cart
//        for (i = 0; i < len; i++) {
//            total += items[i].get('quantity');
//        }

//        if (total < 3) {
//            alert('The minimum order quantity is 3. Please add more to your shopping cart before checking out');
//            evt.preventDefault();
//        }
//    });
</script>
<!-- //cart-js -->

<!-- password-script -->
{{--<script>--}}
    {{--window.onload = function () {--}}
        {{--document.getElementById("password1").onchange = validatePassword;--}}
        {{--document.getElementById("password2").onchange = validatePassword;--}}
    {{--}--}}

    {{--function validatePassword() {--}}
        {{--var pass2 = document.getElementById("password2").value;--}}
        {{--var pass1 = document.getElementById("password1").value;--}}
        {{--if (pass1 != pass2)--}}
            {{--document.getElementById("password2").setCustomValidity("Passwords Don't Match");--}}
        {{--else--}}
            {{--document.getElementById("password2").setCustomValidity('');--}}
        {{--//empty string means no validation error--}}
    {{--}--}}
{{--</script>--}}
<!-- //password-script -->
<!--   Custom login /register verification -->
<script src="{{asset('js/register-login.js')}}"></script>
<!-- scroll seller -->
<script src="{{asset('js/scroll.js')}}"></script>
<!-- //scroll seller -->

<!-- smoothscroll -->
<script src="{{asset('js/SmoothScroll.min.js')}}"></script>
<!-- //smoothscroll -->

<!-- start-smooth-scrolling -->
{{--<script src="{{asset('js/move-top.js')}}"></script>--}}
<script src="{{asset('js/easing.js')}}"></script>
<script>
    jQuery(document).ready(function ($) {
        $(".scroll").click(function (event) {
            event.preventDefault();

            $('html,body').animate({
                scrollTop: $(this.hash).offset().top
            }, 1000);
        });
    });
</script>
<!-- //end-smooth-scrolling -->

<!-- smooth-scrolling-of-move-up -->
<script>
    $(document).ready(function () {
        /*
         var defaults = {
         containerID: 'toTop', // fading element id
         containerHoverID: 'toTopHover', // fading element hover id
         scrollSpeed: 1200,
         easingType: 'linear'
         };
         */
//        $().UItoTop({
//            easingType: 'easeOutQuart'
//        });

    });
</script>
<!-- //smooth-scrolling-of-move-up -->


<!-- //js-files -->
<script src="{{asset('js/cart-modal.js')}}"></script>
@yield('scripts')
</body>

</html>