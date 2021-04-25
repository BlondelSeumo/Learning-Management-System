@extends('backend.master')

@section('mainContent')
    <section class="sms-breadcrumb mb-10 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>{{__('setting.Api Settings')}}</h1>
                <div class="bc-pages">
                    <a href="{{url('dashboard')}}">{{__('common.Dashboard')}} </a>
                    <a href="#">{{__('setting.Setting')}}</a>
                    <a href="#">{{__('setting.Api Settings')}}</a>
                </div>
            </div>
        </div>
    </section>


    <section class="mb-40 student-details">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row pt-20">
                        <div class="main-title pt-10">
                            <h3 class="mb-10 ml-3">{{__('setting.Api Settings')}}</h3>
                        </div>

                    </div>

                    <div class="row pt-20">
                        <ul class="nav nav-tabs no-bottom-border  mt-sm-md-20 mb-10 ml-3" role="tablist">
                            <li class="nav-item m-1">
                                <a class="nav-link active"
                                   href="#googleMap"
                                   role="tab" data-toggle="tab">{{__('setting.Google')}}</a>
                            </li>
                            <li class="nav-item m-1">
                                <a class="nav-link"
                                   href="#fixer"
                                   role="tab" data-toggle="tab">{{__('setting.Fixer')}}</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active show "
                             id="googleMap">
                            @if (permissionCheck('paymentmethodsetting.payment_method_setting_update'))
                                <form class="form-horizontal" action="{{route('save.api.setting')}}"
                                      method="POST" enctype="multipart/form-data">
                                    @endif
                                    @csrf
                                    <div class="white-box">
                                        <div class="col-md-12 ">
                                            <div class="row mb-30">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-lg-12 mb-30">
                                                            <div class="input-effect">
                                                                <input class="primary-input form-control "
                                                                       type="text" name="gmap_key"
                                                                       autocomplete="off"
                                                                       value="{{$setting->gmap_key}}">
                                                                <label>{{__('setting.Google API Key')}}
                                                                    <span></span> </label>
                                                                <span class="focus-border"></span>
                                                                <span
                                                                    class="text-danger">{{$errors->first('gmap_key')}}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 mb-30">
                                                            <div class="input-effect">
                                                                <input class="primary-input form-control"
                                                                       type="number" name="zoom_level"
                                                                       id="zoom_level" autocomplete="off"
                                                                       value="{{$setting->zoom_level}}">
                                                                <label>{{__('setting.Zoom Level')}}
                                                                    <span></span> </label>
                                                                <span class="focus-border"></span>
                                                                <span
                                                                    class="text-danger">{{$errors->first('zoom_level')}}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 mb-30">
                                                            <div class="input-effect">
                                                                <input class="primary-input form-control "
                                                                       type="text" name="lat"
                                                                       autocomplete="off"
                                                                       value="{{$setting->lat}}">
                                                                <label>{{__('setting.Latitude')}}
                                                                    <span></span> </label>
                                                                <span class="focus-border"></span>
                                                                <span
                                                                    class="text-danger">{{$errors->first('lat')}}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 mb-30">
                                                            <div class="input-effect">
                                                                <input class="primary-input form-control"
                                                                       type="text" name="lng"
                                                                       id="lng" autocomplete="off"
                                                                       value="{{$setting->lng}}">
                                                                <label>{{__('setting.Longitude')}}
                                                                    <span></span> </label>
                                                                <span class="focus-border"></span>
                                                                <span
                                                                    class="text-danger">{{$errors->first('lng')}}</span>
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-40">
                                                <div class="col-lg-12 text-center">
                                                    <button class="primary-btn fix-gr-bg">
                                                        <span class="ti-check"></span>
                                                        {{__('common.Update')}}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                        </div>
                        <div role="tabpanel" class="tab-pane fade"
                             id="fixer">
                            @if (permissionCheck('paymentmethodsetting.payment_method_setting_update'))
                                <form class="form-horizontal" action="{{route('save.api.setting')}}"
                                      method="POST" enctype="multipart/form-data">
                                    @endif
                                    @csrf
                                    <div class="white-box">
                                        <div class="col-md-12 ">
                                            <div class="row mb-30">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-lg-12 mb-10">
                                                            <div class="input-effect">
                                                                <input class="primary-input form-control"
                                                                       type="text" name="fixer_key"
                                                                       autocomplete="off"
                                                                       value="{{$setting->fixer_key}}">
                                                                <label>{{__('setting.Fixer Key')}}
                                                                    <span></span> </label>
                                                                <span class="focus-border"></span>
                                                                <span class="modal_input_validation red_alert"></span>
                                                            </div>
                                                        </div>
                                                       <div class="col-lg-12">
                                                           <code><a
                                                                   href="https://fixer.io/">{{__('setting.Click Here to Get Fixer Api Key')}}</a></code>
                                                       </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-40">
                                                <div class="col-lg-12 text-center">
                                                    <button class="primary-btn fix-gr-bg">
                                                        <span class="ti-check"></span>
                                                        {{__('common.Update')}}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@push('scripts')
@endpush
