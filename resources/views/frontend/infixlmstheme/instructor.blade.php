@extends('frontend.infixlmstheme.layouts.master')
@section('title'){{getSetting()->site_title ? getSetting()->site_title : 'Infix LMS'}} |   {{$instructor->name}} @endsection
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

    <!-- instractos_details_wrapper::start  -->
    <div class="instractos_details_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4">
                    <div class="instractos_profile mb_30">
                        <div class="thumb">
                            <img src="{{getInstructorImage($instructor->image)}}" alt="#">
                        </div>
                        <div class="instractor_meta">
                            <h4>{{$instructor->name}}</h4>
                            <span>{{$instructor->headline}}</span>
                            <div class="social_media">
                                <a href="https://facebook.com/{{$instructor->facebook}}" class="facebook">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="https://twitter.com/{{$instructor->twitter}}" class="twitter">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="https://instagram.com/{{$instructor->instagram}}" class="pinterest">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a href="https://linkedin.com/{{$instructor->linkedin}}" class="linkedin">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 offset-xl-1">
                    <div class="instractos_main_details mb_30">
                        <div class="course__details_title">
                            <div class="single__details">
                                <div class="details_content">
                                    <span>Student</span>
                                    <h4 class="f_w_700">{{$students}} Students</h4>
                                </div>
                            </div>
                            <div class="single__details">
                                <div class="details_content">
                                    <span>Category</span>
                                    <h4 class="f_w_700">{{$instructor->headline}}</h4>
                                </div>
                            </div>
                            <div class="single__details">
                                <div class="details_content">
                                    <span>Reviews</span>
                                    <div class="rating_star">
                                        <div class="stars">
                                            @php
                                                $main_stars=($totalRating*$rating)/5;

                                                $stars=intval(($totalRating*$rating)/5);

                                            @endphp
                                            @for ($i = 0; $i <  $stars; $i++)
                                                <i class="fas fa-star"></i>
                                            @endfor
                                            @if ($main_stars>$stars)
                                                <i class="fas fa-star-half"></i>
                                            @endif
                                            @if($main_stars==0)
                                                @for ($i = 0; $i <  5; $i++)
                                                    <i class="far fa-star"></i>
                                                @endfor
                                            @endif

                                        </div>


                                        <p>{{($totalRating*$rating)/5}}/5 ({{$totalRating}} rating)</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="instractos_info_Details">
                            <p>
                                {!! $instructor->about !!}
</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- instractos_details_wrapper::end  -->

    <!-- course_by_author ::start  -->
    <div class="course_by_author">
        <div class="container">
            <div class="theme_border"></div>
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section__title text-center mb_80">
                        <h3>{{__('frontend.More Courses by Author')}}</h3>
                        {{--                        <p>The world’s largest selection of courses choose from 130,000 online video courses--}}
                        {{--                            with new additions published every month.</p>--}}
                    </div>
                </div>
            </div>
            <div class="row">
                @if(count($courses)==0)
                    <div class="col-xl-12 text-center">
                        <h1> {{__('frontend.No course Found')}}</h1>
                    </div>
                @endif
                @if(isset($courses))
                    @foreach ($courses as $course)
                        <div class="col-xl-4 col-md-6">
                            @if($course->type==1)
                                <div class="couse_wizged">
                                    <div class="thumb">

                                        <a href="{{courseDetailsUrl($course->id,$course->type,$course->slug)}}">
                                            <img class="w-100" src="{{getCourseImage($course->thumbnail)}}" alt="">
                                            <span class="prise_tag"> @if (@$course->discount_price!=null)
                                                    {{getPriceFormat($course->discount_price)}}
                                                @else
                                                    {{getPriceFormat($course->price)}}
                                                @endif</span>
                                        </a>

                                    </div>
                                    <div class="course_content">
                                        <a href="{{courseDetailsUrl($course->id,$course->type,$course->slug)}}">
                                            <h4 class="noBrake" title="{{$course->title}}">
                                                {{$course->title}}
                                            </h4>
                                        </a>
                                        <div class="rating_cart">
                                            <div class="rateing">
                                                <span>{{getTotalRating($course->id)}}/5</span>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <a href="#" class="cart_store"
                                               data-id="{{$course->id}}">
                                                <i class="fas fa-shopping-cart"></i>
                                            </a>
                                        </div>
                                        <div class="course_less_students">
                                            <a href="#"> <i
                                                    class="ti-agenda"></i> {{count($course->lessons)}} {{__('frontend.Lessons')}}
                                            </a>
                                            <a href="#"> <i
                                                    class="ti-user"></i> {{$course->total_enrolled}} {{__('frontend.Students')}}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @elseif($course->type==2)
                                <div class="quiz_wizged">
                                    <div class="thumb">
                                        <a href="{{courseDetailsUrl($course->id,$course->type,$course->slug)}}">
                                            <img class="w-100" src="{{getCourseImage($course->thumbnail)}}" alt="">
                                            <span class="prise_tag"> @if (@$course->discount_price!=null)
                                                    {{getPriceFormat($course->discount_price)}}
                                                @else
                                                    {{getPriceFormat($course->price)}}
                                                @endif</span>
                                            <span class="quiz_tag">{{__('frontend.Quiz')}}</span>
                                        </a>

                                    </div>
                                    <div class="course_content">
                                        <a href="{{courseDetailsUrl($course->id,$course->type,$course->slug)}}">
                                            <h4 class="noBrake" title="{{$course->title}}"> {{$course->title}}</h4>
                                        </a>
                                        <div class="rating_cart">
                                            <div class="rateing">
                                                <span>{{getTotalRating($course->id)}}/5</span>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <a href="#" class="cart_store"
                                               data-id="{{$course->id}}">
                                                <i class="fas fa-shopping-cart"></i>
                                            </a>
                                        </div>
                                        <div class="course_less_students">
                                            <a href="#"> <i class="ti-agenda"></i> 30 {{__('frontend.Question')}}</a>
                                            <a href="#"> <i
                                                    class="ti-user"></i> {{$course->total_enrolled}} {{__('frontend.Students')}}
                                            </a>
                                        </div>
                                    </div>
                                </div>

                            @elseif($course->type==3)
                                <div class="quiz_wizged">
                                    <div class="thumb">
                                        <a href="{{courseDetailsUrl($course->id,$course->type,$course->slug)}}">
                                            <img class="w-100" src="{{getCourseImage($course->thumbnail)}}" alt="">
                                            <span class="prise_tag"> @if (@$course->discount_price!=null)
                                                    {{getPriceFormat($course->discount_price)}}
                                                @else
                                                    {{getPriceFormat($course->price)}}
                                                @endif</span>
                                            <span class="live_tag">Live</span>
                                        </a>

                                    </div>
                                    <div class="course_content">
                                        <a href="{{courseDetailsUrl($course->id,$course->type,$course->slug)}}">
                                            <h4 class="noBrake" title="{{$course->title}}"> {{$course->title}}</h4>
                                        </a>
                                        <div class="rating_cart">
                                            <div class="rateing">
                                                <span>4.9/5</span>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <a href="#" class="cart_store"
                                               data-id="{{$course->id}}">
                                                <i class="fas fa-shopping-cart"></i>
                                            </a>
                                        </div>
                                        <div class="course_less_students">
                                            {{--                                        <a href="#"> <i class="ti-agenda"></i> 30 Question</a>--}}
                                            <a href="#"> <i
                                                    class="ti-user"></i> {{$course->total_enrolled}} {{__('frontend.Students')}}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    <!-- course_by_author ::end  -->
@endsection
