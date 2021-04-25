@extends('backend.master')
@section('mainContent')
    <section class="sms-breadcrumb mb-40 up_breadcrumb white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>{{__('zoom.Manage')}} {{__('zoom.Zoom Setting')}}</h1>
                <div class="bc-pages">
                    <a href="{{route('dashboard')}}">{{__('common.Dashboard')}}</a>
                    <a href="#">{{__('zoom.Setting')}}</a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area up_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-12">
                    <form action="{{ route('zoom.settings.update') }}" method="POST">
                        @csrf
                        <div class="white-box">
                            <div class="row p-0">
                                <div class="col-lg-12">
                                    <h3 class="text-center">{{__('zoom.Setting')}}</h3>
                                    <hr>


                                    <div class="row mb-40 mt-40">
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="col-lg-5 d-flex">
                                                    <p class="text-uppercase fw-500 mb-10">{{__('zoom.Class Join Approval')}}</p>
                                                </div>
                                                <div class="col-lg-7">
                                                    <select
                                                        class="w-100 bb niceSelect form-control {{ @$errors->has('approval_type') ? ' is-invalid' : '' }}"
                                                        name="approval_type">
                                                        <option data-display="{{__('zoom.Select')}} *"
                                                                value="">{{__('zoom.Select')}} *
                                                        </option>
                                                        <option
                                                            value="0" @if(!empty($setting)) {{ old('approval_type',$setting->approval_type) == 0? 'selected' : ''}} @endif>
                                                            Automatically
                                                        </option>
                                                        <option
                                                            value="1"@if(!empty($setting)) {{ old('approval_type',$setting->approval_type) == 1? 'selected' : ''}} @endif>
                                                            Manually Approve
                                                        </option>
                                                        <option
                                                            value="2" @if(!empty($setting)) {{ old('approval_type',$setting->approval_type) == 2? 'selected' : ''}} @endif>
                                                            No Registration Required
                                                        </option>
                                                    </select>
                                                    @if ($errors->has('approval_type'))
                                                        <span class="invalid-feedback invalid-select" role="alert">
                                                                <strong>{{ @$errors->first('approval_type') }}</strong>
                                                            </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="col-lg-5 d-flex">
                                                    <p class="text-uppercase fw-500 mb-10">{{__('Host Video')}} </p>
                                                </div>
                                                <div class="col-lg-7">
                                                    <div class="radio-btn-flex ml-20">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="">
                                                                    <input type="radio" name="host_video"
                                                                           id="host_video_on" value="1"
                                                                           class="common-radio relationButton"@if(!empty($setting)) {{ old('host_video',$setting->host_video) == 1 ? 'checked': ''}} @endif>
                                                                    <label
                                                                        for="host_video_on">{{__('zoom.Enable')}}</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="">
                                                                    <input type="radio" name="host_video"
                                                                           id="host_video" value="0"
                                                                           class="common-radio relationButton" @if(!empty($setting)) {{ old('host_video',$setting->host_video) == '0' ? 'checked': ''}}@endif>
                                                                    <label
                                                                        for="host_video">{{__('zoom.Disable')}}</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row mb-40 mt-40">

                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="col-lg-5 d-flex">
                                                    <p class="text-uppercase fw-500 mb-10">{{__('zoom.Auto Recording')}}
                                                        ( {{__('For Paid Package')}} )</p>
                                                </div>
                                                <div class="col-lg-7">
                                                    <select
                                                        class="w-100 bb niceSelect form-control {{ @$errors->has('auto_recording') ? ' is-invalid' : '' }}"
                                                        name="auto_recording">
                                                        <option data-display="{{__('zoom.Select')}} *"
                                                                value="">{{__('zoom.Select')}} *
                                                        </option>
                                                        <option
                                                            value="none" @if(!empty($setting)) {{ old('auto_recording',$setting->auto_recording) == 'none'? 'selected' : ''}} @endif >
                                                            None
                                                        </option>
                                                        <option
                                                            value="local"@if(!empty($setting)) {{ old('auto_recording',$setting->auto_recording) == 'local'? 'selected' : ''}} @endif >
                                                            Local
                                                        </option>
                                                        <option
                                                            value="cloud" @if(!empty($setting)){{ old('auto_recording',$setting->auto_recording) == 'cloud'? 'selected' : ''}} @endif>
                                                            Cloud
                                                        </option>
                                                    </select>
                                                    @if ($errors->has('auto_recording'))
                                                        <span class="invalid-feedback invalid-select" role="alert">
                                                            <strong>{{ @$errors->first('auto_recording') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="col-lg-5 d-flex">
                                                    <p class="text-uppercase fw-500 mb-10">{{__('zoom.Participant video')}} </p>
                                                </div>
                                                <div class="col-lg-7">
                                                    <div class="radio-btn-flex ml-20">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="">
                                                                    <input type="radio" name="participant_video"
                                                                           id="participant_video_on" value="1"
                                                                           class="common-radio relationButton" @if(!empty($setting)) {{ old('participant_video',$setting->participant_video) == 1? 'checked': ''}}@endif>
                                                                    <label
                                                                        for="participant_video_on">{{__('zoom.Enable')}}</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="">
                                                                    <input type="radio" name="participant_video"
                                                                           id="participant_video" value="0"
                                                                           class="common-radio relationButton"@if(!empty($setting)) {{ old('participant_video',$setting->participant_video) == 0? 'checked': ''}} @endif>
                                                                    <label
                                                                        for="participant_video">{{__('zoom.Disable')}}</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row mb-40 mt-40">

                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="col-lg-5 d-flex">
                                                    <p class="text-uppercase fw-500 mb-10">
                                                        {{__('zoom.Audio Options')}}</p>
                                                </div>
                                                <div class="col-lg-7">
                                                    <select
                                                        class="w-100 bb niceSelect form-control {{ @$errors->has('audio') ? ' is-invalid' : '' }}"
                                                        name="audio">
                                                        <option data-display="{{__('zoom.Select')}} *"
                                                                value="">{{__('zoom.Select')}}*
                                                        </option>
                                                        <option
                                                            value="both" @if(!empty($setting)) {{ old('audio',$setting->audio) == 'both' ? 'selected' : ''}} @endif >
                                                            Both
                                                        </option>
                                                        <option
                                                            value="telephony" @if(!empty($setting)) {{ old('audio',$setting->audio) == 'telephony'? 'selected' : ''}} @endif>
                                                            Telephony
                                                        </option>
                                                        <option
                                                            value="voip" @if(!empty($setting)) {{ old('audio',$setting->audio) == 'voip'? 'selected' : ''}} @endif >
                                                            Voip
                                                        </option>

                                                    </select>
                                                    @if ($errors->has('audio'))
                                                        <span class="invalid-feedback invalid-select" role="alert">
                                                            <strong>{{ @$errors->first('audio') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="col-lg-5 d-flex">
                                                    <p class="text-uppercase fw-500 mb-10">{{__('Join Before Host')}} </p>
                                                </div>
                                                <div class="col-lg-7">
                                                    <div class=" radio-btn-flex ml-20">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="">
                                                                    <input type="radio" name="join_before_host"
                                                                           id="join_before_host_on" value="1"
                                                                           class="common-radio relationButton" @if(!empty($setting)) {{  old('join_before_host',$setting->join_before_host) == 1? 'checked': '' }} @endif>
                                                                    <label
                                                                        for="join_before_host_on">{{__('zoom.Enable')}}</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="">
                                                                    <input type="radio" name="join_before_host"
                                                                           id="join_before_host" value="0"
                                                                           class="common-radio relationButton" @if(!empty($setting)) {{ old('join_before_host',$setting->join_before_host) == 0? 'checked': '' }} @endif>
                                                                    <label
                                                                        for="join_before_host">{{__('zoom.Disable')}}</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-40 mt-40">
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="col-lg-5 d-flex">
                                                    <p class="text-uppercase fw-500 mb-10">{{__('zoom.Package')}}</p>
                                                </div>
                                                <div class="col-lg-7">
                                                    <select
                                                        class="w-100 bb niceSelect form-control {{ @$errors->has('package_id') ? ' is-invalid' : '' }}"
                                                        name="package_id">
                                                        <option data-display="{{__('zoom.Select Package')}} *"
                                                                value="">{{__('zoom.Select Package')}} *
                                                        </option>
                                                        <option
                                                            value="1" @if(!empty($setting)) {{ old('package_id',$setting->package_id) == 1 ? 'selected' : ''}} @endif >
                                                            Basic (Free)
                                                        </option>
                                                        <option
                                                            value="2" @if(!empty($setting)){{ old('package_id',$setting->package_id) == 2 ? 'selected' : ''}} @endif >
                                                            Pro
                                                        </option>
                                                        <option
                                                            value="3"@if(!empty($setting)) {{ old('package_id',$setting->package_id) == 3 ? 'selected' : ''}}@endif >
                                                            Business
                                                        </option>
                                                        <option
                                                            value="4" @if(!empty($setting)) {{ old('package_id',$setting->package_id) == 4 ? 'selected' : ''}} @endif >
                                                            Enterprise
                                                        </option>
                                                    </select>
                                                    @if ($errors->has('package_id'))
                                                        <span class="invalid-feedback invalid-select" role="alert">
                                                            <strong>{{ @$errors->first('package_id') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="col-lg-5 d-flex">
                                                    <p class="text-uppercase fw-500 mb-10">{{__('zoom.Waiting Room')}}</p>
                                                </div>
                                                <div class="col-lg-7">
                                                    <div class=" radio-btn-flex ml-20">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="">
                                                                    <input type="radio" name="waiting_room"
                                                                           id="waiting_room_on" value="1"
                                                                           class="common-radio relationButton" @if(!empty($setting)) {{ old('waiting_room',$setting->waiting_room) == 1? 'checked': '' }} @endif>
                                                                    <label
                                                                        for="waiting_room_on">{{__('zoom.Enable')}}</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="">
                                                                    <input type="radio" name="waiting_room"
                                                                           id="waiting_room" value="0"
                                                                           class="common-radio relationButton" @if(!empty($setting)){{ old('waiting_room',$setting->waiting_room) == 0? 'checked': '' }} @endif>
                                                                    <label
                                                                        for="waiting_room">{{__('zoom.Disable')}}</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>

                                    <div class="row mb-40 mt-40">
                                        <div class="col-lg-6">
                                            <div class="input-effect sm2_mb_20 md_mb_20">
                                                <input
                                                    class="primary-input form-control{{ $errors->has('api_key') ? ' is-invalid' : '' }}"
                                                    type="text" name="api_key"
                                                    value="@if(!empty($setting)) {{ old('api_key',$setting->zoom_api_key_of_user) }} @endif">
                                                <label>{{__('zoom.Api Key')}}<span>*</span> </label>
                                                <span class="focus-border"></span>
                                                @if ($errors->has('api_key'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('api_key') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="col-lg-5 d-flex">
                                                    <p class="text-uppercase fw-500 mb-10">
                                                        {{__('zoom.Mute Upon Entry')}} </p>
                                                </div>
                                                <div class="col-lg-7">

                                                    <div class="radio-btn-flex ml-20">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="">
                                                                    <input type="radio" name="mute_upon_entry"
                                                                           id="mute_upon_entr_on" value="1"
                                                                           class="common-radio relationButton" @if(!empty($setting)) {{ old('mute_upon_entry',$setting->mute_upon_entry) == 1? 'checked': ''}} @endif>
                                                                    <label
                                                                        for="mute_upon_entr_on">{{__('zoom.Enable')}} </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="">
                                                                    <input type="radio" name="mute_upon_entry"
                                                                           id="mute_upon_entry" value="0"
                                                                           class="common-radio relationButton" @if(!empty($setting)) {{ old('mute_upon_entry',$setting->mute_upon_entry) == 0? 'checked': ''}} @endif>
                                                                    <label
                                                                        for="mute_upon_entry">{{__('zoom.Disable')}}</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>

                                    <div class="row mb-40 mt-40">
                                        <div class="col-lg-6">
                                            <div class="input-effect sm2_mb_20 md_mb_20">
                                                <input
                                                    class="primary-input form-control{{ $errors->has('secret_key') ? ' is-invalid' : '' }}"
                                                    type="text" name="secret_key"
                                                    value=" @if(!empty($setting)) {{ old('secret_key',$setting->zoom_api_serect_of_user) }} @endif">
                                                <label>{{__('zoom.Secret Key') }}<span>*</span></label>
                                                <span class="focus-border"></span>
                                                @if ($errors->has('secret_key'))
                                                    <span class="invalid-feedback invalid-select" role="alert">
                                                        <strong>{{ $errors->first('secret_key') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row mt-40">
                                        <div class="col-lg-12 text-center">
                                            <button class="primary-btn fix-gr-bg" id="_submit_btn_admission">
                                                <span class="ti-check"></span>
                                                {{__('zoom.Update')}}
                                            </button>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
