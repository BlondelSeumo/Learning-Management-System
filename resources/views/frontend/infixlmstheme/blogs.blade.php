@extends('frontend.infixlmstheme.layouts.master')
@section('title'){{getSetting()->site_title ? getSetting()->site_title : 'Infix LMS'}} | {{__('frontend.Recent News')}} @endsection
@section('css') @endsection
@section('js') @endsection

@section('mainContent')

    <!-- bradcam::start  -->
    <div class="breadcrumb_area bradcam_bg_8">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 offset-lg-1">
                    <div class="breadcam_wrap">
                        <span>{{__('frontend.Recent News')}}</span>
                        <h3>{{__('frontend.Recent news update Form the blog')}}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- bradcam::end  -->

    <!-- blog_page_wrapper ::start  -->
    <div class="blog_page_wrapper">
        <div class="container">
            <div class="row">
                @if(isset($blogs))
                    @foreach($blogs as $blog)
                        <div class="col-lg-6">
                            <div class="single_blog">
                                <a href="{{route('blogDetails',[$blog->id,$blog->slug])}}" class="thumb">
                                    <img src="{{getBlogImage($blog->thumbnail)}}" alt="" class="w-100">
                                </a>
                                <div class="blog_meta">
                                    <span>{{$blog->user->name}} . {{$blog->authored_date}}</span>

                                    <a href="{{route('blogDetails',[$blog->id,$blog->slug])}}">
                                        <h4>{{$blog->title}}</h4>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    <!-- blog_page_wrapper ::end  -->


@endsection
