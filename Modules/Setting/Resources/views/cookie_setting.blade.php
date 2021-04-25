@extends('setting::layouts.master')

@section('mainContent')
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>{{__('setting.Cookies settings')}} </h1>
                <div class="bc-pages">
                    <a href="{{route('dashboard')}}">{{__('dashboard.Dashboard')}} </a>
                    <a href="#">{{__('setting.Settings')}} </a>
                    <a href="#">{{__('setting.Cookies settings')}}</a>
                </div>
            </div>
        </div>
    </section>

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
                                                <h3 class="mb-0">{{ __('setting.General') }}</h3>
                                            </div>

                                            <form action="{{route('setting.cookieSettingStore')}}" id="" method="POST"
                                                  enctype="multipart/form-data">

                                                @csrf

                                                <div class="single_system_wrap">
                                                    <div class="row">

                                                        <div class="col-xl-6">
                                                            <div class="primary_input mb-25">
                                                                <label class="primary_input_label"
                                                                       for="">{{__('common.Title')}}</label>
                                                                <input class="primary_input_field"
                                                                       placeholder="Cookies" type="text"
                                                                       id="title"
                                                                       name="title" value="{{ $setting->title }}">
                                                            </div>
                                                        </div>


                                                        <div class="col-xl-6 ">
                                                            <div class="primary_input mb-25">
                                                                <div class="row">
                                                                    <div class="col-md-12 mb-3">
                                                                        <label class="primary_input_label"
                                                                               for=""> {{__('setting.Cookies Allow Enable')}}</label>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <input type="radio"
                                                                               class="common-radio type1"
                                                                               id="type1"
                                                                               name="allow"
                                                                               value="1" {{@$setting->allow==1?"checked":""}}>
                                                                        <label
                                                                            for="type1">{{__('common.Yes')}}</label>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <input type="radio"
                                                                               class="common-radio type2"
                                                                               id="type2"
                                                                               name="allow"
                                                                               value="0" {{@$setting->allow==0?"checked":""}}>
                                                                        <label
                                                                            for="type2">{{__('common.No')}}</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-xl-4">
                                                            <div class="primary_input mb-25">
                                                                <label class="primary_input_label"
                                                                       for="">{{__('setting.Button Text')}}</label>
                                                                <input class="primary_input_field"
                                                                       placeholder="Accept"
                                                                       type="text" id="btn_text"
                                                                       name="btn_text"
                                                                       value="{{ $setting->btn_text }}">
                                                            </div>
                                                        </div>

                                                        <div class="col-xl-4">
                                                            <div class="primary_input mb-25">
                                                                <label class="primary_input_label"
                                                                       for="">{{__('setting.Background Color')}}</label>
                                                                <input class="primary_input_field"
                                                                       placeholder="#000000"
                                                                       type="text" id="bg_color"
                                                                       name="bg_color"
                                                                       value="{{ $setting->bg_color }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4">
                                                            <div class="primary_input mb-25">
                                                                <label class="primary_input_label"
                                                                       for="">{{__('setting.Text Color')}}</label>
                                                                <input class="primary_input_field"
                                                                       placeholder="#ffffff"
                                                                       type="text" id="text_color"
                                                                       name="text_color"
                                                                       value="{{ $setting->text_color }}">
                                                            </div>
                                                        </div>


                                                        <div class="col-xl-12">
                                                            <div class="primary_input mb-25">
                                                                <label class="primary_input_label"
                                                                       for="">{{__('setting.Details')}}</label>
                                                                <textarea name="details"
                                                                          class="lms_summernote">{!! $setting->details !!}</textarea>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>


                                                <div class="submit_btn text-center mt-4">
                                                    <button class="primary_btn_large" type="submit"
                                                            data-toggle="tooltip" title=""
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
    </section>
@endsection

@include('setting::page_components.script')
