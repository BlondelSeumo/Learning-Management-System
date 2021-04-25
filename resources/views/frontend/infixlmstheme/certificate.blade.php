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
    <link rel="stylesheet" href="{{ asset('public/frontend/infixlmstheme') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('public/frontend/infixlmstheme') }}/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ asset('public/frontend/infixlmstheme') }}/css/magnific-popup.css">
    <link rel="stylesheet" href="{{ asset('public/frontend/infixlmstheme') }}/css/fontawesome.css ">
    <link rel="stylesheet" href="{{ asset('public/frontend/infixlmstheme') }}/css/themify-icons.css">
    <link rel="stylesheet" href="{{ asset('public/frontend/infixlmstheme') }}/css/flaticon.css">
    <link rel="stylesheet" href="{{ asset('public/frontend/infixlmstheme') }}/css/nice-select.css">
    <link rel="stylesheet" href="{{ asset('public/frontend/infixlmstheme') }}/css/animate.min.css">
    <link rel="stylesheet" href="{{ asset('public/frontend/infixlmstheme') }}/css/slicknav.css">
    <link rel="stylesheet" href="{{asset('public/backend/vendors/css/toastr.min.css')}}"/>
    <link rel="stylesheet" href="{{ asset('public/frontend/infixlmstheme') }}/css/style.css">
    <link rel="stylesheet" href="{{asset('public/backend/css/style.css')}}"/>

    @yield('css')
    <style>
        .student-certificate .certificate-position {
            position: absolute;
            top: 20%;
            left: 10%;
            right: 0;
            bottom: 14%;
        }

        .full_row {
            width: 100%;
            float: left;
        }

        .width_40 {
            width: 40%;
            float: left;
        }
        .width_50 {
            width: 50%;
            float: left;
        }
        .width_80 {
            width: 80%;
            float: left;
        }
    </style>

</head>

<body>
<!--/ UP_ICON -->
@php
    $body = $certificate->body;

    $body = str_replace("[name]",\Illuminate\Support\Facades\Auth::user()->name,$body);
    $body = str_replace("[course]",$course->title,$body);
@endphp
<div class="container student-certificate">
    <div class="row justify-content-center">
        <div class="full_row text-center">
            <div class="mb-5">
                <img class="img-fluid" id="certificate_image"
                     src="{{asset($certificate->image)}}">
            </div>
        </div>
        <div class="width_80 text-center certificate-position">
            <div>
                <div class="full_row">
                    <div class="width_50 text-left">
                        <img @if($certificate->user_image == 0)
                             style="display:none;margin-left: {{$certificate->position_image}}px"
                             @endif style="margin-left: {{$certificate->position_image+10}}px" src="{{asset(auth()->user()->image ?? 'public/uploads/staff/user.png')}}"
                             height="50px" id="user_image" alt="user_image">
                    </div>
                    @php
                        $date_margin = $certificate->position_date > 0 ?$certificate->position_date + 160 : 0;
                        $sign_margin = $certificate->sign_position > 0 ?$certificate->sign_position + 105 : 0;
                    @endphp
                    <div class="width_50 text-left">
                        <p class="p-2 certificate_date" style="margin-left: {{$date_margin}}px">{{trans('certificate.Date')}}
                            : {{ @$certificate->date }}</p>
                    </div>
                </div>

                <div class="certificate-middle"
                     style="margin-top: {{$certificate->y_portion}}px;
                         padding: 0 {{$certificate->x_portion+25}}px;
                         color: {{$certificate->font_color}};
                         font-size: {{$certificate->font_size}}px">
                    <p style="color: {{$certificate->font_color}}" class="font-weight-bold mb-30">{{$certificate->title}}</p></br>
                    <span class="mt-2 certificate_body text-justify">
                                                        {{ $body }}
                                                    </span>
                </div>

                <div class="full_row text-center" style="margin-top: 20px">
                    <div style="margin-left: {{$sign_margin}}px">
                        <img src="{{ asset($certificate->signature) }}"
                             alt="{{ $certificate->signature }}"
                             id="certificate_signature"
                             height="70px">
                        <p>------------------------</p>
                        <p>{{$certificate->sign_text}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!--ALL JS SCRIPTS -->
{{--<script src="{{ asset('public/frontend/infixlmstheme') }}/js/vendor/jquery-3.4.1.min.js"></script>--}}
<script src="{{ asset('public/frontend/infixlmstheme') }}/js/vendor/jquery-3.5.1.min.js"></script>
<script src="{{ asset('public/frontend/infixlmstheme') }}/js/vendor/popper.min.js"></script>
<script src="{{ asset('public/frontend/infixlmstheme') }}/js/vendor/bootstrap.min.js"></script>

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

<!-- MAIN JS   -->
<script src="{{ asset('public/frontend/infixlmstheme') }}/js/main.js"></script>
<script  src="{{asset('public/backend/vendors/js/toastr.min.js')}}"></script>
@stack('js')
</body>
</html>

