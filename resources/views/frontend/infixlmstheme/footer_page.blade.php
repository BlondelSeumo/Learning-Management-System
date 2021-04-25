@extends('frontend.infixlmstheme.layouts.master')
@section('title'){{getSetting()->site_title ? getSetting()->site_title : 'Infix LMS'}} |  {{$page->name}} @endsection
@section('css') @endsection
@section('js') @endsection

@section('mainContent')

    <!-- bradcam::start  -->
    <div class="breadcrumb_area bradcam_bg_10">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 offset-lg-1">
                    <div class="breadcam_wrap ">
                        <h3>{{$page->name}}</h3>
                    </div>
                </div>
            </div>
    <!-- CONTACT::START  -->
        </div>
    </div>
    <!-- bradcam::end  -->

    <div class="contact_section ">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <div class="contact_address">
                        <div class="row justify-content-center">
                            <div class="col-xl-12">
                                <div class="row justify-content-between">
                                    <div class="col-lg-12 p-5">
                                        <div class="contact_title">
                                            <h4 class="mb-0">{{$page->name}}</h4>
                                        </div>
                                        <div class="address_lines py-3">
                                            {!! $page->description !!}
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

@endsection
