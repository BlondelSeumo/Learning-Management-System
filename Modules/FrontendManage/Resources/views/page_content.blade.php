@extends('backend.master')
@section('table'){{__('testimonials')}}@endsection
@section('mainContent')
    @include("backend.partials.alertMessage")
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>{{__('frontendmanage.Page Content')}}</h1>
                <div class="bc-pages">
                    <a href="{{route('dashboard')}}">{{__('common.Dashboard')}}</a>
                    <a href="#">{{__('frontendmanage.Frontend CMS')}}</a>
                    <a class="active" href="{{url('frontend/page-content')}}">{{__('frontendmanage.Page Content')}}</a>
                </div>
            </div>
        </div>
    </section>


    <section class="mb-40 student-details">
        <div class="container-fluid p-0">
            <div class="row">

                <div class="col-lg-12">


                    @if (permissionCheck('null'))
                        <form class="form-horizontal" action="{{route('frontend.pageContent_Update')}}" method="POST"
                              enctype="multipart/form-data">
                            @endif
                            @csrf
                            <div class="white-box">

                                <div class="col-md-12 ">
                                    <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                                    <input type="hidden" name="id" value="{{@$page_content->id}}">
                                    <div class="row mb-30">
                                        <div class="col-md-12">

                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="">{{ __('frontendmanage.Course Page Title') }}
                                                        </label>
                                                        <input class="primary_input_field"
                                                               placeholder="{{ __('frontendmanage.Course Page Title') }}"
                                                               type="text" name="course_page_title"
                                                               {{ $errors->has('course_page_title') ? ' autofocus' : '' }}
                                                               value="{{isset($page_content)? $page_content->course_page_title : ''}}">
                                                    </div>
                                                </div>

                                                <div class="col-xl-6">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="">{{ __('frontendmanage.Course Page Sub Title') }}</label>
                                                        <input class="primary_input_field"
                                                               placeholder="{{ __('frontendmanage.Course Page Sub Title') }}"
                                                               type="text" name="course_page_sub_title"
                                                               {{ $errors->has('course_page_sub_title') ? ' autofocus' : '' }}
                                                               value="{{isset($page_content)? $page_content->course_page_sub_title : ''}}">
                                                    </div>
                                                </div>


                                                <div class="col-xl-2">
                                                    <div class="primary_input mb-25">
                                                        <img height="70" class="w-100 imagePreview1"
                                                             src="{{ asset('/'.$page_content->course_page_banner)}}"
                                                             alt="">
                                                    </div>
                                                </div>
                                                <div class="col-xl-4">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="">{{ __('frontendmanage.Course Page Banner') }}
                                                        </label>
                                                        <div class="primary_file_uploader">
                                                            <input
                                                                class="primary-input  filePlaceholder {{ @$errors->has('course_page_banner') ? ' is-invalid' : '' }}"
                                                                type="text" id=""
                                                                placeholder="Browse file"
                                                                readonly="" {{ $errors->has('course_page_banner') ? ' autofocus' : '' }}>
                                                            <button class="" type="button">
                                                                <label class="primary-btn small fix-gr-bg"
                                                                       for="file1">{{ __('common.Browse') }}</label>
                                                                <input type="file" class="d-none fileUpload imgInput1"
                                                                       name="course_page_banner" id="file1">
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="">{{ __('frontendmanage.Class Page Title') }}
                                                        </label>
                                                        <input class="primary_input_field"
                                                               placeholder="{{ __('frontendmanage.Class Page Title') }}"
                                                               type="text" name="class_page_title"
                                                               {{ $errors->has('class_page_title') ? ' autofocus' : '' }}
                                                               value="{{isset($page_content)? $page_content->class_page_title : ''}}">
                                                    </div>
                                                </div>

                                                <div class="col-xl-6">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="">{{ __('frontendmanage.Class Page Sub Title') }}</label>
                                                        <input class="primary_input_field"
                                                               placeholder="{{ __('frontendmanage.Class Page Sub Title') }}"
                                                               type="text" name="class_page_sub_title"
                                                               {{ $errors->has('class_page_sub_title') ? ' autofocus' : '' }}
                                                               value="{{isset($page_content)? $page_content->class_page_sub_title : ''}}">
                                                    </div>
                                                </div>


                                                <div class="col-xl-2">
                                                    <div class="primary_input mb-25">
                                                        <img height="70" class="w-100 imagePreview2"
                                                             src="{{ asset('/'.$page_content->class_page_banner)}}"
                                                             alt="">
                                                    </div>
                                                </div>
                                                <div class="col-xl-4">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="">{{ __('frontendmanage.Class Page Banner') }}
                                                        </label>
                                                        <div class="primary_file_uploader">
                                                            <input
                                                                class="primary-input  filePlaceholder {{ @$errors->has('class_page_banner') ? ' is-invalid' : '' }}"
                                                                type="text" id=""
                                                                placeholder="Browse file"
                                                                readonly="" {{ $errors->has('class_page_banner') ? ' autofocus' : '' }}>
                                                            <button class="" type="button">
                                                                <label class="primary-btn small fix-gr-bg"
                                                                       for="file2">{{ __('common.Browse') }}</label>
                                                                <input type="file" class="d-none fileUpload imgInput2"
                                                                       name="class_page_banner" id="file2">
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="">{{ __('frontendmanage.Quiz Page Title') }}
                                                        </label>
                                                        <input class="primary_input_field"
                                                               placeholder="{{ __('frontendmanage.Quiz Page Title') }}"
                                                               type="text" name="quiz_page_title"
                                                               {{ $errors->has('class_page_title') ? ' autofocus' : '' }}
                                                               value="{{isset($page_content)? $page_content->quiz_page_title : ''}}">
                                                    </div>
                                                </div>

                                                <div class="col-xl-6">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="">{{ __('frontendmanage.Quiz Page Sub Title') }}</label>
                                                        <input class="primary_input_field"
                                                               placeholder="{{ __('frontendmanage.Quiz Page Sub Title') }}"
                                                               type="text" name="quiz_page_sub_title"
                                                               {{ $errors->has('quiz_page_sub_title') ? ' autofocus' : '' }}
                                                               value="{{isset($page_content)? $page_content->quiz_page_sub_title : ''}}">
                                                    </div>
                                                </div>


                                                <div class="col-xl-2">
                                                    <div class="primary_input mb-25">
                                                        <img height="70" class="w-100 imagePreview3"
                                                             src="{{ asset('/'.$page_content->quiz_page_banner)}}"
                                                             alt="">
                                                    </div>
                                                </div>
                                                <div class="col-xl-4">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="">{{ __('frontendmanage.Quiz Page Banner') }}
                                                        </label>
                                                        <div class="primary_file_uploader">
                                                            <input
                                                                class="primary-input  filePlaceholder {{ @$errors->has('quiz_page_banner') ? ' is-invalid' : '' }}"
                                                                type="text" id=""
                                                                placeholder="Browse file"
                                                                readonly="" {{ $errors->has('quiz_page_banner') ? ' autofocus' : '' }}>
                                                            <button class="" type="button">
                                                                <label class="primary-btn small fix-gr-bg"
                                                                       for="file3">{{ __('common.Browse') }}</label>
                                                                <input type="file" class="d-none fileUpload imgInput3"
                                                                       name="quiz_page_banner" id="file3">
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="">{{ __('frontendmanage.Instructor Page Title') }}
                                                        </label>
                                                        <input class="primary_input_field"
                                                               placeholder="{{ __('frontendmanage.Instructor Page Title') }}"
                                                               type="text" name="instructor_page_title"
                                                               {{ $errors->has('instructor_page_title') ? ' autofocus' : '' }}
                                                               value="{{isset($page_content)? $page_content->instructor_page_title : ''}}">
                                                    </div>
                                                </div>

                                                <div class="col-xl-6">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="">{{ __('frontendmanage.Instructor Page Sub Title') }}</label>
                                                        <input class="primary_input_field"
                                                               placeholder="{{ __('frontendmanage.Instructor Page Sub Title') }}"
                                                               type="text" name="instructor_page_sub_title"
                                                               {{ $errors->has('instructor_page_sub_title') ? ' autofocus' : '' }}
                                                               value="{{isset($page_content)? $page_content->instructor_page_sub_title : ''}}">
                                                    </div>
                                                </div>


                                                <div class="col-xl-2">
                                                    <div class="primary_input mb-25">
                                                        <img height="70" class="w-100 imagePreview4"
                                                             src="{{ asset('/'.$page_content->instructor_page_banner)}}"
                                                             alt="">
                                                    </div>
                                                </div>
                                                <div class="col-xl-4">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="">{{ __('frontendmanage.Instructor Page Banner') }}
                                                        </label>
                                                        <div class="primary_file_uploader">
                                                            <input
                                                                class="primary-input  filePlaceholder {{ @$errors->has('instructor_page_banner') ? ' is-invalid' : '' }}"
                                                                type="text" id=""
                                                                placeholder="Browse file"
                                                                readonly="" {{ $errors->has('instructor_page_banner') ? ' autofocus' : '' }}>
                                                            <button class="" type="button">
                                                                <label class="primary-btn small fix-gr-bg"
                                                                       for="file4">{{ __('common.Browse') }}</label>
                                                                <input type="file"
                                                                       class="d-none fileUpload imgInput4   "
                                                                       name="instructor_page_banner" id="file4">
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="">{{ __('frontendmanage.Become Instructor Page Title') }}
                                                        </label>
                                                        <input class="primary_input_field"
                                                               placeholder="{{ __('frontendmanage.Become Instructor Page Title') }}"
                                                               type="text" name="become_instructor_page_title"
                                                               {{ $errors->has('become_instructor_page_title') ? ' autofocus' : '' }}
                                                               value="{{isset($page_content)? $page_content->become_instructor_page_title : ''}}">
                                                    </div>
                                                </div>

                                                <div class="col-xl-6">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="">{{ __('frontendmanage.Become Instructor Page Sub Title') }}</label>
                                                        <input class="primary_input_field"
                                                               placeholder="{{ __('frontendmanage.Become Instructor Page Sub Title') }}"
                                                               type="text" name="become_instructor_page_sub_title"
                                                               {{ $errors->has('become_instructor_sub_title') ? ' autofocus' : '' }}
                                                               value="{{isset($page_content)? $page_content->become_instructor_page_sub_title : ''}}">
                                                    </div>
                                                </div>


                                                <div class="col-xl-2">
                                                    <div class="primary_input mb-25">
                                                        <img height="70" class="w-100 imagePreview8"
                                                             src="{{ asset('/'.$page_content->become_instructor_page_banner)}}"
                                                             alt="">
                                                    </div>
                                                </div>
                                                <div class="col-xl-4">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="">{{ __('frontendmanage.Become Instructor Page Banner') }}
                                                        </label>
                                                        <div class="primary_file_uploader">
                                                            <input
                                                                class="primary-input  filePlaceholder {{ @$errors->has('become_instructor_page_banner') ? ' is-invalid' : '' }}"
                                                                type="text" id=""
                                                                placeholder="Browse file"
                                                                readonly="" {{ $errors->has('become_instructor_page_banner') ? ' autofocus' : '' }}>
                                                            <button class="" type="button">
                                                                <label class="primary-btn small fix-gr-bg"
                                                                       for="file8">{{ __('common.Browse') }}</label>
                                                                <input type="file"
                                                                       class="d-none fileUpload imgInput8   "
                                                                       name="become_instructor_page_banner" id="file8">
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="">{{ __('frontendmanage.Contact Page Title') }}
                                                        </label>
                                                        <input class="primary_input_field"
                                                               placeholder="{{ __('frontendmanage.Contact Page Title') }}"
                                                               type="text" name="contact_page_title"
                                                               {{ $errors->has('contact_page_title') ? ' autofocus' : '' }}
                                                               value="{{isset($page_content)? $page_content->contact_page_title : ''}}">
                                                    </div>
                                                </div>

                                                <div class="col-xl-6">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="">{{ __('frontendmanage.Contact Page Sub Title') }}</label>
                                                        <input class="primary_input_field"
                                                               placeholder="{{ __('frontendmanage.Contact Page Sub Title') }}"
                                                               type="text" name="contact_sub_title"
                                                               {{ $errors->has('contact_sub_title') ? ' autofocus' : '' }}
                                                               value="{{isset($page_content)? $page_content->contact_sub_title : ''}}">
                                                    </div>
                                                </div>


                                                <div class="col-xl-2">
                                                    <div class="primary_input mb-25">
                                                        <img height="70" class="w-100 imagePreview5"
                                                             src="{{ asset('/'.$page_content->contact_page_banner)}}"
                                                             alt="">
                                                    </div>
                                                </div>
                                                <div class="col-xl-4">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="">{{ __('frontendmanage.Contact Page Banner') }}
                                                        </label>
                                                        <div class="primary_file_uploader">
                                                            <input
                                                                class="primary-input  filePlaceholder {{ @$errors->has('contact_page_banner') ? ' is-invalid' : '' }}"
                                                                type="text" id=""
                                                                placeholder="Browse file"
                                                                readonly="" {{ $errors->has('contact_page_banner') ? ' autofocus' : '' }}>
                                                            <button class="" type="button">
                                                                <label class="primary-btn small fix-gr-bg"
                                                                       for="file5">{{ __('common.Browse') }}</label>
                                                                <input type="file" class="d-none fileUpload imgInput5"
                                                                       name="contact_page_banner" id="file5">
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="">{{ __('frontendmanage.About Page Title') }}
                                                        </label>
                                                        <input class="primary_input_field"
                                                               placeholder="{{ __('frontendmanage.About Page Title') }}"
                                                               type="text" name="about_page_title"
                                                               {{ $errors->has('about_page_title') ? ' autofocus' : '' }}
                                                               value="{{isset($page_content)? $page_content->about_page_title : ''}}">
                                                    </div>
                                                </div>

                                                <div class="col-xl-6">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="">{{ __('frontendmanage.About Page Sub Title') }}</label>
                                                        <input class="primary_input_field"
                                                               placeholder="{{ __('frontendmanage.About Page Sub Title') }}"
                                                               type="text" name="about_sub_title"
                                                               {{ $errors->has('about_sub_title') ? ' autofocus' : '' }}
                                                               value="{{isset($page_content)? $page_content->about_sub_title : ''}}">
                                                    </div>
                                                </div>


                                                <div class="col-xl-2">
                                                    <div class="primary_input mb-25">
                                                        <img height="70" class="w-100 imagePreview6"
                                                             src="{{ asset('/'.$page_content->about_page_banner)}}"
                                                             alt="">
                                                    </div>
                                                </div>
                                                <div class="col-xl-4">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="">{{ __('frontendmanage.About Page Banner') }}
                                                        </label>
                                                        <div class="primary_file_uploader">
                                                            <input
                                                                class="primary-input  filePlaceholder {{ @$errors->has('instructor_page_banner') ? ' is-invalid' : '' }}"
                                                                type="text" id=""
                                                                placeholder="Browse file"
                                                                readonly="" {{ $errors->has('about_page_banner') ? ' autofocus' : '' }}>
                                                            <button class="" type="button">
                                                                <label class="primary-btn small fix-gr-bg"
                                                                       for="file6">{{ __('common.Browse') }}</label>
                                                                <input type="file" class="d-none fileUpload imgInput6"
                                                                       name="about_page_banner" id="file6">
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            @if(moduleStatusCheck('Subscription'))
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <div class="primary_input mb-25">
                                                            <label class="primary_input_label"
                                                                   for="">{{ __('subscription.Subscription Page Title') }}
                                                            </label>
                                                            <input class="primary_input_field"
                                                                   placeholder="{{ __('subscription.Subscription Page Title') }}"
                                                                   type="text" name="subscription_page_title"
                                                                   {{ $errors->has('subscription_page_title') ? ' autofocus' : '' }}
                                                                   value="{{isset($page_content)? $page_content->subscription_page_title : ''}}">
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-6">
                                                        <div class="primary_input mb-25">
                                                            <label class="primary_input_label"
                                                                   for="">{{ __('subscription.Subscription Page Sub Title') }}</label>
                                                            <input class="primary_input_field"
                                                                   placeholder="{{ __('subscription.Subscription Page Sub Title') }}"
                                                                   type="text" name="subscription_page_sub_title"
                                                                   {{ $errors->has('subscription_page_sub_title') ? ' autofocus' : '' }}
                                                                   value="{{isset($page_content)? $page_content->subscription_page_sub_title : ''}}">
                                                        </div>
                                                    </div>


                                                    <div class="col-xl-2">
                                                        <div class="primary_input mb-25">
                                                            <img height="70" class="w-100 imagePreview9"
                                                                 src="{{ asset('/'.$page_content->subscription_page_banner)}}"
                                                                 alt="">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4">
                                                        <div class="primary_input mb-25">
                                                            <label class="primary_input_label"
                                                                   for="">{{ __('frontendmanage.Subscription Page Banner') }}
                                                            </label>
                                                            <div class="primary_file_uploader">
                                                                <input
                                                                    class="primary-input  filePlaceholder {{ @$errors->has('subscription_page_banner') ? ' is-invalid' : '' }}"
                                                                    type="text" id=""
                                                                    placeholder="Browse file"
                                                                    readonly="" {{ $errors->has('subscription_page_banner') ? ' autofocus' : '' }}>
                                                                <button class="" type="button">
                                                                    <label class="primary-btn small fix-gr-bg"
                                                                           for="file9">{{ __('common.Browse') }}</label>
                                                                    <input type="file"
                                                                           class="d-none fileUpload imgInput9"
                                                                           name="subscription_page_banner" id="file9">
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @php
                                    $tooltip = "";
                                    if(permissionCheck('null')){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to Update";
                                    }
                                @endphp
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                        <button class="primary-btn fix-gr-bg" data-toggle="tooltip"
                                                title="{{$tooltip}}">
                                            <span class="ti-check"></span>
                                            {{__('common.Update')}}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>

                </div>


            </div>
        </div>
    </section>



@endsection
@push('scripts')
    <script>
        function readURL1(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(".imagePreview1").attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $(".imgInput1").change(function () {
            readURL1(this);
        });

        function readURL2(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(".imagePreview2").attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $(".imgInput2").change(function () {
            readURL2(this);
        });


        function readURL3(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(".imagePreview3").attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $(".imgInput3").change(function () {
            readURL3(this);
        });


        function readURL4(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(".imagePreview4").attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $(".imgInput4").change(function () {
            readURL4(this);
        });


        function readURL5(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(".imagePreview5").attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $(".imgInput5").change(function () {
            readURL5(this);
        });
        $(".imgInput4").change(function () {
            readURL4(this);
        });


        function readURL6(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(".imagePreview6").attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $(".imgInput6").change(function () {
            readURL6(this);
        });

        function readURL7(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(".imagePreview7").attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $(".imgInput7").change(function () {
            readURL7(this);
        });

        function readURL8(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(".imagePreview8").attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $(".imgInput8").change(function () {
            readURL8(this);
        });


        function readURL9(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(".imagePreview9").attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $(".imgInput9").change(function () {
            readURL9(this);
        });
    </script>
@endpush
