@extends('frontend.infixlmstheme.layouts.master')
@section('title'){{getSetting()->site_title ? getSetting()->site_title : 'Infix LMS'}} | {{$blog->title??''}} @endsection
@section('css') @endsection
@section('js') @endsection

@section('mainContent')
    <!-- blog_details_area::start  -->
    <div class="blog_details_area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10 ">
                    <!-- single_blog_details  -->
                    <div class="single_blog_details">
                        <div class="row">
                            <div class="col-xl-8 offset-lg-1">
                                <div class="blog_title">
                                    <span>{{$blog->user->name}} . {{$blog->authored_date}}</span>
                                    <h3 class="mb-0">{{$blog->title}}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="blog_details_banner">
                            <img class="w-100" src="{{getBlogImage($blog->image)}}" alt="">
                        </div>
                        <div class="row">
                            <div class="col-xl-9 offset-lg-1">
                                <p class="mb_25">
                                    {!! $blog->description !!}
                                </p>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- blog_details_area::end  -->


@endsection
