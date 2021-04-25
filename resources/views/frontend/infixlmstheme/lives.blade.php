@extends('frontend.infixlmstheme.layouts.master')
@section('title'){{getSetting()->site_title ? getSetting()->site_title : 'Infix LMS'}} | Lives @endsection
@section('css') @endsection
@section('js') @endsection

@section('mainContent')

    <!-- bradcam::start  -->
    <div class="breadcrumb_area bradcam_bg_2">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="breadcam_wrap">
                        <span>Courses</span>
                        <h3>Join the Millions for
                            better learning.</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- bradcam::end  -->

    <!-- course ::start  -->
    <div class="courses_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-xl-3">
                    <div class="course_category_chose mb_30 mt_10">
                        <div class="course_title mb_30 d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="19.5" height="13" viewBox="0 0 19.5 13">
                                <g id="filter-icon" transform="translate(28)">
                                    <rect id="Rectangle_1" data-name="Rectangle 1" width="19.5" height="2" rx="1"
                                          transform="translate(-28)" fill="#fb1159"/>
                                    <rect id="Rectangle_2" data-name="Rectangle 2" width="15.5" height="2" rx="1"
                                          transform="translate(-26 5.5)" fill="#fb1159"/>
                                    <rect id="Rectangle_3" data-name="Rectangle 3" width="5" height="2" rx="1"
                                          transform="translate(-20.75 11)" fill="#fb1159"/>
                                </g>
                            </svg>
                            <h5 class="font_16 f_w_500 mb-0">Filter Category</h5>
                        </div>
                        <div class="course_category_inner">
                            <div class="single_course_categry">
                                <h4 class="font_18 f_w_700">
                                    Course Category
                                </h4>
                                <ul class="Check_sidebar">
                                    @if(isset($categories))
                                        @foreach ($categories as $category)
                                            <li>
                                                <label class="primary_checkbox d-flex">
                                                    <input type="checkbox">
                                                    <span class="checkmark mr_15"></span>
                                                    <span class="label_name">{{$category->name}}</span>
                                                </label>
                                            </li>
                                        @endforeach
                                    @endif

                                </ul>
                            </div>
                            <div class="single_course_categry">
                                <h4 class="font_18 f_w_700">
                                    Level
                                </h4>
                                <ul class="Check_sidebar">
                                    <li>
                                        <label class="primary_checkbox d-flex">
                                            <input type="checkbox">
                                            <span class="checkmark mr_15"></span>
                                            <span class="label_name">Personal Development</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="primary_checkbox d-flex">
                                            <input type="checkbox">
                                            <span class="checkmark mr_15"></span>
                                            <span class="label_name">All Level</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="primary_checkbox d-flex">
                                            <input type="checkbox">
                                            <span class="checkmark mr_15"></span>
                                            <span class="label_name">Beginner</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="primary_checkbox d-flex">
                                            <input type="checkbox">
                                            <span class="checkmark mr_15"></span>
                                            <span class="label_name">Intermediate</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="primary_checkbox d-flex">
                                            <input type="checkbox">
                                            <span class="checkmark mr_15"></span>
                                            <span class="label_name">Expert</span>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                            <div class="single_course_categry">
                                <h4 class="font_18 f_w_700">
                                    Course Price
                                </h4>
                                <ul class="Check_sidebar">
                                    <li>
                                        <label class="primary_checkbox d-flex">
                                            <input type="checkbox">
                                            <span class="checkmark mr_15"></span>
                                            <span class="label_name">Paid Course</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="primary_checkbox d-flex">
                                            <input type="checkbox">
                                            <span class="checkmark mr_15"></span>
                                            <span class="label_name">Free Course</span>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                            <div class="single_course_categry">
                                <h4 class="font_18 f_w_700">
                                    Language
                                </h4>
                                <ul class="Check_sidebar">
                                    @if(isset($languages))
                                        @foreach ($languages as $language)
                                            <li>
                                                <label class="primary_checkbox d-flex">
                                                    <input type="checkbox">
                                                    <span class="checkmark mr_15"></span>
                                                    <span class="label_name">{{$language->name}}</span>
                                                </label>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-xl-9">
                    <div class="row">
                        <div class="col-12">
                            <div class="box_header d-flex flex-wrap align-items-center justify-content-between">
                                <h5 class="font_16 f_w_500 mb_30">2.000+ Course are found</h5>
                                <div class="box_header_right mb_30">
                                    <div class="short_select d-flex align-items-center">
                                        <h5 class="mr_10 font_16 f_w_500 mb-0">Short By:</h5>
                                        <select class="small_select">
                                            <option data-display="None">None</option>
                                            <option value="1">Prise</option>
                                            <option value="2">Date</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(isset($courses))
                            @foreach ($courses as $course)

                                <div class="col-lg-6 col-xl-4">
                                    <div class="quiz_wizged mb_30">
                                        <div class="thumb">
                                            <a href="{{route('courseDetailsView',[@$course->id,@$course->slug])}}">
                                                <img class="w-100"
                                                     src="{{ file_exists($course->thumbnail) ? asset($course->thumbnail) : asset('public/\uploads/course_sample.png') }}"
                                                     alt="">
                                                <span class="prise_tag">
                                    @if (@$course->discount_price!=null)
                                                        {{getPriceFormat($course->discount_price)}}
                                                    @else
                                                        {{getPriceFormat($course->price)}}
                                                    @endif</span>
                                                <span class="live_tag">Live</span>
                                            </a>
                                        </div>
                                        <div class="course_content">
                                            <a href="{{route('classDetails',[@$course->id,@$course->slug])}}">
                                                <h4 class="noBrake" title=" {{$course->title}}">
                                                    {{$course->title}}
                                                </h4>
                                            </a>
                                            <div class="rating_cart">
                                                <div class="rateing">
                                                    <span>{{getTotalRating($course->id)}}/5</span>
                                                    <i class="fas fa-star"></i>
                                                </div>
                                                <a href="#" class="cart_store">
                                                    <i class="fas fa-shopping-cart"></i>
                                                </a>
                                            </div>
                                            <div class="course_less_students">

                                                <a href="#"> <i class="ti-user"></i> {{$course->total_enrolled}}
                                                    Students
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
