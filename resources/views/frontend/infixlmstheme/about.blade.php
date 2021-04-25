@extends('frontend.infixlmstheme.layouts.master')
@section('title'){{getSetting()->site_title ? getSetting()->site_title : 'Infix LMS'}} | {{__('common.About')}} @endsection
@section('css') @endsection
@section('js') @endsection

@section('mainContent')
    <style>
        .counter_area::before {
            background-image: url('{{asset($about->image4)}}');
        }
    </style>
    <div class="breadcrumb_area bradcam_bg_2"
         style="background-image: url('{{asset(@$frontendContent->about_page_banner)}}')">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="breadcam_wrap">
                        <span>
                            {{@$frontendContent->about_page_title}}
                        </span>
                        <h3>
                            {{@$frontendContent->about_sub_title}}
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- bradcam::end  -->

    <!-- who_we::start  -->
    <div class="who_we_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="who_we_info">
                        <div class="info_left">
                            <span>WHO WE ARE</span>
                            <p>{{$about->who_we_are}}</p>
                        </div>
                        <div class="info_right">
                            <p>{{$about->banner_title}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- who_we::end  -->

    <!-- about_gallery::start  -->
    <div class="about_gallery_area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 mb_30">
                    <div class="about_gallery">
                        <div class="gallery_box">
                            <div class="thumb">
                                <img class="w-100" src="{{asset($about->image1)}}" alt="">
                            </div>
                            <div class="thumb small_thumb">
                                <img class="w-100" src="{{asset($about->image2)}}" alt="">
                            </div>
                        </div>
                        <div class="gallery_box">
                            <div class="thumb">
                                <img class="w-100" src="{{asset($about->image3)}}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="section__title">
                        <h3>{{$about->story_title}}</h3>
                        <p>{{$about->story_description}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- about_gallery::end  -->

    <div class="counter_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="counter_wrapper">
                        <div class="single_counter">
                            <h3><span class="counter">{{$instructors}}</span>+</h3>
                            <div class="counter_content">
                                <h4>{{$about->teacher_title}}</h4>
                                <p>{{$about->teacher_details}}</p>
                            </div>
                        </div>
                        <div class="single_counter">
                            <h3><span class="counter">{{$students}}</span>+</h3>
                            <div class="counter_content">
                                <h4>{{$about->student_title}}</h4>
                                <p>{{$about->student_details}}</p>
                            </div>
                        </div>
                        <div class="single_counter">
                            <h3><span class="counter">{{$courses}}</span>+</h3>
                            <div class="counter_content">
                                <h4>{{$about->course_title}}</h4>
                                <p>{{$about->course_details}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="testmonial_area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section__title text-center mb_80">
                        <h3>{{@$homeContent->testimonial_title}}</h3>
                        <p>
                            {{@$homeContent->testimonial_sub_title}}

                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="testmonail_active owl-carousel">
                        @if(@$testimonials != "")
                            @foreach ($testimonials as $testimonial)
                                <div class="single_testmonial">
                                    <div class="testmonial_header d-flex align-items-center">
                                        <div class="thumb profile_info ">
                                            <div class="profile_img">
                                                <div class="testimonialImage"
                                                     style="background-image: url('{{getTestimonialImage($testimonial->image)}}')"></div>
                                            </div>

                                        </div>
                                        <div class="reviewer_name">
                                            <h4>{{@$testimonial->author}}</h4>
                                            <div class="rate d-flex align-items-center">

                                                @for($i=1;$i<=$testimonial->star;$i++)
                                                    <i class="fas fa-star"></i>
                                                @endfor

                                            </div>
                                        </div>
                                    </div>
                                    <p> “{{@$testimonial->body}}”</p>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- BRAND::START  -->
    <div class="brand_area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <div class="barnd_wrapper brand_active owl-carousel">
                        @foreach($sponsors as $sponsor)
                            <div class="single_brand">
                                <img src="{{asset($sponsor->image)}}" alt="{{$sponsor->title}}">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BRAND::END  -->

    <div class="service_cta_area">
        <div class="container">
            <div class="border_top_1px"></div>
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <div class="row">
                        <div class="offset-3 col-lg-6 ">

                            <div class="single_cta_service mb_30">
                                <div class="thumb">
                                    <img src="{{asset(@$frontendContent->become_instructor_logo)}}" alt="">
                                </div>
                                <div class="cta_service_info">
                                    <h4>  {{@$frontendContent->become_instructor_title}}</h4>
                                    <p>  {{@$frontendContent->become_instructor_sub_title}}
                                    </p>
                                    <a href="{{route('becomeInstructor')}}"
                                       class="theme_btn small_btn">{{__('frontend.Start Teaching')}}</a>
                                </div>
                            </div>


                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
