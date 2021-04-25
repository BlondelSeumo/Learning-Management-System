@extends('frontend.infixlmstheme.layouts.master')
@section('title'){{getSetting()->site_title ? getSetting()->site_title : 'Infix LMS'}} | {{__('frontend.Instructor')}} @endsection
@section('css') @endsection
@section('js') @endsection

@section('mainContent')
    <div class="breadcrumb_area bradcam_bg_2"
         style="background-image: url('{{asset(@$frontendContent->instructor_page_banner)}}')">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="breadcam_wrap">
                        <span>
                            {{@$frontendContent->instructor_page_title}}
                        </span>
                        <h3>
                            {{@$frontendContent->instructor_page_sub_title}}
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- bradcam::end  -->
    <!-- instractors_wrapper::start  -->
    <div class="instractors_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="section__title2 mb_76">
                        <span>{{__('frontend.Popular Instructors')}}</span>
                        <h4>{{__('frontend.Making sure that our products exceed customer expectations')}}
                            <br>{{__('frontend.for quality, style and performance')}}.</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                @if(isset($instructors))
                    @foreach($instructors->take(4) as $instructor)

                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="single_instractor mb_30">
                                <a href="{{route('instructorDetails',[$instructor->id,Str::slug($instructor->name,'-')])}}"
                                   class="thumb">
                                    <img src="{{getInstructorImage($instructor->image)}}" alt="">
                                </a>
                                <a href="{{route('instructorDetails',[$instructor->id,Str::slug($instructor->name,'-')])}}">
                                    <h4>{{$instructor->name}}</h4></a>
                                <span>{{$instructor->headline}}</span>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    <!-- instractors_wrapper::end  -->

    <!-- instractors_wrapper::start  -->
    <div class="instractors_wrapper instractors_wrapper2">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="section__title2 mb_76">
                        <span>{{__('frontend.Meet Our world-class instructors')}}</span>
                        <h4>{{__('frontend.We are here to meet your demand and teach the most beneficial way for you in Personal')}}
                            .</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                @if(isset($instructors))
                    @foreach($instructors as $instructor)
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="single_instractor mb_30">
                                <a href="{{route('instructorDetails',[$instructor->id,Str::slug($instructor->name,'-')])}}"
                                   class="thumb">
                                    <img src="{{getInstructorImage($instructor->image)}}" alt="">
                                </a>
                                <a href="{{route('instructorDetails',[$instructor->id,Str::slug($instructor->name,'-')])}}">
                                    <h4>{{$instructor->name}}</h4></a>
                                <span>{{$instructor->headline}}</span>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    <!-- instractors_wrapper::end  -->

    <!-- CTA::START  -->
    <div class="cta_area">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 offset-xl-1">
                    <div class="section__title white_text">
                        <h3 class="large_title">{{__('frontend.Become a Instructor')}}.</h3>
                        <p>{{__('frontend.Teach what you love. Corrector gives you the tools to create a course')}}.</p>
                        <a href="{{route('becomeInstructor')}}"
                           class="theme_btn small_btn">{{__('frontend.Start Teaching')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CTA::END  -->
@endsection
