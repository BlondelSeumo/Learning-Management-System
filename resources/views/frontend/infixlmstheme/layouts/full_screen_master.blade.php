<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>
        {{getSetting()->site_title ? getSetting()->site_title : 'Infix LMS'}}
    </title>
    <!-- Google / Search Engine Tags -->
    <meta itemprop="name" content="{{ getSetting()->site_name }}">
    <meta itemprop="description" content="{{ getSetting()->meta_description }}">
    <meta itemprop="image" content="{{asset(getSetting()->logo)}}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Facebook Meta Tags -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ getSetting()->site_title }}">
    <meta property="og:description" content="{{ getSetting()->meta_description }}">
    <meta property="og:image" content="{{asset(getSetting()->logo)}}"/>
    <meta property="og:image:type" content="image/png"/>
    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="{{getCourseImage(getSetting()->favicon)}}">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('public/') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('public/frontend/infixlmstheme') }}/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ asset('public/frontend/infixlmstheme') }}/css/magnific-popup.css">
    <link rel="stylesheet" href="{{ asset('public/frontend/infixlmstheme') }}/css/fontawesome.css ">
    <link rel="stylesheet" href="{{ asset('public/frontend/infixlmstheme') }}/css/themify-icons.css">
    <link rel="stylesheet" href="{{ asset('public/frontend/infixlmstheme') }}/css/flaticon.css">
    <link rel="stylesheet" href="{{ asset('public/frontend/infixlmstheme') }}/css/nice-select.css">
    <link rel="stylesheet" href="{{ asset('public/frontend/infixlmstheme') }}/css/animate.min.css">
    <link rel="stylesheet" href="{{ asset('public/frontend/infixlmstheme') }}/css/slicknav.css">
    <link rel="stylesheet" href="{{asset('public/')}}/css/toastr.min.css"/>
{{--    <link rel="stylesheet" href="{{asset('public/backend/css/style.css')}}"/>--}}
    <link rel="stylesheet" href="{{ asset('public/frontend/infixlmstheme') }}/css/style.css">
    @yield('css')

</head>

<body>
<script src="{{ asset('public/') }}/js/jquery-3.5.1.min.js"></script>
{{--<script src="{{ asset('public/frontend/infixlmstheme') }}/js/vendor/popper.min.js"></script>--}}
<script src="{{ asset('public/') }}/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('public/frontend/infixlmstheme') }}/js/fluidplayer.min.js"></script>
<input type="hidden" name="base_url" class="base_url" value="{{url('/')}}">
<input type="hidden" name="csrf_token" class="csrf_token" value="{{csrf_token()}}">


@yield('mainContent')

<!-- FOOTER::END  -->
<!-- shoping_cart::start  -->
<div class="shoping_wrapper">
    <div class="dark_overlay"></div>
    <div class="shoping_cart">
        <div class="shoping_cart_inner">
            <div class="cart_header d-flex justify-content-between">
                <h4>{{__('frontend.Shoping Cart')}}</h4>
                <div class="chart_close">
                    <i class="ti-close"></i>
                </div>
            </div>
            <div id="cartView">
                <div class="single_cart">
                    <h4>{{__('frontend.No Item into cart')}}</h4>
                </div>
            </div>


        </div>
        <div class="view_checkout_btn d-flex justify-content-end " style="display: none!important;">
            <a href="{{url('my-cart')}}" class="theme_btn small_btn3 mr_10">{{__('frontend.View cart')}}</a>
            <a href="{{route('CheckOut')}}" class="theme_btn small_btn3">{{__('frontend.Checkout')}}</a>
        </div>
    </div>
</div>
<!-- shoping_cart::end  -->

<!-- UP_ICON  -->
<div id="back-top" style="display: none;">
    <a title="Go to Top" href="#">
        <i class="ti-angle-up"></i>
    </a>
</div>
<!--/ UP_ICON -->


<!--ALL JS SCRIPTS -->

<script src="{{ asset('public/frontend/infixlmstheme') }}/js/owl.carousel.min.js"></script>
<script src="{{ asset('public/frontend/infixlmstheme') }}/js/isotope.pkgd.min.js"></script>
<script src="{{ asset('public/frontend/infixlmstheme') }}/js/waypoints.min.js"></script>
<script src="{{ asset('public/frontend/infixlmstheme') }}/js/jquery.counterup.min.js"></script>
<script src="{{ asset('public/frontend/infixlmstheme') }}/js/imagesloaded.pkgd.min.js"></script>
<script src="{{ asset('public/frontend/infixlmstheme') }}/js/wow.min.js"></script>
<script src="{{ asset('public/frontend/infixlmstheme') }}/js/nice-select.min.js"></script>
<script src="{{ asset('public/frontend/infixlmstheme') }}/js/barfiller.js"></script>
<script src="{{ asset('public/frontend/infixlmstheme') }}/js/jquery.slicknav.js"></script>
<script src="{{ asset('public/frontend/infixlmstheme') }}/js/jquery.magnific-popup.min.js"></script>
<script src="{{ asset('public/frontend/infixlmstheme') }}/js/jquery.ajaxchimp.min.js"></script>
<script src="{{ asset('public/frontend/infixlmstheme') }}/js/parallax.js"></script>
<script src="{{ asset('public/frontend/infixlmstheme') }}/js/mail-script.js"></script>
<script src="{{ asset('public/frontend/infixlmstheme') }}/js/html2pdf.bundle.js"></script>

<!-- MAIN JS   -->
<script src="{{ asset('public/frontend/infixlmstheme') }}/js/main.js"></script>
<script src="{{asset('public/')}}/js/toastr.min.js"></script>
{!! Toastr::message() !!}
@stack('js')
</body>
</html>
