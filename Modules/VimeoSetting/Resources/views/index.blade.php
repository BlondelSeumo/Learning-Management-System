@extends('backend.master')

@section('mainContent')

    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>{{__('setting.Vimeo Configuration')}}</h1>
                <div class="bc-pages">
                    <a href="{{url('dashboard')}}">{{__('common.Dashboard')}} </a>
                    <a href="#">{{__('setting.Setting')}}</a>
                    <a href="#">{{__('setting.Vimeo Configuration')}}</a>
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
                            <h3 class="mb-30">{{__('setting.Vimeo Settings')}}</h3>
                        </div>
                    </div>
                    @if (permissionCheck('vimeosetting.update'))
                        <form class="form-horizontal" action="{{route('vimeosetting.update')}}" method="POST">
                            @endif
                            @csrf
                            <div class="white-box">

                                <div class="col-md-12 p-0">
                                    <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                                    <input type="hidden" name="id" value="{{@$videoSetting->id}}">
                                    <div class="row mb-30">
                                        <div class="col-md-12">

                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="">{{ __('setting.Vimeo App ID') }} *</label>
                                                        <input class="primary_input_field" placeholder="-" type="text"
                                                               name="vimeo_app_id" value="{{env('VIMEO_APP_ID')}}">
                                                    </div>
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="">{{ __('setting.Vimeo Client') }} *</label>
                                                        <input class="primary_input_field" placeholder="-" type="text"
                                                               name="vimeo_client" value="{{env('VIMEO_CLIENT')}}">
                                                    </div>
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="">{{ __('setting.Vimeo Secret') }} *</label>
                                                        <input class="primary_input_field" placeholder="-" type="text"
                                                               name="vimeo_secret" value="{{env('VIMEO_SECRET')}}">
                                                    </div>
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="">{{ __('setting.Vimeo Access') }} *</label>
                                                        <input class="primary_input_field" placeholder="-" type="text"
                                                               name="vimeo_access" value="{{env('VIMEO_ACCESS')}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-7">
                                            <div class="row justify-content-center">

                                                @if(session()->has('message-success'))
                                                    <p class=" text-success">
                                                        {{ session()->get('message-success') }}
                                                    </p>
                                                @elseif(session()->has('message-danger'))
                                                    <p class=" text-danger">
                                                        {{ session()->get('message-danger') }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @php
                                    $tooltip = "";
                                    if(permissionCheck('vimeosetting.update')){
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
