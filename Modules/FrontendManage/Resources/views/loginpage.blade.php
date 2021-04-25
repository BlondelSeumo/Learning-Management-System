@extends('setting::layouts.master')

@section('mainContent')
    @include("backend.partials.alertMessage")
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>{{ __('frontendmanage.Login Page') }}</h1>
                <div class="bc-pages">
                    <a href="{{route('dashboard')}}">{{__('common.Dashboard')}}</a>
                    <a href="#">{{__('frontendmanage.Frontend CMS')}}</a>
                    <a class="active"
                       href="{{route('frontend.loginpage.index')}}">{{__('frontendmanage.Login Page')}}</a>
                </div>
            </div>
        </div>
    </section>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="box_header">
                        <div class="main-title d-flex">

                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="">
                        <div class="row">

                            <div class="col-lg-12">
                                <!-- tab-content  -->
                                <div class="tab-content " id="myTabContent">
                                    <!-- General -->
                                    <div class="tab-pane fade white_box_30px show active" id="Activation"
                                         role="tabpanel" aria-labelledby="Activation-tab">
                                        <div class="main-title mb-25">
                                            <div class="main-title mb-25">
                                                <h3 class="mb-0">{{ __('frontendmanage.Login Page') }}</h3>
                                            </div>
                                            @if (permissionCheck('frontend.loginpage.store'))
                                                <form action="{{route('frontend.loginpage.store')}}" id="form_data_id"
                                                      method="POST"
                                                      enctype="multipart/form-data">
                                                    @endif
                                                    @csrf
                                                    <div class="General_system_wrap_area">
                                                        <div class="single_system_wrap">
                                                            <div class="single_system_wrap_inner text-center">
                                                                <div class="logo">
                                                                    <span>{{ __('frontendmanage.Banner Image') }}</span>
                                                                </div>
                                                                <div class="logo_img">
                                                                    <img class="imagePreview1"
                                                                         src="{{asset($page->banner)}}"
                                                                         style="width: 200px;max-width: 100%; height: auto;"
                                                                         alt="">

                                                                </div>
                                                                <div class="update_logo_btn">
                                                                    <button class="primary-btn small fix-gr-bg"
                                                                            type="button">
                                                                        <input class="imgInput1"
                                                                               placeholder="Upload Header Logo"
                                                                               type="file" name="banner"
                                                                               id="site_logo">
                                                                        {{ __('frontendmanage.Banner Image') }}
                                                                    </button>
                                                                </div>
                                                                <a href="#"
                                                                   class="remove_logo">{{ __('setting.Remove') }}</a>
                                                            </div>

                                                        </div>

                                                        <div class="single_system_wrap">
                                                            <div class="row">
                                                                <div class="col-xl-12">
                                                                    <div class="primary_input mb-25">
                                                                        <label class="primary_input_label"
                                                                               for="">{{ __('frontendmanage.Title') }}</label>
                                                                        <input class="primary_input_field"
                                                                               placeholder="InfixLMS" type="text"
                                                                               id="site_title"
                                                                               name="title"
                                                                               value="{{$page->title}}">
                                                                    </div>
                                                                </div>

                                                                <div class="col-xl-4">
                                                                    <div class="primary_input mb-25">
                                                                        <label class="primary_input_label"
                                                                               for="slogan1">{{__('frontendmanage.Slogan 1')}}</label>
                                                                        <input class="primary_input_field"
                                                                               placeholder="Excellence" type="text"
                                                                               id="slogan1"
                                                                               name="slogan1"
                                                                               value="{{$page->slogans1}}">
                                                                    </div>
                                                                </div>


                                                                <div class="col-xl-4">
                                                                    <div class="primary_input mb-25">
                                                                        <label class="primary_input_label"
                                                                               for="slogan2">{{__('frontendmanage.Slogan 2')}}</label>
                                                                        <input class="primary_input_field"
                                                                               placeholder="Diversity." type="text"
                                                                               id="slogan2"
                                                                               name="slogan2"
                                                                               value="{{$page->slogans2}}">
                                                                    </div>
                                                                </div>

                                                                <div class="col-xl-4">
                                                                    <div class="primary_input mb-25">
                                                                        <label class="primary_input_label"
                                                                               for="slogan3">{{__('frontendmanage.Slogan 3')}}</label>
                                                                        <input class="primary_input_field"
                                                                               placeholder="Community." type="text"
                                                                               id="slogan3"
                                                                               name="slogan3"
                                                                               value="{{$page->slogans3}}">
                                                                    </div>
                                                                </div>


                                                            </div>
                                                        </div>
                                                    </div>
                                                    @php
                                                        $tooltip = "";
                                                        if(permissionCheck('settings.general_setting_update')){
                                                            $tooltip = "";
                                                        }else{
                                                            $tooltip = "You have no permission to add";
                                                        }
                                                    @endphp
                                                    <div class="submit_btn text-center mt-4">
                                                        <button class="primary_btn_large" type="submit"
                                                                data-toggle="tooltip" title="{{$tooltip}}"
                                                                id="general_info_sbmt_btn"><i
                                                                class="ti-check"></i> {{ __('common.Save') }}</button>
                                                    </div>
                                                </form>
                                        </div>
                                    </div>

                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </section>
@endsection

@include('frontendmanage::script')
