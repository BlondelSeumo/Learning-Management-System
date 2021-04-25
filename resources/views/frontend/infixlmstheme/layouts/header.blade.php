<!doctype html>
<html dir="{{isRtl()?'rtl':''}}" class="{{isRtl()?'rtl':''}}" lang="en" itemscope
      itemtype="{{url('/')}}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>
        @yield('title')
    </title>
    <!-- Google / Search Engine Tags -->
    <meta itemprop="name" content="{{ getSetting()->site_name }}">
    <meta itemprop="description" content="{{ getSetting()->meta_description }}">
    <meta itemprop="image" content="{{asset(getSetting()->logo)}}">
    @if (Request::is('/'))
        <meta itemprop="keywords" content="{{ getSetting()->meta_keywords}}">
    @endif
    <meta itemprop="author" content="InfixLMS">

    <!-- Facebook Meta Tags -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ getSetting()->site_title }}">
    @if (Request::is('/'))
        <meta property="og:description" content="{{ getSetting()->meta_description }}">
    @endif
    <meta property="og:image" content="{{asset(getSetting()->logo)}}"/>
    <meta property="og:image:type" content="image/png"/>
    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset(getSetting()->favicon)}}">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    @if(isRtl())
        <link rel="stylesheet" href="{{ asset('public') }}/css/bootstrap.rtl.min.css">
    @else
        <link rel="stylesheet" href="{{ asset('public') }}/css/bootstrap.min.css">
    @endif
    <link rel="stylesheet" href="{{ asset('public/frontend/infixlmstheme') }}/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ asset('public/frontend/infixlmstheme') }}/css/magnific-popup.css">
    <link rel="stylesheet" href="{{ asset('public/frontend/infixlmstheme') }}/css/fontawesome.css ">
    <link rel="stylesheet" href="{{ asset('public/frontend/infixlmstheme') }}/css/themify-icons.css">
    <link rel="stylesheet" href="{{ asset('public/frontend/infixlmstheme') }}/css/flaticon.css">
    <link rel="stylesheet" href="{{ asset('public/frontend/infixlmstheme') }}/css/nice-select.css">
    <link rel="stylesheet" href="{{ asset('public/frontend/infixlmstheme') }}/css/animate.min.css">
    <link rel="stylesheet" href="{{ asset('public/frontend/infixlmstheme') }}/css/slicknav.css">
    <link rel="stylesheet" href="{{asset('public')}}/css/toastr.min.css"/>
    <link rel="stylesheet" href="{{ asset('public/frontend/infixlmstheme') }}/css/rtl_style.css">
    <link rel="stylesheet" href="{{ asset('public/frontend/infixlmstheme') }}/css/style.css">
    <link rel="stylesheet" href="{{asset('public/css/preloader.css')}}"/>
    @yield('css')

</head>

<body>
<div class="preloader">
    <h3 data-text="{{getSetting()->site_title}}...">{{getSetting()->site_title}}...</h3>
</div>
