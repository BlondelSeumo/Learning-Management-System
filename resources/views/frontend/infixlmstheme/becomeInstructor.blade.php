@extends('frontend.infixlmstheme.layouts.master')
@section('title'){{getSetting()->site_title ? getSetting()->site_title : 'Infix LMS'}} |{{__('frontendmanage.Become Instructor')}} @endsection
@section('css') @endsection
@section('js')
    <script src="{{asset('public/frontend/infixlmstheme/js/become_instructor.js')}}"></script>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            {{\Brian2694\Toastr\Facades\Toastr::error($error) }}
        @endforeach
    @endif
@endsection

@section('mainContent')
    <!-- bradcam::start  -->
    <div class="breadcrumb_area bradcam_bg_2"
         style="background-image: url('{{asset(@$frontendContent->become_instructor_page_banner)}}')">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="breadcam_wrap">
                        <span>
                            {{@$frontendContent->become_instructor_page_title}}
                        </span>
                        <h3>
                            {{@$frontendContent->become_instructor_page_sub_title}}
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- bradcam::end  -->
    <!-- join instructor part here -->
    <section class="instructor_process section_padding bg-white">
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-lg-4 col-sm-6">
                    <div class="single_instructor_part">
                        <i class="{{$icon_left->icon}} fa-5x"></i>
                        <h4>{{$icon_left->title}}</h4>
                        <p>{{$icon_left->description}}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="single_instructor_part">
                        <i class="{{$icon_mid->icon}} fa-5x"></i>
                        <h4>{{$icon_mid->title}}</h4>
                        <p>{{$icon_mid->description}}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="single_instructor_part">
                        <i class="{{$icon_right->icon}} fa-5x"></i>
                        <h4>{{$icon_right->title}}</h4>
                        <p>{{$icon_right->description}}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- join instructor part end -->

    <!-- cta part -->
    <section class="cta_part instructor_cta section_padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-8">
                    <div class="cta_part_iner">
                        <h2>{{$joining_part->title}}</h2>
                        <p> {{$joining_part->description}}</p>
                        <!-- Button trigger modal -->
                        @if(getSetting()->instructor_reg==1)
                            <a href="#" class="theme_btn" data-toggle="modal"
                               data-target="#Instructor">
                                @if(!empty($joining_part->btn_name))
                                    {{$joining_part->btn_name}}
                                @else
                                    {{__('frontendmanage.Become Instructor')}}
                                @endif
                            </a>
                        @endif
                    <!-- Modal -->
                        @if(getSetting()->instructor_reg==1)
                            <div class="modal fade" id="Instructor" tabindex="-1" role="dialog"
                                 aria-labelledby="InstructorTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content cs_modal">
                                        <div class="modal-header">
                                            <h5 class="modal-title"
                                                id="InstructorTitle">{{__('frontendmanage.Become Instructor')}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true" class="ti-close"></span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('register')}}" method="POST">
                                                @csrf
                                                <div class="form-row">
                                                    <div class="form-group col-md-12">
                                                        <input type="text" class="form-control "
                                                               placeholder="{{__('student.Enter Full Name')}}*"
                                                               aria-label="Username"
                                                               name="name" value="{{old('name')}}">
                                                        <span class="text-danger"
                                                              role="alert">{{$errors->first('name')}}</span>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <input type="email" class="form-control "
                                                               placeholder="{{__('common.Enter Email')}}*"
                                                               aria-label="email" name="email" value="{{old('email')}}">
                                                        <span class="text-danger"
                                                              role="alert">{{$errors->first('email')}}</span>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <input type="text" class="form-control "
                                                               placeholder="{{__('common.Enter Phone Number')}}"
                                                               aria-label="phone" name="phone" value="{{old('phone')}}">
                                                        <span class="text-danger"
                                                              role="alert">{{$errors->first('phone')}}</span>
                                                    </div>
                                                </div>

                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <input type="password" class="form-control"
                                                               placeholder="{{__('frontend.Enter Password')}}*"
                                                               aria-label="password" name="password">
                                                        <span class="text-danger"
                                                              role="alert">{{$errors->first('password')}}</span>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <input type="password" class="form-control"
                                                               placeholder="{{__('common.Enter Confirm Password')}}*"
                                                               name="password_confirmation"
                                                               aria-label="password_confirmation">
                                                        <span class="text-danger"
                                                              role="alert">{{$errors->first('password_confirmation')}}</span>
                                                    </div>
                                                </div>


                                                <div class="col-12 ">
                                                    <div class="remember_forgot_pass d-flex align-items-center">
                                                        <label class="primary_checkbox d-flex" for="checkbox">
                                                            <input checked="" type="checkbox" id="checkbox">
                                                            <span class="checkmark mr_15"></span>
                                                            <span>{{__('frontend.By signing up, you agree to')}}
                                                            <a target="_blank" href="{{route('privacy')}}">
                                                                {{__('frontend.Terms of Service and Privacy Policy')}}.
                                                            </a>
                                                        </span>

                                                        </label>

                                                    </div>

                                                </div>
                                                <input type="hidden" name="type" value="Instructor">

                                                @auth
                                                    <div class="form-group col-md-12">
                                                        <small
                                                            class="text-danger">* {{__("Already login. You can't register right now")}}
                                                            .</small>
                                                    </div>
                                                @endauth
                                                @guest
                                                    <button type="submit" class="theme_btn small_btn2" id="submitBtn"
                                                            @auth disabled @endauth>
                                                        {{__('common.Register')}}
                                                    </button>
                                                @endguest
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- cta part end -->

    <!-- cta part -->
    <section class="work_process section_padding bg-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="section__title  text-center mb_50">
                        <h3>
                            {{$work->section}}
                        </h3>
                        <p>
                            {{$work->title}}

                        </p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-between align-items-center">
                <div class="col-md-5 col-xl-4">
                    <div class="work_process_content">
                        @if(isset($processes))
                            @foreach($processes as $key=>$p)
                                <div class="single_work_process">
                                    <div class="list_number">
                                        0{{++$key}}
                                    </div>
                                    <h4>{{$p->title}}</h4>
                                    <p>
                                        {{$p->description}}
                                    </p>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-md-7 col-xl-7">
                    <div class="work_process_video">
                        <div class="video_img">
                            <img src="{{asset($work->image)}}" alt="#"
                                 class="img-fluid">
                            <a href="{{youtubeVideo($work->video)}}" class="popup_video popup-video"><i
                                    class="fas fa-play"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- cta part end -->

    <!-- cta part -->
    <section class="cta_part section_padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8">
                    <div class="cta_part_iner">
                        <h2>{{$cta_part->title}}</h2>
                        <p>{{$cta_part->description}}</p>
                        @if(getSetting()->instructor_reg==1)
                            <a href="#" class="theme_btn" data-toggle="modal"
                               data-target="#Instructor">

                                @if(!empty($joining_part->btn_name))
                                    {{$cta_part->btn_name}}
                                @else
                                    {{__('frontendmanage.Become Instructor')}}
                                @endif
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- cta part end -->



@endsection
