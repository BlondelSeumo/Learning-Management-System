@extends('backend.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>{{__('bbb.Classes')}} {{__('bbb.List')}}</h1>
            <div class="bc-pages">
                <a href="{{route('dashboard')}}">{{__('dashboard.Dashboard')}}</a>
                <a href="#">{{__('bbb.Classes')}}</a>
                <a href="#">{{__('bbb.List')}}</a>
            </div>
        </div>
    </div>
</section>


<section class="admin-visitor-area">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-12">

                <div class="main-title">
                    <h3 class="mb-30">
                        @if(isset($editdata))
                            {{__('bbb.Edit')}}
                        @else
                            {{__('bbb.Add')}}
                        @endif
                        {{__('bbb.Classes')}}
                    </h3>
                </div>


                <form class="form-horizontal"
                      action="@if(isset($editdata)){{ route('virtual-class.bbbMeetingStore',$class->id) }} @else {{ route('virtual-class.bbbMeetingStore',$class->id) }} @endif"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="white-box">
                                <div class="row mt-40">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input required
                                                   class="primary-input form-control{{ $errors->has('topic') ? ' is-invalid' : '' }}"
                                                   type="text" name="topic" autocomplete="off"
                                                   value="{{ isset($editdata) ?  old('topic',$editdata->topic) : $class->title }}">
                                            <label>{{__('bbb.Topic')}} <span>*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('topic'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('topic') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-40">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                                              <textarea class="primary-input form-control" cols="0"
                                                                        rows="4"
                                                                        name="description"
                                                                        id="address">{{isset($editdata) ? old('description',$editdata->description) : old('description')}}</textarea>
                                            <label>{{__('bbb.Description')}}</label>
                                            <span class="focus-border textarea"></span>
                                            @if ($errors->has('description'))
                                                <span class="invalid-feedback" role="alert">
                                                          <strong>{{ $errors->first('description') }}</strong>
                                                      </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>


                                <div class="row mt-40">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input required
                                                   class="primary-input form-control{{ $errors->has('attendee_password') ? ' is-invalid' : '' }}"
                                                   type="text" name="attendee_password"
                                                   autocomplete="off"
                                                   value="{{ isset($editdata) ?  old('topic',$editdata->attendee_password) : old('attendee_password') }}">
                                            <label>{{__('bbb.Attendee Password')}}
                                                <span>*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('attendee_password'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('attendee_password') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-40">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input required
                                                   class="primary-input form-control{{ $errors->has('moderator_password') ? ' is-invalid' : '' }}"
                                                   type="text" name="moderator_password"
                                                   autocomplete="off"
                                                   value="{{ isset($editdata) ?  old('topic',$editdata->moderator_password) : old('moderator_password') }}">
                                            <label>{{__('bbb.Moderator Password')}}
                                                <span>*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('moderator_password'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('moderator_password') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-40">
                                    <div class="col-lg-6">
                                        <label>{{__('bbb.Date Of Class')}} <span>*</span></label>
                                        <input class="primary-input date form-control" id="startDate"
                                               type="text"
                                               name="date" readonly="true"
                                               value="{{ isset($editdata) ? old('date',Carbon\Carbon::parse($editdata->date_of_meeting)->format('m/d/Y')): old('date',Carbon\Carbon::now()->format('m/d/Y'))}}"
                                               required>
                                        @if ($errors->has('date'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('date') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="col-lg-6">
                                        <label>{{__('bbb.Time Of Class')}} <span>*</span></label>
                                        <input
                                            class="primary-input time form-control{{ @$errors->has('time') ? ' is-invalid' : '' }}"
                                            type="text" name="time"
                                            value="{{ isset($editdata) ? old('time',$editdata->time_of_meeting): old('time')}}">
                                        <span class="focus-border"></span>
                                        @if ($errors->has('time'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ @$errors->first('time') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>


                                {{-- Start setting  --}}
                                <div class="row mt-40">
                                    <div class="col-lg-12 d-flex">
                                        <p class="text-uppercase fw-500 mb-10"
                                           style="width: 130px;">{{__('bbb.Change Default Settings')}}</p>
                                        <div class="d-flex radio-btn-flex ml-40">
                                            <div class="mr-30 row">
                                                <input type="radio" name="chnage-default-settings"
                                                       id="change_default_settings" value="1"
                                                       @if (isset($editdata)) checked
                                                       @endif class="common-radio chnage-default-settings relationButton">
                                                <label
                                                    for="change_default_settings">{{__('bbb.Yes')}}</label>
                                            </div>
                                            <div class="mr-30 row">
                                                <input type="radio" name="chnage-default-settings"
                                                       id="change_default_settings2" value="0"
                                                       @if (!isset($editdata)) checked
                                                       @endif  class="common-radio chnage-default-settings relationButton">
                                                <label
                                                    for="change_default_settings2">{{__('bbb.No')}}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row mb-40  default-settings">


                                    <div class="col-lg-12 mt-10">
                                        <div class="row">
                                            <div class="col-lg-12 d-flex">
                                                <p class="text-uppercase fw-500 mb-10">{{__('Welcome Message')}} </p>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="radio-btn-flex ml-20">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="">
                                                                <input type="text"
                                                                       name="welcome_message"
                                                                       value="@if(!empty($setting)){{old('welcome_message',$setting->welcome_message)}}@endif"
                                                                       class="form-control">

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mt-10">
                                        <div class="row">
                                            <div class="col-lg-12 d-flex">
                                                <p class="text-uppercase fw-500 mb-10">{{__('Dial Number')}} </p>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="radio-btn-flex ml-20">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="">
                                                                <input type="text" name="dial_number"
                                                                       value="@if(!empty($setting)){{old('dial_number',$setting->dial_number)}}@endif"
                                                                       class="form-control">

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mt-10">
                                        <div class="row">
                                            <div class="col-lg-12 d-flex">
                                                <p class="text-uppercase fw-500 mb-10">{{__('Max Participants')}}
                                                    <small
                                                        class="text-secondary">{{__('0=Unlimited')}}</small>
                                                </p>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="radio-btn-flex ml-20">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="">
                                                                <input type="number"
                                                                       name="max_participants"
                                                                       min="0"
                                                                       value="@if(!empty($setting)){{ old('max_participants',$setting->max_participants)}}@endif"
                                                                       class="form-control">

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mt-10">
                                        <div class="row">
                                            <div class="col-lg-12 d-flex">
                                                <p class="text-uppercase fw-500 mb-10">{{__('Logout Url')}} </p>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="radio-btn-flex ml-20">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="">
                                                                <input type="text" name="logout_url"
                                                                       value="@if(!empty($setting)){{ old('logout_url',$setting->logout_url)}}@endif"
                                                                       class="form-control">

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mt-10">
                                        <div class="row">
                                            <div class="col-lg-12 d-flex">
                                                <p class="text-uppercase fw-500 mb-10">{{__('Record')}} </p>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="radio-btn-flex ml-20">
                                                    <div class="row">
                                                        <div class="radio-btn-flex ml-20">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="">
                                                                        <input type="radio"
                                                                               name="record"
                                                                               id="record_on" value="1"
                                                                               class="common-radio relationButton" @if(!empty($setting)) {{ old('record',$setting->record) == 1? 'checked': ''}}@endif>
                                                                        <label
                                                                            for="record_on">{{__('bbb.Enable')}}</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="">
                                                                        <input type="radio"
                                                                               name="record"
                                                                               id="record" value="0"
                                                                               class="common-radio relationButton"@if(!empty($setting)) {{ old('record',$setting->record) == 0? 'checked': ''}} @endif>
                                                                        <label
                                                                            for="record">{{__('bbb.Disable')}}</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mt-10">
                                        <div class="row">
                                            <div class="col-lg-12 d-flex">
                                                <p class="text-uppercase fw-500 mb-10">{{__('Duration')}} </p>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="radio-btn-flex ml-20">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="">
                                                                <input type="number" name="duration"
                                                                       min="0"
                                                                       value="@if(!empty($setting)){{ old('duration',$setting->duration)}}@endif"
                                                                       class="form-control">

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mt-10">
                                        <div class="row">
                                            <div class="col-lg-12 d-flex">
                                                <p class="text-uppercase fw-500 mb-10">{{__('Is Breakout')}} </p>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="radio-btn-flex ml-20">
                                                    <div class="row">
                                                        <div class="radio-btn-flex ml-20">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="">
                                                                        <input type="radio"
                                                                               name="is_breakout"
                                                                               id="is_breakout_on"
                                                                               value="1"
                                                                               class="common-radio relationButton" @if(!empty($setting)) {{ old('is_breakout',$setting->is_breakout) == 1? 'checked': ''}}@endif>
                                                                        <label
                                                                            for="is_breakout_on">{{__('bbb.Enable')}}</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="">
                                                                        <input type="radio"
                                                                               name="is_breakout"
                                                                               id="is_breakout"
                                                                               value="0"
                                                                               class="common-radio relationButton"@if(!empty($setting)) {{ old('is_breakout',$setting->is_breakout) == 0? 'checked': ''}} @endif>
                                                                        <label
                                                                            for="is_breakout">{{__('bbb.Disable')}}</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mt-10">
                                        <div class="row">
                                            <div class="col-lg-12 d-flex">
                                                <p class="text-uppercase fw-500 mb-10">{{__('Moderator Only Message')}} </p>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="radio-btn-flex ml-20">
                                                    <div class="row">
                                                        <div class="radio-btn-flex ml-20">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="">
                                                                        <input type="text"
                                                                               name="moderator_only_message"
                                                                               value="@if(!empty($setting)) {{ old('moderator_only_message',$setting->moderator_only_message)}}@endif"
                                                                               class="form-control">

                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mt-10">
                                        <div class="row">
                                            <div class="col-lg-12 d-flex">
                                                <p class="text-uppercase fw-500 mb-10">{{__('Auto Start Recording')}} </p>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="radio-btn-flex ml-20">
                                                    <div class="row">
                                                        <div class="radio-btn-flex ml-20">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="">
                                                                        <input type="radio"
                                                                               name="auto_start_recording"
                                                                               id="auto_start_recording_on"
                                                                               value="1"
                                                                               class="common-radio relationButton" @if(!empty($setting)) {{ old('auto_start_recording',$setting->auto_start_recording) == 1? 'checked': ''}}@endif>
                                                                        <label
                                                                            for="auto_start_recording_on">{{__('bbb.Enable')}}</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="">
                                                                        <input type="radio"
                                                                               name="auto_start_recording"
                                                                               id="auto_start_recording"
                                                                               value="0"
                                                                               class="common-radio relationButton"@if(!empty($setting)) {{ old('auto_start_recording',$setting->auto_start_recording) == 0? 'checked': ''}} @endif>
                                                                        <label
                                                                            for="auto_start_recording">{{__('bbb.Disable')}}</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mt-10">
                                        <div class="row">
                                            <div class="col-lg-12 d-flex">
                                                <p class="text-uppercase fw-500 mb-10">{{__('Allow Start Stop Recording')}} </p>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="radio-btn-flex ml-20">
                                                    <div class="row">
                                                        <div class="radio-btn-flex ml-20">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="">
                                                                        <input type="radio"
                                                                               name="allow_start_stop_recording"
                                                                               id="allow_start_stop_recording_on"
                                                                               value="1"
                                                                               class="common-radio relationButton" @if(!empty($setting)) {{ old('allow_start_stop_recording',$setting->allow_start_stop_recording) == 1? 'checked': ''}}@endif>
                                                                        <label
                                                                            for="allow_start_stop_recording_on">{{__('bbb.Enable')}}</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="">
                                                                        <input type="radio"
                                                                               name="allow_start_stop_recording"
                                                                               id="allow_start_stop_recording"
                                                                               value="0"
                                                                               class="common-radio relationButton"@if(!empty($setting)) {{ old('allow_start_stop_recording',$setting->allow_start_stop_recording) == 0? 'checked': ''}} @endif>
                                                                        <label
                                                                            for="allow_start_stop_recording">{{__('bbb.Disable')}}</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-lg-12 mt-10">
                                        <div class="row">
                                            <div class="col-lg-12 d-flex">
                                                <p class="text-uppercase fw-500 mb-10">{{__('Webcams Only For Moderator')}} </p>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="radio-btn-flex ml-20">
                                                    <div class="row">
                                                        <div class="radio-btn-flex ml-20">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="">
                                                                        <input type="radio"
                                                                               name="webcams_only_for_moderator"
                                                                               id="webcams_only_for_moderator_on"
                                                                               value="1"
                                                                               class="common-radio relationButton" @if(!empty($setting)) {{ old('webcams_only_for_moderator',$setting->webcams_only_for_moderator) == 1? 'checked': ''}}@endif>
                                                                        <label
                                                                            for="webcams_only_for_moderator_on">{{__('bbb.Enable')}}</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="">
                                                                        <input type="radio"
                                                                               name="webcams_only_for_moderator"
                                                                               id="webcams_only_for_moderator"
                                                                               value="0"
                                                                               class="common-radio relationButton"@if(!empty($setting)) {{ old('webcams_only_for_moderator',$setting->webcams_only_for_moderator) == 0? 'checked': ''}} @endif>
                                                                        <label
                                                                            for="webcams_only_for_moderator">{{__('bbb.Disable')}}</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mt-10">
                                        <div class="row">
                                            {{--   <div class="col-lg-12 d-flex">
                                                   <p class="text-uppercase fw-500 mb-10">{{__('Logo')}} </p>
                                               </div>--}}
                                            <div class="col-lg-12">
                                                <div class="radio-btn-flex ml-20">
                                                    <div class="row">
                                                        <div class="radio-btn-flex ml-20">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    {{--<button class="primary-btn-small-input"
                                                                            type="button">

                                                                    </button>--}}
                                                                    <label
                                                                        class="primary-btn small fix-gr-bg"
                                                                        for="upload_content_file">{{__('bbb.Browse')}}</label>
                                                                    <input type="file"
                                                                           class="d-none form-control"
                                                                           name="logo"
                                                                           id="upload_content_file">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mt-10">
                                        <div class="row">
                                            <div class="col-lg-12 d-flex">
                                                <p class="text-uppercase fw-500 mb-10">{{__('Copyright')}} </p>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="radio-btn-flex ml-20">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <input type="text"
                                                                   name="copyright"
                                                                   value="@if(!empty($setting)){{ old('copyright',$setting->copyright)}}@endif"
                                                                   class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mt-10">
                                        <div class="row">
                                            <div class="col-lg-12 d-flex">
                                                <p class="text-uppercase fw-500 mb-10">{{__('Mute On Start')}} </p>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="radio-btn-flex ml-20">
                                                    <div class="row">
                                                        <div class="radio-btn-flex ml-20">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="">
                                                                        <input type="radio"
                                                                               name="mute_on_start"
                                                                               id="mute_on_start_on"
                                                                               value="1"
                                                                               class="common-radio relationButton" @if(!empty($setting)) {{ old('mute_on_start',$setting->mute_on_start) == 1? 'checked': ''}}@endif>
                                                                        <label
                                                                            for="mute_on_start_on">{{__('bbb.Enable')}}</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="">
                                                                        <input type="radio"
                                                                               name="mute_on_start"
                                                                               id="mute_on_start"
                                                                               value="0"
                                                                               class="common-radio relationButton"@if(!empty($setting)) {{ old('mute_on_start',$setting->mute_on_start) == 0? 'checked': ''}} @endif>
                                                                        <label
                                                                            for="mute_on_start">{{__('bbb.Disable')}}</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mt-10">
                                        <div class="row">
                                            <div class="col-lg-12 d-flex">
                                                <p class="text-uppercase fw-500 mb-10">{{__('Lock Settings Disable Mic')}} </p>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="radio-btn-flex ml-20">
                                                    <div class="row">
                                                        <div class="radio-btn-flex ml-20">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="">
                                                                        <input type="radio"
                                                                               name="lock_settings_disable_mic"
                                                                               id="lock_settings_disable_mic_on"
                                                                               value="1"
                                                                               class="common-radio relationButton" @if(!empty($setting)) {{ old('lock_settings_disable_mic',$setting->lock_settings_disable_mic) == 1? 'checked': ''}}@endif>
                                                                        <label
                                                                            for="lock_settings_disable_mic_on">{{__('bbb.Enable')}}</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="">
                                                                        <input type="radio"
                                                                               name="lock_settings_disable_mic"
                                                                               id="lock_settings_disable_mic"
                                                                               value="0"
                                                                               class="common-radio relationButton"@if(!empty($setting)) {{ old('lock_settings_disable_mic',$setting->lock_settings_disable_mic) == 0? 'checked': ''}} @endif>
                                                                        <label
                                                                            for="lock_settings_disable_mic">{{__('bbb.Disable')}}</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mt-10">
                                        <div class="row">
                                            <div class="col-lg-12 d-flex">
                                                <p class="text-uppercase fw-500 mb-10">{{__('Lock Settings Disable Private Chat')}} </p>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="radio-btn-flex ml-20">
                                                    <div class="row">
                                                        <div class="radio-btn-flex ml-20">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="">
                                                                        <input type="radio"
                                                                               name="lock_settings_disable_private_chat"
                                                                               id="lock_settings_disable_private_chat_on"
                                                                               value="1"
                                                                               class="common-radio relationButton" @if(!empty($setting)) {{ old('lock_settings_disable_private_chat',$setting->lock_settings_disable_private_chat) == 1? 'checked': ''}}@endif>
                                                                        <label
                                                                            for="lock_settings_disable_private_chat_on">{{__('bbb.Enable')}}</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="">
                                                                        <input type="radio"
                                                                               name="lock_settings_disable_private_chat"
                                                                               id="lock_settings_disable_private_chat"
                                                                               value="0"
                                                                               class="common-radio relationButton"@if(!empty($setting)) {{ old('lock_settings_disable_private_chat',$setting->lock_settings_disable_private_chat) == 0? 'checked': ''}} @endif>
                                                                        <label
                                                                            for="lock_settings_disable_private_chat">{{__('bbb.Disable')}}</label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mt-10">
                                        <div class="row">
                                            <div class="col-lg-12 d-flex">
                                                <p class="text-uppercase fw-500 mb-10">{{__('Lock Settings Disable Public Chat')}} </p>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="radio-btn-flex ml-20">
                                                    <div class="row">
                                                        <div class="radio-btn-flex ml-20">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="">
                                                                        <input type="radio"
                                                                               name="lock_settings_disable_public_chat"
                                                                               id="lock_settings_disable_public_chat_on"
                                                                               value="1"
                                                                               class="common-radio relationButton" @if(!empty($setting)) {{ old('lock_settings_disable_public_chat',$setting->lock_settings_disable_public_chat) == 1? 'checked': ''}}@endif>
                                                                        <label
                                                                            for="lock_settings_disable_public_chat_on">{{__('bbb.Enable')}}</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="">
                                                                        <input type="radio"
                                                                               name="lock_settings_disable_public_chat"
                                                                               id="lock_settings_disable_public_chat"
                                                                               value="0"
                                                                               class="common-radio relationButton"@if(!empty($setting)) {{ old('lock_settings_disable_public_chat',$setting->lock_settings_disable_public_chat) == 0? 'checked': ''}} @endif>
                                                                        <label
                                                                            for="lock_settings_disable_public_chat">{{__('bbb.Disable')}}</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mt-10">
                                        <div class="row">
                                            <div class="col-lg-12 d-flex">
                                                <p class="text-uppercase fw-500 mb-10">{{__('Lock Settings Disable Note')}} </p>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="radio-btn-flex ml-20">
                                                    <div class="row">
                                                        <div class="radio-btn-flex ml-20">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="">
                                                                        <input type="radio"
                                                                               name="lock_settings_disable_note"
                                                                               id="lock_settings_disable_note_on"
                                                                               value="1"
                                                                               class="common-radio relationButton" @if(!empty($setting)) {{ old('lock_settings_disable_note',$setting->lock_settings_disable_note) == 1? 'checked': ''}}@endif>
                                                                        <label
                                                                            for="lock_settings_disable_note_on">{{__('bbb.Enable')}}</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="">
                                                                        <input type="radio"
                                                                               name="lock_settings_disable_note"
                                                                               id="lock_settings_disable_note"
                                                                               value="0"
                                                                               class="common-radio relationButton"@if(!empty($setting)) {{ old('lock_settings_disable_note',$setting->lock_settings_disable_note) == 0? 'checked': ''}} @endif>
                                                                        <label
                                                                            for="lock_settings_disable_note">{{__('bbb.Disable')}}</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mt-10">
                                        <div class="row">
                                            <div class="col-lg-12 d-flex">
                                                <p class="text-uppercase fw-500 mb-10">{{__('Lock Settings Locked Layout')}} </p>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="radio-btn-flex ml-20">
                                                    <div class="row">
                                                        <div class="radio-btn-flex ml-20">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="">
                                                                        <input type="radio"
                                                                               name="lock_settings_locked_layout"
                                                                               id="lock_settings_locked_layout_on"
                                                                               value="1"
                                                                               class="common-radio relationButton" @if(!empty($setting)) {{ old('lock_settings_locked_layout',$setting->lock_settings_locked_layout) == 1? 'checked': ''}}@endif>
                                                                        <label
                                                                            for="lock_settings_locked_layout_on">{{__('bbb.Enable')}}</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="">
                                                                        <input type="radio"
                                                                               name="lock_settings_locked_layout"
                                                                               id="lock_settings_locked_layout"
                                                                               value="0"
                                                                               class="common-radio relationButton"@if(!empty($setting)) {{ old('lock_settings_locked_layout',$setting->lock_settings_locked_layout) == 0? 'checked': ''}} @endif>
                                                                        <label
                                                                            for="lock_settings_locked_layout">{{__('bbb.Disable')}}</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mt-10">
                                        <div class="row">
                                            <div class="col-lg-12 d-flex">
                                                <p class="text-uppercase fw-500 mb-10">{{__('Lock Settings Lock On Join')}} </p>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="radio-btn-flex ml-20">
                                                    <div class="row">
                                                        <div class="radio-btn-flex ml-20">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="">
                                                                        <input type="radio"
                                                                               name="lock_settings_lock_on_join"
                                                                               id="lock_settings_lock_on_join_on"
                                                                               value="1"
                                                                               class="common-radio relationButton" @if(!empty($setting)) {{ old('lock_settings_lock_on_join',$setting->lock_settings_lock_on_join) == 1? 'checked': ''}}@endif>
                                                                        <label
                                                                            for="lock_settings_lock_on_join_on">{{__('bbb.Enable')}}</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="">
                                                                        <input type="radio"
                                                                               name="lock_settings_lock_on_join"
                                                                               id="lock_settings_lock_on_join"
                                                                               value="0"
                                                                               class="common-radio relationButton"@if(!empty($setting)) {{ old('lock_settings_lock_on_join',$setting->lock_settings_lock_on_join) == 0? 'checked': ''}} @endif>
                                                                        <label
                                                                            for="lock_settings_lock_on_join">{{__('bbb.Disable')}}</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mt-10">
                                        <div class="row">
                                            <div class="col-lg-12 d-flex">
                                                <p class="text-uppercase fw-500 mb-10">{{__('Lock Settings Lock On Join Configurable')}} </p>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="radio-btn-flex ml-20">
                                                    <div class="row">
                                                        <div class="radio-btn-flex ml-20">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="">
                                                                        <input type="radio"
                                                                               name="lock_settings_lock_on_join_configurable"
                                                                               id="lock_settings_lock_on_join_configurable_on"
                                                                               value="1"
                                                                               class="common-radio relationButton" @if(!empty($setting)) {{ old('lock_settings_lock_on_join_configurable',$setting->lock_settings_lock_on_join_configurable) == 1? 'checked': ''}}@endif>
                                                                        <label
                                                                            for="lock_settings_lock_on_join_configurable_on">{{__('bbb.Enable')}}</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="">
                                                                        <input type="radio"
                                                                               name="lock_settings_lock_on_join_configurable"
                                                                               id="lock_settings_lock_on_join_configurable"
                                                                               value="0"
                                                                               class="common-radio relationButton"@if(!empty($setting)) {{ old('lock_settings_lock_on_join_configurable',$setting->lock_settings_lock_on_join_configurable) == 0? 'checked': ''}} @endif>
                                                                        <label
                                                                            for="lock_settings_lock_on_join_configurable">{{__('bbb.Disable')}}</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mt-10">
                                        <div class="row">
                                            <div class="col-lg-12 d-flex">
                                                <p class="text-uppercase fw-500 mb-10">{{__('Guest Policy')}} </p>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="radio-btn-flex ml-20">
                                                    <div class="row">
                                                        <div class="radio-btn-flex ml-20">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="">
                                                                        <select name="guest_policy"
                                                                                id="guest_policy"
                                                                                class="form-control">
                                                                            <option
                                                                                value="ALWAYS_ACCEPT"
                                                                                @if(!empty($setting)) @if($setting->guest_policy=="ALWAYS_ACCEPT") selected @endif @endif>
                                                                                Always Accept
                                                                            </option>
                                                                            <option value="ALWAYS_DENY"
                                                                                    @if(!empty($setting)) @if($setting->guest_policy=="ALWAYS_DENY") selected @endif @endif>
                                                                                Always Deny
                                                                            </option>
                                                                            <option
                                                                                value="ASK_MODERATOR"
                                                                                @if(!empty($setting)) @if($setting->guest_policy=="ASK_MODERATOR") selected @endif @endif>
                                                                                Ask Moderator
                                                                            </option>

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mt-10">
                                        <div class="row">
                                            <div class="col-lg-12 d-flex">
                                                <p class="text-uppercase fw-500 mb-10">{{__('Redirect')}} </p>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="radio-btn-flex ml-20">
                                                    <div class="row">
                                                        <div class="radio-btn-flex ml-20">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="">
                                                                        <input type="radio"
                                                                               name="redirect"
                                                                               id="redirect_on"
                                                                               value="1"
                                                                               class="common-radio relationButton" @if(!empty($setting)) {{ old('redirect',$setting->redirect) == 1? 'checked': ''}}@endif>
                                                                        <label
                                                                            for="redirect_on">{{__('bbb.Enable')}}</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="">
                                                                        <input type="radio"
                                                                               name="redirect"
                                                                               id="redirect" value="0"
                                                                               class="common-radio relationButton"@if(!empty($setting)) {{ old('redirect',$setting->redirect) == 0? 'checked': ''}} @endif>
                                                                        <label
                                                                            for="redirect">{{__('bbb.Disable')}}</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mt-10">
                                        <div class="row">
                                            <div class="col-lg-12 d-flex">
                                                <p class="text-uppercase fw-500 mb-10">{{__('Join Via Html 5')}} </p>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="radio-btn-flex ml-20">
                                                    <div class="row">
                                                        <div class="radio-btn-flex ml-20">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="">
                                                                        <input type="radio"
                                                                               name="join_via_html5"
                                                                               id="join_via_html5_on"
                                                                               value="1"
                                                                               class="common-radio relationButton" @if(!empty($setting)) {{ old('join_via_html5',$setting->join_via_html5) == 1? 'checked': ''}}@endif>
                                                                        <label
                                                                            for="join_via_html5_on">{{__('bbb.Enable')}}</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="">
                                                                        <input type="radio"
                                                                               name="join_via_html5"
                                                                               id="join_via_html5"
                                                                               value="0"
                                                                               class="common-radio relationButton"@if(!empty($setting)) {{ old('join_via_html5',$setting->join_via_html5) == 0? 'checked': ''}} @endif>
                                                                        <label
                                                                            for="join_via_html5">{{__('bbb.Disable')}}</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mt-10">
                                        <div class="row">
                                            <div class="col-lg-12 d-flex">
                                                <p class="text-uppercase fw-500 mb-10">{{__('State')}} </p>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="radio-btn-flex ml-20">
                                                    <div class="row">
                                                        <div class="radio-btn-flex ml-20">
                                                            <div class="row">
                                                                <div class="col-lg-12">

                                                                    <select name="state" id="state"
                                                                            class="form-control">
                                                                        <option value="any"
                                                                                @if(!empty($setting)) @if($setting->state=="any") selected @endif @endif>
                                                                            Any
                                                                        </option>
                                                                        <option value="published"
                                                                                @if(!empty($setting)) @if($setting->state=="published") selected @endif @endif>
                                                                            Published
                                                                        </option>
                                                                        <option value="unpublished"
                                                                                @if(!empty($setting)) @if($setting->state=="unpublished") selected @endif @endif>
                                                                            Unpublished
                                                                        </option>
                                                                    </select>


                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Start setting  --}}


                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                        @if(empty($env['security_salt']) ||empty($env['server_base_url']))
                                            <small class="text-danger">* Please make sure BBB api key
                                                setup
                                                successfully. Without BBB api setup, you can't create
                                                class</small>
                                        @else
                                            <button class="primary-btn fix-gr-bg">
                                                <span class="ti-check"></span>
                                                @if(isset($editdata))
                                                    {{__('bbb.Update')}}
                                                @else
                                                    {{__('bbb.Save')}}
                                                @endif
                                                {{__('bbb.Class')}}

                                            </button>
                                        @endif
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
<input type="hidden" name="get_user" class="get_user" value="{{ url('get-user-by-role') }}">
@if(isset($editdata))
    <input type="hidden" name="is_default_settings" class="is_default_settings" value="1">
@endif
@if(isset($editdata))
    <input type="hidden" name="recurrence_section" class="recurrence_section"
           value="{{old('is_recurring',$editdata->is_recurring)}}">
@else
    <input type="hidden" name="recurrence_section" class="recurrence_section" value="{{old('is_recurring')}}">
@endif

@endsection

@push('scripts')
    <script src="{{asset('public/backend/js/zoom.js')}}"></script>
@endpush
