@extends('setting::layouts.master')

@section('mainContent')
    @include("backend.partials.alertMessage")
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
                            <h3 class="mb-0 mr-30">{{ __('setting.Settings') }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="">
                        <div class="row">
                            <div class="col-lg-4">
                                <!-- myTab  -->
                                <div class="white_box_30px mb_30">
                                    <ul class="nav custom_nav" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="activation-tab" data-toggle="tab"
                                               href="#Activation" role="tab" aria-controls="home"
                                               aria-selected="true">{{ __('setting.Activation') }}</a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" id="General-tab" data-toggle="tab" href="#General"
                                               role="tab" aria-controls="home"
                                               aria-selected="true">{{ __('setting.General') }}</a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" id="Company_Information-tab" data-toggle="tab"
                                               href="#Company_Information" role="tab"
                                               aria-controls="Company_Information"
                                               aria-selected="false">{{ __('setting.Company Information') }}</a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" id="SMTP-tab" data-toggle="tab" href="#SMTP" role="tab"
                                               aria-controls="contact"
                                               aria-selected="false">{{ __('setting.SMTP') }}</a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" id="SMS-tab" data-toggle="tab" href="#SMS" role="tab"
                                               aria-controls="contact" aria-selected="false">{{ __('setting.SMS') }}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="social-tab" data-toggle="tab" href="#social"
                                               role="tab" aria-controls="contact"
                                               aria-selected="false">{{ __('setting.Social Login') }}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="seo-tab" data-toggle="tab" href="#seo" role="tab"
                                               aria-controls="contact"
                                               aria-selected="false">{{ __('setting.SEO Setting') }}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <!-- tab-content  -->
                                <div class="tab-content " id="myTabContent">
                                    <!-- General -->
                                    <div class="tab-pane fade white_box_30px show active" id="Activation"
                                         role="tabpanel" aria-labelledby="Activation-tab">
                                        @include('setting::page_components.activation')
                                    </div>
                                    <!-- General -->
                                    <div class="tab-pane fade white_box_30px show" id="General" role="tabpanel"
                                         aria-labelledby="General-tab">
                                        @include('setting::page_components.general_settings')
                                    </div>

                                    <!-- Company_Information  -->
                                    <div class="tab-pane fade white_box_30px" id="Company_Information" role="tabpanel"
                                         aria-labelledby="Company_Information-tab">
                                        @include('setting::page_components.company_info_settings')
                                    </div>

                                    <!-- SMTP  -->
                                @include('setting::page_components.smtp_setting')

                                <!-- SMS  -->
                                    <div class="tab-pane fade white_box_30px " id="SMS" role="tabpanel"
                                         aria-labelledby="SMS-tab">

                                        <!-- SMS Settings  -->

                                        @include('setting::page_components.sms_settings')
                                    </div>


                                    <div class="tab-pane fade white_box_30px " id="social" role="tabpanel"
                                         aria-labelledby="social-tab">

                                        @include('setting::page_components.social_login')
                                    </div>
                                    <div class="tab-pane fade white_box_30px " id="seo" role="tabpanel"
                                         aria-labelledby="seo-tab">

                                        @include('setting::page_components.seo_setting')
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
