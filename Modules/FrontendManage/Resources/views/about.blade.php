@extends('backend.master')
@section('table'){{__('testimonials')}}@endsection
@section('mainContent')
    @include("backend.partials.alertMessage")
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>{{__('frontendmanage.Home Content')}}</h1>
                <div class="bc-pages">
                    <a href="{{route('dashboard')}}">{{__('common.Dashboard')}}</a>
                    <a href="#">{{__('frontendmanage.Frontend CMS')}}</a>
                    <a class="active"
                       href="{{url('frontendmanage.sectionSetting')}}">{{__('frontendmanage.About Content')}}</a>
                </div>
            </div>
        </div>
    </section>

    <section class="mb-40 student-details">
        <div class="container-fluid p-0">
            <div class="row">

                <div class="col-lg-12">
                    <div class="row pt-20">
                        <div class="main-title pl-3 pt-10">
                            <h3 class="mb-30">{{__('frontendmanage.About Content')}}</h3>
                        </div>
                    </div>


                    <form class="form-horizontal"
                          action="  @if (permissionCheck('frontend.AboutPage')) {{route('frontend.saveAboutPage')}}@endif"
                          method="POST"
                          enctype="multipart/form-data">

                        @csrf
                        <div class="white-box">
                            <div class="row">
                                <div class="col-md-12 ">
                                    <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                                    <input type="hidden" name="id" value="{{@$about->id}}">
                                    <div class="row mb-30">
                                        <div class="col-xl-12">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label"
                                                       for="">{{__('frontendmanage.Banner Title')}} *</label>
                                                <input class="primary_input_field"
                                                       {{ $errors->has('banner_title') ? ' autofocus' : '' }}
                                                       placeholder="{{__('frontendmanage.Banner Title')}}"
                                                       type="text" name="banner_title"
                                                       value="{{isset($about)? $about->banner_title : ''}}">
                                            </div>
                                        </div>

                                        <div class="col-xl-12">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label"
                                                       for="">{{__('frontendmanage.Who We Are')}} *</label>
                                                <input class="primary_input_field"
                                                       placeholder="{{__('frontendmanage.Who We Are')}}"
                                                       type="text" name="who_we_are"
                                                       {{ $errors->has('who_we_are') ? ' autofocus' : '' }}
                                                       value="{{isset($about)? $about->who_we_are : ''}}">
                                            </div>
                                        </div>

                                        <div class="col-xl-12">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label"
                                                       for="">{{__('frontendmanage.Story Title')}} </label>
                                                <input class="primary_input_field"
                                                       placeholder="{{__('frontendmanage.Story Title')}}"
                                                       type="text" name="story_title"
                                                       {{ $errors->has('story_title') ? ' autofocus' : '' }}
                                                       value="{{isset($about)? $about->story_title : ''}}">
                                            </div>
                                        </div>

                                        <div class="col-xl-12">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label"
                                                       for="">{{ __('frontendmanage.Story Description') }}
                                                </label>

                                                <input class="primary_input_field"
                                                       placeholder="{{__('frontendmanage.Story Description')}}"
                                                       type="text" name="story_description"
                                                       {{ $errors->has('story_description') ? ' autofocus' : '' }}
                                                       value="{{isset($about)? $about->story_description : ''}}">

                                            </div>
                                        </div>


                                        <div class="col-xl-12">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label"
                                                       for="">{{__('frontendmanage.Teacher Title')}} *</label>
                                                <input class="primary_input_field"
                                                       placeholder="{{__('frontendmanage.Teacher Title')}}"
                                                       type="text" name="teacher_title"
                                                       {{ $errors->has('teacher_title') ? ' autofocus' : '' }}
                                                       value="{{isset($about)? $about->teacher_title : ''}}">
                                            </div>
                                        </div>

                                        <div class="col-xl-12">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label"
                                                       for="">{{ __('frontendmanage.Teacher Details') }}
                                                </label>
                                                <input class="primary_input_field"
                                                       placeholder="{{__('frontendmanage.Teacher Details')}}"
                                                       type="text" name="teacher_details"
                                                       {{ $errors->has('teacher_details') ? ' autofocus' : '' }}
                                                       value="{{isset($about)? $about->teacher_details : ''}}">

                                            </div>
                                        </div>

                                        <div class="col-xl-12">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label"
                                                       for="">{{__('frontendmanage.Student Title')}} </label>
                                                <input class="primary_input_field"
                                                       placeholder="{{__('frontendmanage.Student Title')}}"
                                                       type="text" name="student_title"
                                                       {{ $errors->has('student_title') ? ' autofocus' : '' }}
                                                       value="{{isset($about)? $about->student_title : ''}}">
                                            </div>
                                        </div>

                                        <div class="col-xl-12">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label"
                                                       for="">{{ __('frontendmanage.Student Details') }}
                                                </label>

                                                <input class="primary_input_field"
                                                       placeholder="{{__('frontendmanage.Student Details')}}"
                                                       type="text" name="student_details"
                                                       {{ $errors->has('student_details') ? ' autofocus' : '' }}
                                                       value="{{isset($about)? $about->student_details : ''}}">

                                            </div>
                                        </div>

                                        <div class="col-xl-12">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label"
                                                       for="">{{__('frontendmanage.Course Title')}} </label>
                                                <input class="primary_input_field"
                                                       placeholder="{{__('frontendmanage.Course Title')}}"
                                                       type="text" name="course_title"
                                                       {{ $errors->has('course_title') ? ' autofocus' : '' }}
                                                       value="{{isset($about)? $about->course_title : ''}}">
                                            </div>
                                        </div>

                                        <div class="col-xl-12">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label"
                                                       for="">{{ __('frontendmanage.Course Details') }}
                                                </label>

                                                <input class="primary_input_field"
                                                       placeholder="{{__('frontendmanage.Course Title')}}"
                                                       type="text" name="course_details"
                                                       {{ $errors->has('course_details') ? ' autofocus' : '' }}
                                                       value="{{isset($about)? $about->course_details : ''}}">

                                            </div>
                                        </div>

                                        <div class="col-xl-2">
                                            <div class="primary_input mb-25">

                                                <img class="w-100 imagePreview1"
                                                     src="{{asset(isset($about)? $about->image1 : '')}}"
                                                     alt="">

                                            </div>
                                        </div>
                                        <div class="col-xl-4">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label"
                                                       for="">{{ __('frontendmanage.Image 1') }}
                                                </label>
                                                <div class="primary_file_uploader">
                                                    <input
                                                        class="primary-input  filePlaceholder {{ @$errors->has('image1') ? ' is-invalid' : '' }}"
                                                        type="text" id=""
                                                        placeholder="Browse file"
                                                        readonly="" {{ $errors->has('image1') ? ' autofocus' : '' }}>
                                                    <button class="" type="button">
                                                        <label class="primary-btn small fix-gr-bg"
                                                               for="file1">{{ __('common.Browse') }}</label>
                                                        <input type="file" class="d-none imgInput1"
                                                               name="image1" id="file1">
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-2">
                                            <div class="primary_input mb-25">

                                                <img class="w-100 imagePreview2"
                                                     src="{{asset(isset($about)? $about->image2 : '')}}"
                                                     alt="">

                                            </div>
                                        </div>
                                        <div class="col-xl-4">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label"
                                                       for="">{{ __('frontendmanage.Image 2') }}
                                                </label>
                                                <div class="primary_file_uploader">
                                                    <input
                                                        class="primary-input  filePlaceholder {{ @$errors->has('image2') ? ' is-invalid' : '' }}"
                                                        type="text" id=""
                                                        placeholder="Browse file"
                                                        readonly="" {{ $errors->has('image2') ? ' autofocus' : '' }}>
                                                    <button class="" type="button">
                                                        <label class="primary-btn small fix-gr-bg"
                                                               for="file2">{{ __('common.Browse') }}</label>
                                                        <input type="file" class="d-none imgInput2"
                                                               name="image2" id="file2">
                                                    </button>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-xl-2">
                                            <div class="primary_input mb-25">

                                                <img class="w-100 imagePreview3"
                                                     src="{{asset(isset($about)? $about->image3 : '')}}"
                                                     alt="">

                                            </div>
                                        </div>
                                        <div class="col-xl-4">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label"
                                                       for="">{{ __('frontendmanage.Image 3') }}
                                                </label>
                                                <div class="primary_file_uploader">
                                                    <input
                                                        class="primary-input  filePlaceholder {{ @$errors->has('image3') ? ' is-invalid' : '' }}"
                                                        type="text" id=""
                                                        placeholder="Browse file"
                                                        readonly="" {{ $errors->has('image3') ? ' autofocus' : '' }}>
                                                    <button class="" type="button">
                                                        <label class="primary-btn small fix-gr-bg"
                                                               for="file3">{{ __('common.Browse') }}</label>
                                                        <input type="file" class="d-none imgInput3"
                                                               name="image3" id="file3">
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-2">
                                            <div class="primary_input mb-25">

                                                <img class="w-100 imagePreview4"
                                                     src="{{asset(isset($about)? $about->image4 : '')}}"
                                                     alt="">

                                            </div>
                                        </div>
                                        <div class="col-xl-4">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label"
                                                       for="">{{ __('frontendmanage.Image 4') }}
                                                </label>
                                                <div class="primary_file_uploader">
                                                    <input
                                                        class="primary-input  filePlaceholder {{ @$errors->has('image4') ? ' is-invalid' : '' }}"
                                                        type="text" id=""
                                                        placeholder="Browse file"
                                                        readonly="" {{ $errors->has('image4') ? ' autofocus' : '' }}>
                                                    <button class="" type="button">
                                                        <label class="primary-btn small fix-gr-bg"
                                                               for="file4">{{ __('common.Browse') }}</label>
                                                        <input type="file" class="d-none imgInput4"
                                                               name="image4" id="file4">
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
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

    </script>
@endpush
