<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ getSetting()->site_title }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/x-icon" href="{{getCourseImage(getSetting()->favicon)}}">

    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('public/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/infixlmstheme/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/infixlmstheme/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/infixlmstheme/css/fontawesome.css') }} ">
    <link rel="stylesheet" href="{{ asset('public/frontend/infixlmstheme/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/infixlmstheme/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/infixlmstheme/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/infixlmstheme/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/infixlmstheme/css/slicknav.css') }}">
    <link rel="stylesheet" href="{{asset('public/css/toastr.min.css')}}"/>
    <link rel="stylesheet" href="{{ asset('public/frontend/infixlmstheme/css/style.css') }}">
    <script src="{{ asset('public/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{asset('public/js/toastr.min.js')}}"></script>

</head>

<body>
@yield('content')

{!! \Brian2694\Toastr\Facades\Toastr::message() !!}
</body>


</html>
