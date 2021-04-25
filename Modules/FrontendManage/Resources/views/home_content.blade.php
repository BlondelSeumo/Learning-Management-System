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
                    <a class="active" href="{{url('frontend/home-content')}}">{{__('frontendmanage.Home Content')}}</a>
                </div>
            </div>
        </div>
    </section>


    <section class="mb-40 student-details">
        <div class="container-fluid p-0">
            <div class="row">

                <div class="col-lg-12">


                    @if (permissionCheck('null'))
                        <form class="form-horizontal" action="{{route('frontend.homeContent_Update')}}" method="POST"
                              enctype="multipart/form-data">
                            @endif
                            @csrf
                            <div class="white-box">

                                <div class="col-md-12 ">
                                    <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                                    <input type="hidden" name="id" value="{{@$home_content->id}}">
                                    <div class="row mb-30">
                                        <div class="col-md-12">

                                            <div class="row">

                                                <div class="col-xl-4">
                                                    <div class="primary_input mb-25">
                                                        <img  class="  imagePreview5" style="max-width: 100%"
                                                             src="{{ asset('/'.$home_content->slider_banner)}}"
                                                             alt="">
                                                    </div>
                                                </div>
                                                <div class="col-xl-8">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="">{{ __('frontendmanage.Homepage Banner') }}
                                                        </label>
                                                        <div class="primary_file_uploader">
                                                            <input
                                                                class="primary-input  filePlaceholder {{ @$errors->has('slider_banner') ? ' is-invalid' : '' }}"
                                                                type="text" id=""
                                                                placeholder="Browse file"
                                                                readonly="" {{ $errors->has('slider_banner') ? ' autofocus' : '' }}>
                                                            <button class="" type="button">
                                                                <label class="primary-btn small fix-gr-bg"
                                                                       for="file5">{{ __('common.Browse') }}</label>
                                                                <input type="file" class="d-none fileUpload imgInput5"
                                                                       name="slider_banner" id="file5">
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-12">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="">{{__('frontendmanage.Homepage Banner Title')}} </label>
                                                        <input class="primary_input_field"
                                                               {{ $errors->has('slider_title') ? ' autofocus' : '' }}
                                                               placeholder="{{__('frontendmanage.Homepage Banner Title')}}"
                                                               type="text" name="slider_title"
                                                               value="{{isset($home_content)? $home_content->slider_title : ''}}">
                                                    </div>
                                                </div>


                                                <div class="col-xl-12">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="">{{ __('frontendmanage.Homepage Banner Text') }} </label>
                                                        <input class="primary_input_field"
                                                               placeholder="{{ __('frontendmanage.Homepage Banner Text') }}"
                                                               type="text" name="slider_text"
                                                               {{ $errors->has('slider_text') ? ' autofocus' : '' }}
                                                               value="{{isset($home_content)? $home_content->slider_text : ''}}">
                                                    </div>
                                                </div>
                                                <div class="col-xl-12">
                                                    <hr>
                                                    <br>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-12 ">
                                                    <div class="mb_25">
                                                        <label class="switch_toggle "
                                                               for="key_feature_show">
                                                            <input type="checkbox" class="status_enable_disable"
                                                                   name="show_key_feature"
                                                                   id="key_feature_show"
                                                                   @if (@$home_content->show_key_feature == 1) checked
                                                                   @endif value="1">
                                                            <i class="slider round"></i>


                                                        </label>
                                                        {{__('frontendmanage.Key Features Show In Homepage')}}
                                                    </div>

                                                </div>


                                                <div id="keyFeatureBox" class="col-md-12 text-center"
                                                     style="@if (@$home_content->show_key_feature == 0) display:none
                                                     @endif ">
                                                    <div class="row col-xl-12">
                                                        <div class="col-xl-3 text-left">
                                                            <div class="primary_input mb-25">
                                                                {{isset($home_content)? $home_content->key_feature_title1 : ''}}
                                                            </div>
                                                        </div>

                                                        <div class="col-xl-3 text-left">
                                                            <div class="primary_input mb-25">
                                                                {{isset($home_content)? $home_content->key_feature_subtitle1 : ''}}
                                                            </div>
                                                        </div>

                                                        <div class="col-xl-3">
                                                            <div class="primary_input mb-25">
                                                                <img
                                                                     style="max-width: 100%"
                                                                     src="{{isset($home_content)? asset($home_content->key_feature_logo1) : ''}} "
                                                                     alt="">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-3">
                                                            <div class="primary_input mb-25">
                                                                <button type="button"
                                                                        class="primary-btn radius_30px mr-10 fix-gr-bg"
                                                                        data-toggle="modal" data-target="#keyFeature1">
                                                                    {{__('frontendmanage.Change')}}
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="row col-xl-12">
                                                        <div class="col-xl-3 text-left">
                                                            <div class="primary_input mb-25">
                                                                {{isset($home_content)? $home_content->key_feature_title2 : ''}}
                                                            </div>
                                                        </div>

                                                        <div class="col-xl-3 text-left">
                                                            <div class="primary_input mb-25">
                                                                {{isset($home_content)? $home_content->key_feature_subtitle2 : ''}}
                                                            </div>
                                                        </div>

                                                        <div class="col-xl-3">
                                                            <div class="primary_input mb-25">
                                                                <img
                                                                     style="max-width: 100%"
                                                                     src="{{isset($home_content)? asset($home_content->key_feature_logo2) : ''}} "
                                                                     alt="">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-3">
                                                            <div class="primary_input mb-25">
                                                                <button type="button"
                                                                        class="primary-btn radius_30px mr-10 fix-gr-bg"
                                                                        data-toggle="modal" data-target="#keyFeature2">
                                                                    {{__('frontendmanage.Change')}}

                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="row col-xl-12">
                                                        <div class="col-xl-3 text-left">
                                                            <div class="primary_input mb-25">
                                                                {{isset($home_content)? $home_content->key_feature_title3 : ''}}
                                                            </div>
                                                        </div>

                                                        <div class="col-xl-3 text-left">
                                                            <div class="primary_input mb-25">
                                                                {{isset($home_content)? $home_content->key_feature_subtitle3 : ''}}
                                                            </div>
                                                        </div>

                                                        <div class="col-xl-3">
                                                            <div class="primary_input mb-25">
                                                                <img
                                                                     style="max-width: 100%"
                                                                     src="{{isset($home_content)? asset($home_content->key_feature_logo3) : ''}} "
                                                                     alt="">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-3">
                                                            <div class="primary_input mb-25">
                                                                <button type="button"
                                                                        class="primary-btn radius_30px mr-10 fix-gr-bg"
                                                                        data-toggle="modal" data-target="#keyFeature3">
                                                                    {{__('frontendmanage.Change')}}

                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-12">
                                                    <hr>
                                                    <br>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="">{{ __('frontendmanage.Category Title') }}
                                                        </label>
                                                        <input class="primary_input_field"
                                                               placeholder="{{ __('frontendmanage.Category Title') }}"
                                                               type="text" name="category_title"
                                                               {{ $errors->has('category_title') ? ' autofocus' : '' }}
                                                               value="{{isset($home_content)? $home_content->category_title : ''}}">
                                                    </div>
                                                </div>

                                                <div class="col-xl-12">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="">{{ __('frontendmanage.Category Sub Title') }}</label>
                                                        <input class="primary_input_field"
                                                               placeholder="{{ __('frontendmanage.Category Sub Title') }}"
                                                               type="text" name="category_sub_title"
                                                               {{ $errors->has('category_sub_title') ? ' autofocus' : '' }}
                                                               value="{{isset($home_content)? $home_content->category_sub_title : ''}}">
                                                    </div>
                                                </div>
                                                <div class="col-xl-12">
                                                    <div class="modal fade admin-query" id="keyFeature1">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">{{__('frontendmanage.Change Key Feature')}}
                                                                        1 </h4>
                                                                    <button type="button" class="close"
                                                                            data-dismiss="modal"><i
                                                                            class="ti-close "></i></button>
                                                                </div>

                                                                <div class="modal-body">

                                                                    <div class="col-xl-12">
                                                                        <div class="primary_input mb-25">
                                                                            <label class="primary_input_label"
                                                                                   for="">{{__('common.Title')}}</label>
                                                                            <input class="primary_input_field"
                                                                                   placeholder=""
                                                                                   type="text" name="key_feature_title1"
                                                                                   {{ $errors->has('key_feature_title1') ? ' autofocus' : '' }}
                                                                                   value="{{isset($home_content)? $home_content->key_feature_title1 : ''}}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-xl-12">
                                                                        <div class="primary_input mb-25">
                                                                            <label class="primary_input_label"
                                                                                   for="">                                                                          {{__('frontendmanage.Change')}}
                                                                                {{__('frontendmanage.Key Feature Subtitle')}}
                                                                            </label>
                                                                            <input class="primary_input_field"
                                                                                   placeholder=""
                                                                                   type="text"
                                                                                   name="key_feature_subtitle1"
                                                                                   {{ $errors->has('key_feature_subtitle1') ? ' autofocus' : '' }}
                                                                                   value="{{isset($home_content)? $home_content->key_feature_subtitle1 : ''}}">
                                                                        </div>
                                                                    </div>


                                                                    <div class="col-xl-12">
                                                                        <div class="primary_input mb-25">
                                                                            <label class="primary_input_label"
                                                                                   for="">{{__('frontendmanage.Page Link')}}</label>

                                                                            <select class="primary_select   "
                                                                                    name="key_feature_link1"
                                                                                    {{$errors->has('host') ? 'autofocus' : ''}}
                                                                                    id="">
                                                                                <option
                                                                                    data-display="{{__('common.Select')}} {{__('frontendmanage.Page Link')}}"
                                                                                    value="">{{__('common.Select')}} {{__('frontendmanage.Page Link')}}

                                                                                </option>
                                                                                @foreach($pages as $page)
                                                                                    <option
                                                                                        @if($home_content->key_feature_link1==$page->id) selected @endif value="{{$page->id}}">

                                                                                        {{$page->title}}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>

                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-xl-4">
                                                                            <div class="primary_input mt_25 mb-25">
                                                                                <img  class=" imagePreview6"
                                                                                     style="max-width: 100%"
                                                                                     src="{{ asset('/'.$home_content->key_feature_logo1)}}"
                                                                                     alt="">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xl-8">
                                                                            <div class="primary_input mt_25 mb-25">
                                                                                <label class="primary_input_label"
                                                                                       for="">{{ __('frontendmanage.Key Feature Icon') }}
                                                                                    1
                                                                                </label>
                                                                                <div class="primary_file_uploader">
                                                                                    <input
                                                                                        class="primary-input  filePlaceholder "
                                                                                        type="text" id=""
                                                                                        placeholder="Browse file"
                                                                                        readonly="">
                                                                                    <button class="" type="button">
                                                                                        <label
                                                                                            class="primary-btn small fix-gr-bg"
                                                                                            for="file6">{{ __('common.Browse') }}</label>
                                                                                        <input type="file"
                                                                                               class="d-none fileUpload imgInput6"
                                                                                               name="key_feature_logo1"
                                                                                               id="file6">
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mt-40 d-flex justify-content-between">
                                                                        <button type="button" class="primary-btn tr-bg"
                                                                                data-dismiss="modal">{{__('common.Cancel')}}</button>

                                                                        <button class="primary-btn fix-gr-bg"
                                                                                type="submit">{{__('common.Submit')}}
                                                                        </button>

                                                                    </div>

                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal fade admin-query" id="keyFeature2">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">{{__('frontendmanage.Change Key Feature')}}
                                                                        2 </h4>
                                                                    <button type="button" class="close"
                                                                            data-dismiss="modal"><i
                                                                            class="ti-close "></i></button>
                                                                </div>

                                                                <div class="modal-body">

                                                                    <div class="col-xl-12">
                                                                        <div class="primary_input mb-25">
                                                                            <label class="primary_input_label"
                                                                                   for="">{{__('common.Title')}}</label>
                                                                            <input class="primary_input_field"
                                                                                   placeholder=""
                                                                                   type="text" name="key_feature_title2"
                                                                                   {{ $errors->has('key_feature_title2') ? ' autofocus' : '' }}
                                                                                   value="{{isset($home_content)? $home_content->key_feature_title2 : ''}}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-xl-12">
                                                                        <div class="primary_input mb-25">
                                                                            <label class="primary_input_label"
                                                                                   for="">                                                                          {{__('frontendmanage.Change')}}
                                                                                {{__('frontendmanage.Key Feature Subtitle')}}
                                                                            </label>
                                                                            <input class="primary_input_field"
                                                                                   placeholder=""
                                                                                   type="text"
                                                                                   name="key_feature_subtitle2"
                                                                                   {{ $errors->has('key_feature_subtitle1') ? ' autofocus' : '' }}
                                                                                   value="{{isset($home_content)? $home_content->key_feature_subtitle2 : ''}}">
                                                                        </div>
                                                                    </div>


                                                                    <div class="col-xl-12">
                                                                        <div class="primary_input mb-25">
                                                                            <label class="primary_input_label"
                                                                                   for="">{{__('frontendmanage.Page Link')}}</label>

                                                                            <select class="primary_select   "
                                                                                    name="key_feature_link2"
                                                                                    {{$errors->has('host') ? 'autofocus' : ''}}
                                                                                    id="">
                                                                                <option
                                                                                    data-display="{{__('common.Select')}} {{__('frontendmanage.Page Link')}}"
                                                                                    value="">{{__('common.Select')}} {{__('frontendmanage.Page Link')}}

                                                                                </option>
                                                                                @foreach($pages as $page)
                                                                                    <option
                                                                                        @if($home_content->key_feature_link2==$page->id) selected @endif
                                                                                        value="{{$page->id}}">
                                                                                        {{$page->title}}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>

                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-xl-4">
                                                                            <div class="primary_input mt_25 mb-25">
                                                                                <img  class=" imagePreview7"
                                                                                     style="max-width: 100%"
                                                                                     src="{{ asset('/'.$home_content->key_feature_logo2)}}"
                                                                                     alt="">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xl-8">
                                                                            <div class="primary_input mt_25 mb-25">
                                                                                <label class="primary_input_label"
                                                                                       for="">{{ __('frontendmanage.Key Feature Icon') }}
                                                                                    2
                                                                                </label>
                                                                                <div class="primary_file_uploader">
                                                                                    <input
                                                                                        class="primary-input  filePlaceholder"
                                                                                        type="text" id=""
                                                                                        placeholder="Browse file"
                                                                                        readonly="">
                                                                                    <button class="" type="button">
                                                                                        <label
                                                                                            class="primary-btn small fix-gr-bg"
                                                                                            for="file7">{{ __('common.Browse') }}</label>
                                                                                        <input type="file"
                                                                                               class="d-none fileUpload imgInput7"
                                                                                               name="key_feature_logo2"
                                                                                               id="file7">
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mt-40 d-flex justify-content-between">
                                                                        <button type="button" class="primary-btn tr-bg"
                                                                                data-dismiss="modal">{{__('common.Cancel')}}</button>

                                                                        <button class="primary-btn fix-gr-bg"
                                                                                type="submit">{{__('common.Submit')}}
                                                                        </button>

                                                                    </div>

                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal fade admin-query" id="keyFeature3">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">{{__('frontendmanage.Change Key Feature')}}
                                                                        3 </h4>
                                                                    <button type="button" class="close"
                                                                            data-dismiss="modal"><i
                                                                            class="ti-close "></i></button>
                                                                </div>

                                                                <div class="modal-body">

                                                                    <div class="col-xl-12">
                                                                        <div class="primary_input mb-25">
                                                                            <label class="primary_input_label"
                                                                                   for="">{{__('common.Title')}}</label>
                                                                            <input class="primary_input_field"
                                                                                   placeholder=""
                                                                                   type="text" name="key_feature_title3"
                                                                                   {{ $errors->has('key_feature_title3') ? ' autofocus' : '' }}
                                                                                   value="{{isset($home_content)? $home_content->key_feature_title3 : ''}}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-xl-12">
                                                                        <div class="primary_input mb-25">
                                                                            <label class="primary_input_label"
                                                                                   for="">                                                                          {{__('frontendmanage.Change')}}
                                                                                {{__('frontendmanage.Key Feature Subtitle')}}
                                                                            </label>
                                                                            <input class="primary_input_field"
                                                                                   placeholder=""
                                                                                   type="text"
                                                                                   name="key_feature_subtitle3"
                                                                                   {{ $errors->has('key_feature_subtitle3') ? ' autofocus' : '' }}
                                                                                   value="{{isset($home_content)? $home_content->key_feature_subtitle3 : ''}}">
                                                                        </div>
                                                                    </div>


                                                                    <div class="col-xl-12">
                                                                        <div class="primary_input mb-25">
                                                                            <label class="primary_input_label"
                                                                                   for="">{{__('frontendmanage.Page Link')}}</label>

                                                                            <select class="primary_select   "
                                                                                    name="key_feature_link3"
                                                                                    {{$errors->has('host') ? 'autofocus' : ''}}
                                                                                    id="">
                                                                                <option
                                                                                    data-display="{{__('common.Select')}} {{__('frontendmanage.Page Link')}}"
                                                                                    value="">{{__('common.Select')}} {{__('frontendmanage.Page Link')}}

                                                                                </option>
                                                                                @foreach($pages as $page)
                                                                                    <option
                                                                                        @if($home_content->key_feature_link3==$page->id) selected @endif
                                                                                        value=" {{$page->id}}">

                                                                                        {{$page->title}}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>

                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-xl-4">
                                                                            <div class="primary_input mt_25 mb-25">
                                                                                <img  class=" imagePreview8"
                                                                                     style="max-width: 100%"
                                                                                     src="{{ asset('/'.$home_content->key_feature_logo3)}}"
                                                                                     alt="">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xl-8">
                                                                            <div class="primary_input mt_25 mb-25">
                                                                                <label class="primary_input_label"
                                                                                       for="">{{ __('frontendmanage.Key Feature Icon') }}
                                                                                    3
                                                                                </label>
                                                                                <div class="primary_file_uploader">
                                                                                    <input
                                                                                        class="primary-input  filePlaceholder {{ @$errors->has('instructor_banner') ? ' is-invalid' : '' }}"
                                                                                        type="text" id=""
                                                                                        placeholder="Browse file"
                                                                                        readonly="" {{ $errors->has('instructor_banner') ? ' autofocus' : '' }}>
                                                                                    <button class="" type="button">
                                                                                        <label
                                                                                            class="primary-btn small fix-gr-bg"
                                                                                            for="file8">{{ __('common.Browse') }}</label>
                                                                                        <input type="file"
                                                                                               class="d-none fileUpload imgInput8"
                                                                                               name="key_feature_logo3"
                                                                                               id="file8">
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mt-40 d-flex justify-content-between">
                                                                        <button type="button" class="primary-btn tr-bg"
                                                                                data-dismiss="modal">{{__('common.Cancel')}}</button>

                                                                        <button class="primary-btn fix-gr-bg"
                                                                                type="submit">{{__('common.Submit')}}
                                                                        </button>

                                                                    </div>

                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <br>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-xl-4">
                                                    <div class="primary_input mb-25">
                                                        <img  class=" imagePreview1" style="max-width: 100%"
                                                             src="{{ asset('/'.$home_content->instructor_banner)}}"
                                                             alt="">
                                                    </div>
                                                </div>
                                                <div class="col-xl-8">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="">{{ __('frontendmanage.Instructor  Banner') }}
                                                        </label>
                                                        <div class="primary_file_uploader">
                                                            <input
                                                                class="primary-input  filePlaceholder {{ @$errors->has('instructor_banner') ? ' is-invalid' : '' }}"
                                                                type="text" id=""
                                                                placeholder="Browse file"
                                                                readonly="" {{ $errors->has('instructor_banner') ? ' autofocus' : '' }}>
                                                            <button class="" type="button">
                                                                <label class="primary-btn small fix-gr-bg"
                                                                       for="file1">{{ __('common.Browse') }}</label>
                                                                <input type="file" class="d-none fileUpload imgInput1"
                                                                       name="instructor_banner" id="file1">
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-xl-12">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="">{{ __('frontendmanage.Instructor Title') }}</label>
                                                        <input class="primary_input_field"
                                                               placeholder="{{ __('frontendmanage.Instructor Title') }}"
                                                               type="text" name="instructor_title"
                                                               {{ $errors->has('instructor_title') ? ' autofocus' : '' }}
                                                               value="{{isset($home_content)? $home_content->instructor_title : ''}}">
                                                    </div>
                                                </div>

                                                <div class="col-xl-12">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="">{{ __('frontendmanage.Instructor Sub Title') }}</label>
                                                        <input class="primary_input_field"
                                                               placeholder="{{ __('frontendmanage.Instructor Sub Title') }}"
                                                               type="text" name="instructor_sub_title"
                                                               {{ $errors->has('instructor_sub_title') ? ' autofocus' : '' }}
                                                               value="{{isset($home_content)? $home_content->instructor_sub_title : ''}}">
                                                    </div>
                                                </div>
                                                <div class="col-xl-12">
                                                    <hr>
                                                    <br>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-xl-4">
                                                    <div class="primary_input mb-25">

                                                        <img  class="  imagePreview2" style="max-width: 100%"
                                                             src="{{asset('/'.$home_content->best_category_banner)}}"
                                                             alt="">

                                                    </div>
                                                </div>
                                                <div class="col-xl-8">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="">{{ __('frontendmanage.Best Category  Banner') }}
                                                        </label>
                                                        <div class="primary_file_uploader">
                                                            <input
                                                                class="primary-input  filePlaceholder {{ @$errors->has('best_category_banner') ? ' is-invalid' : '' }}"
                                                                type="text" id=""
                                                                placeholder="Browse file"
                                                                readonly="" {{ $errors->has('best_category_banner') ? ' autofocus' : '' }}>
                                                            <button class="" type="button">
                                                                <label class="primary-btn small fix-gr-bg"
                                                                       for="file2">{{ __('common.Browse') }}</label>
                                                                <input type="file" class="d-none imgInput2"
                                                                       name="best_category_banner" id="file2">
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-12">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="">{{ __('frontendmanage.Course Title') }}</label>
                                                        <input class="primary_input_field"
                                                               placeholder="{{ __('frontendmanage.Course Title') }}"
                                                               type="text" name="course_title"
                                                               {{ $errors->has('course_title') ? ' autofocus' : '' }}
                                                               value="{{isset($home_content)? $home_content->course_title : ''}}">
                                                    </div>
                                                </div>

                                                <div class="col-xl-12">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="">{{ __('frontendmanage.Course Sub Title') }}</label>
                                                        <input class="primary_input_field"
                                                               placeholder="{{ __('frontendmanage.Course Sub Title') }}"
                                                               type="text" name="course_sub_title"
                                                               {{ $errors->has('instructor_title') ? ' autofocus' : '' }}
                                                               value="{{isset($home_content)? $home_content->course_sub_title : ''}}">
                                                    </div>
                                                </div>

                                                <div class="col-xl-12">
                                                    <hr>
                                                    <br>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="">{{ __('frontendmanage.Best Course Title') }}</label>
                                                        <input class="primary_input_field"
                                                               placeholder="{{ __('frontendmanage.Best Course Title') }}"
                                                               type="text" name="best_category_title"
                                                               {{ $errors->has('course_title') ? ' autofocus' : '' }}
                                                               value="{{isset($home_content)? $home_content->best_category_title : ''}}">
                                                    </div>
                                                </div>

                                                <div class="col-xl-12">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="">{{ __('frontendmanage.Best Course Sub Title') }}</label>
                                                        <input class="primary_input_field"
                                                               placeholder="{{ __('frontendmanage.Best Course Sub Title') }}"
                                                               type="text" name="best_category_sub_title"
                                                               {{ $errors->has('best_category_sub_title') ? ' autofocus' : '' }}
                                                               value="{{isset($home_content)? $home_content->best_category_sub_title : ''}}">
                                                    </div>
                                                </div>
                                                <div class="col-xl-12">
                                                    <hr>
                                                    <br>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="">{{ __('frontendmanage.Quiz Title') }}</label>
                                                        <input class="primary_input_field"
                                                               placeholder="{{ __('frontendmanage.Quiz Title') }}"
                                                               type="text" name="quiz_title"
                                                               {{ $errors->has('quiz_title') ? ' autofocus' : '' }}
                                                               value="{{isset($home_content)? $home_content->quiz_title : ''}}">
                                                    </div>
                                                </div>
                                                <div class="col-xl-12">
                                                    <hr>
                                                    <br>
                                                </div>
                                            </div>

                                            <div class="row">

                                                <div class="col-xl-12">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="">{{ __('frontendmanage.Testimonial Title') }}
                                                        </label>
                                                        <input class="primary_input_field"
                                                               placeholder="{{ __('frontendmanage.Testimonial Title') }}"
                                                               type="text" name="testimonial_title"
                                                               {{ $errors->has('testimonial_title') ? ' autofocus' : '' }}
                                                               value="{{isset($home_content)? $home_content->testimonial_title : ''}}">
                                                    </div>
                                                </div>

                                                <div class="col-xl-12">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="">{{ __('frontendmanage.Testimonial Sub Title') }}</label>
                                                        <input class="primary_input_field"
                                                               placeholder="{{ __('frontendmanage.Testimonial Sub Title') }}"
                                                               type="text" name="testimonial_sub_title"
                                                               {{ $errors->has('testimonial_sub_title') ? ' autofocus' : '' }}
                                                               value="{{isset($home_content)? $home_content->testimonial_sub_title : ''}}">
                                                    </div>
                                                </div>

                                                <div class="col-xl-12">
                                                    <hr>
                                                    <br>
                                                </div>
                                            </div>

                                            <div class="row">


                                                <div class="col-xl-12">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="">{{ __('frontendmanage.Article Title') }}</label>
                                                        <input class="primary_input_field"
                                                               placeholder="{{ __('frontendmanage.Article Title') }}"
                                                               type="text" name="article_title"
                                                               {{ $errors->has('article_title') ? ' autofocus' : '' }}
                                                               value="{{isset($home_content)? $home_content->article_title : ''}}">
                                                    </div>
                                                </div>

                                                <div class="col-xl-12">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="">{{ __('frontendmanage.Article Sub Title') }}</label>
                                                        <input class="primary_input_field"
                                                               placeholder="{{ __('frontendmanage.Article Sub Title') }}"
                                                               type="text" name="article_sub_title"
                                                               {{ $errors->has('article_sub_title') ? ' autofocus' : '' }}
                                                               value="{{isset($home_content)? $home_content->article_sub_title : ''}}">
                                                    </div>
                                                </div>

                                                <div class="col-xl-12">
                                                    <hr>
                                                    <br>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-4">
                                                    <div class="primary_input mb-25">

                                                        <img  class="  imagePreview3" style="max-width: 100%"
                                                             src="{{asset('/'.$home_content->subscribe_logo)}}"
                                                             alt="">

                                                    </div>
                                                </div>
                                                <div class="col-xl-8">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="">{{ __('frontendmanage.Subscribe Logo') }}
                                                        </label>
                                                        <div class="primary_file_uploader">
                                                            <input
                                                                class="primary-input  filePlaceholder {{ @$errors->has('subscribe_logo') ? ' is-invalid' : '' }}"
                                                                type="text" id=""
                                                                placeholder="Browse file"
                                                                readonly="" {{ $errors->has('subscribe_logo') ? ' autofocus' : '' }}>
                                                            <button class="" type="button">
                                                                <label class="primary-btn small fix-gr-bg"
                                                                       for="file3">{{ __('common.Browse') }}</label>
                                                                <input type="file" class="d-none imgInput3"
                                                                       name="subscribe_logo" id="file3">
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-12">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="">{{ __('frontendmanage.Subscribe Title') }}</label>
                                                        <input class="primary_input_field"
                                                               placeholder="{{ __('frontendmanage.Subscribe Title') }}"
                                                               type="text" name="subscribe_title"
                                                               {{ $errors->has('subscribe_title') ? ' autofocus' : '' }}
                                                               value="{{isset($home_content)? $home_content->subscribe_title : ''}}">
                                                    </div>
                                                </div>


                                                <div class="col-xl-12">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="">{{ __('frontendmanage.Subscribe Sub Title') }}</label>
                                                        <input class="primary_input_field"
                                                               placeholder="{{ __('frontendmanage.Subscribe Sub Title') }}"
                                                               type="text" name="subscribe_sub_title"
                                                               {{ $errors->has('subscribe_sub_title') ? ' autofocus' : '' }}
                                                               value="{{isset($home_content)? $home_content->subscribe_sub_title : ''}}">
                                                    </div>
                                                </div>
                                                <div class="col-xl-12">
                                                    <hr>
                                                    <br>
                                                </div>
                                            </div>

                                            <div class="row">


                                                <div class="col-xl-4">
                                                    <div class="primary_input mb-25">

                                                        <img  class=" imagePreview4" style="max-width: 100%"
                                                             src="{{asset('/'.$home_content->become_instructor_logo)}}"
                                                             alt="">

                                                    </div>
                                                </div>
                                                <div class="col-xl-8">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="">{{ __('frontendmanage.Become Instructor Logo') }}
                                                        </label>
                                                        <div class="primary_file_uploader">
                                                            <input
                                                                class="primary-input  filePlaceholder {{ @$errors->has('become_instructor_logo') ? ' is-invalid' : '' }}"
                                                                type="text" id=""
                                                                placeholder="Browse file"
                                                                readonly="" {{ $errors->has('become_instructor_logo') ? ' autofocus' : '' }}>
                                                            <button class="" type="button">
                                                                <label class="primary-btn small fix-gr-bg"
                                                                       for="file4">{{ __('common.Browse') }}</label>
                                                                <input type="file" class="d-none imgInput4"
                                                                       name="become_instructor_logo" id="file4">
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-12">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="">{{ __('frontendmanage.Become Instructor Title') }}</label>
                                                        <input class="primary_input_field"
                                                               placeholder="{{ __('frontendmanage.Become Instructor Title') }}"
                                                               type="text" name="become_instructor_title"
                                                               {{ $errors->has('become_instructor_title') ? ' autofocus' : '' }}
                                                               value="{{isset($home_content)? $home_content->become_instructor_title : ''}}">
                                                    </div>
                                                </div>


                                                <div class="col-xl-12">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="">{{ __('frontendmanage.Become Instructor Sub Title') }}</label>
                                                        <input class="primary_input_field"
                                                               placeholder="{{ __('frontendmanage.Become Instructor Sub Title') }}"
                                                               type="text" name="become_instructor_sub_title"
                                                               {{ $errors->has('become_instructor_sub_title') ? ' autofocus' : '' }}
                                                               value="{{isset($home_content)? $home_content->become_instructor_sub_title : ''}}">
                                                    </div>
                                                </div>

                                                <div class="col-xl-12">
                                                    <hr>
                                                    <br>
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

        let status = $('#key_feature_show');
        status.change(function () {
            if (status.is(':checked')) {
                $('#keyFeatureBox').show();
            } else {
                $('#keyFeatureBox').hide();
            }
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
    </script>
@endpush
