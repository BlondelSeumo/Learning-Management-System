@extends('backend.master')
@section('mainContent')
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>{{__('zoom.Classes')}} {{__('zoom.List')}}</h1>
                <div class="bc-pages">
                    <a href="{{route('dashboard')}}">{{__('dashboard.Dashboard')}}</a>
                    <a href="#">{{__('zoom.Classes')}}</a>
                    <a href="#">{{__('zoom.List')}}</a>
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
                                {{__('zoom.Edit')}}
                            @else
                                {{__('zoom.Add')}}
                            @endif
                            {{__('zoom.Classes')}}
                        </h3>
                    </div>


                    <form class="form-horizontal"
                          action="@if(isset($editdata)){{ route('zoom.meetings.update',$editdata->id) }}@else {{ route('virtual-class.createMeetingStore',$class->id) }} @endif"
                          method="POST"
                          enctype="multipart/form-data">
                        @csrf


                        <div class="row">
                            <div class="col-lg-12">
                                <div class="white-box">


                                    <div class="row mt-40">
                                        <div class="col-lg-12">
                                            <div class="input-effect">
                                                <input
                                                    class="primary-input form-control{{ $errors->has('topic') ? ' is-invalid' : '' }}"
                                                    type="text" name="topic" autocomplete="off"
                                                    value="{{ isset($class) ?  old('topic',$class->title) : old('topic') }}">
                                                <label>{{__('zoom.Topic')}} <span>*</span></label>
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
                                            <textarea class="primary-input form-control" cols="0" rows="4"
                                                      name="description"
                                                      id="description">{{isset($editdata) ? old('description',$editdata->description) : old('description')}}</textarea>
                                                <label>{{__('zoom.Description')}}</label>
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
                                        <div class="col-lg-6">
                                            <label>{{__('zoom.Date Of Class')}} <span>*</span></label>
                                            <input class="primary-input date form-control" id="startDate"
                                                   type="text"
                                                   name="date" readonly="true"
                                                   value="{{ isset($class) ? old('date',Carbon\Carbon::parse($class->start_date)->format('m/d/Y')): old('date',Carbon\Carbon::now()->format('m/d/Y'))}}"
                                                   required>
                                            @if ($errors->has('date'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('date') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                        <div class="col-lg-6">
                                            <label>{{__('zoom.Time Of Class')}} <span>*</span></label>
                                            <input
                                                class="primary-input time form-control{{ @$errors->has('time') ? ' is-invalid' : '' }}"
                                                type="text" name="time"
                                                value="{{ isset($class) ? old('time',$class->time): old('time')}}">
                                            <span class="focus-border"></span>
                                            @if ($errors->has('time'))
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ @$errors->first('time') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mt-40">
                                        <div class="col-lg-12">
                                            <div class="input-effect">
                                                <input
                                                    class="primary-input form-control{{ $errors->has('durration') ? ' is-invalid' : '' }}"
                                                    type="number" name="durration" autocomplete="off"
                                                    value="{{isset($class)? old('durration',$class->duration) : old('durration')}}">
                                                <label>{{__('zoom.Class Duration')}}<span>*</span></label>
                                                <span class="focus-border"></span>
                                                @if ($errors->has('durration'))
                                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('durration') }}</strong>
                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-40">
                                        <div class="col-lg-12">
                                            <div class="input-effect">
                                                <input
                                                    class="primary-input form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                    type="text" name="password" autocomplete="off"
                                                    value="123456">
                                                <label>{{__('zoom.Password')}}<span>*</span></label>
                                                <span class="focus-border"></span>
                                                @if ($errors->has('password'))
                                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-30">
                                        <div class="col-lg-12 d-flex">
                                            <p class="text-uppercase fw-500 mb-10"
                                               style="width: 130px;">{{__('zoom.Recurring')}} </p>
                                            <div class="d-flex radio-btn-flex ml-40">
                                                @if (isset($editdata))
                                                    <div class="mr-30">
                                                        <input type="radio" name="is_recurring"
                                                               id="recurring_options1"
                                                               value="1"
                                                               class="common-radio recurring-type" {{old('is_recurring',$editdata->is_recurring) == 1? 'checked': ''}}>
                                                        <label
                                                            for="recurring_options1">{{__('zoom.Yes')}}</label>
                                                    </div>
                                                    <div class="mr-30">
                                                        <input type="radio" name="is_recurring"
                                                               id="recurring_options2"
                                                               value="0"
                                                               class="common-radio recurring-type" {{old('is_recurring',$editdata->is_recurring) == 0? 'checked': ''}}>
                                                        <label
                                                            for="recurring_options2">{{__('zoom.No')}}</label>
                                                    </div>
                                                @else
                                                    <div class="mr-30">
                                                        <input type="radio" name="is_recurring"
                                                               id="recurring_options1"
                                                               value="1"
                                                               class="common-radio recurring-type" {{old('is_recurring') == 1? 'checked': ''}}>
                                                        <label
                                                            for="recurring_options1">{{__('zoom.Yes')}}</label>
                                                    </div>
                                                    <div class="mr-30">
                                                        <input type="radio" name="is_recurring"
                                                               id="recurring_options2"
                                                               value="0"
                                                               class="common-radio recurring-type" {{old('is_recurring') == 0? 'checked': ''}}>
                                                        <label
                                                            for="recurring_options2">{{__('zoom.No')}}</label>
                                                    </div>
                                                @endif

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-20 recurrence-section-hide">
                                        <div class="col-lg-6">
                                            {{-- <label>Recurrence Type *</label> --}}
                                            <select
                                                class="w-100 bb niceSelect form-control {{ @$errors->has('recurring_type') ? ' is-invalid' : '' }}"
                                                id="recurring_type" name="recurring_type">
                                                <option data-display="Recurrence type *"
                                                        value="">{{__('zoom.Student')}}
                                                    zoom_recurring_type') *
                                                </option>
                                                @if (isset($editdata))
                                                    <option
                                                        value="1" {{ old('recurring_type',$editdata->recurring_type) == 1  ? 'selected':''}} >
                                                        Daily
                                                    </option>
                                                    <option
                                                        value="2" {{ old('recurring_type',$editdata->recurring_type) == 2  ? 'selected':''}} >
                                                        Weekly
                                                    </option>
                                                    <option
                                                        value="3" {{ old('recurring_type',$editdata->recurring_type) == 3  ? 'selected':''}}>
                                                        Monthly
                                                    </option>
                                                @else
                                                    <option
                                                        value="1" {{ old('recurring_type') == 1  ? 'selected':''}} > {{__('zoom.Student')}}
                                                        zoom_recurring_daily')
                                                    </option>
                                                    <option
                                                        value="2" {{ old('recurring_type') == 2  ? 'selected':''}} > {{__('zoom.Student')}}
                                                        zoom_recurring_weekly')
                                                    </option>
                                                    <option
                                                        value="3" {{ old('recurring_type') == 3  ? 'selected':''}}>  {{__('zoom.Student')}}
                                                        zoom_recurring_monthly')
                                                    </option>
                                                @endif
                                            </select>
                                            @if ($errors->has('recurring_type'))
                                                <span class="invalid-feedback invalid-select" role="alert">
                                <strong>{{ @$errors->first('recurring_type') }}</strong>
                            </span>
                                            @endif
                                        </div>
                                        <div class="col-lg-6">
                                            {{-- <label>Repeat every *</label> --}}
                                            <select
                                                class="w-100 bb niceSelect form-control {{ @$errors->has('recurring_repect_day') ? ' is-invalid' : '' }}"
                                                id="recurring_repect_day" name="recurring_repect_day">
                                                <option data-display=" Select *"
                                                        value="">{{__('zoom.zoom_recurring_repect')}}*
                                                </option>
                                                @for ($i = 1; $i <= 15; $i++)
                                                    @if (isset($editdata))
                                                        <option
                                                            value="{{ $i }}" {{ old('recurring_repect_day',$editdata->recurring_repect_day) == $i ? 'selected':''}} >{{ $i }}</option>
                                                    @else
                                                        <option
                                                            value="{{ $i }}" {{ old('recurring_repect_day') == $i ? 'selected':''}} >{{ $i }}</option>
                                                    @endif
                                                @endfor
                                            </select>
                                            @if ($errors->has('recurring_repect_day'))
                                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong>{{ @$errors->first('recurring_repect_day') }}</strong>
                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row mt-30 recurrence-section-hide">
                                        <div class="col-lg-6">
                                            <label>{{__('zoom.Recurring End')}} *</label>
                                            <input class="primary-input date form-control"
                                                   id="recurring_end_date"
                                                   type="text" name="recurring_end_date" readonly="true"
                                                   value="{{ isset($editdata) ? old('recurring_end_date',Carbon\Carbon::parse($editdata->recurring_end_date)->format('m/d/Y')): old('recurring_end_date')}}"
                                                   required>
                                            @if ($errors->has('recurring_end_date'))
                                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('recurring_end_date') }}</strong>
                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row no-gutters input-right-icon mt-30">
                                        <div class="col">
                                            <div class="input-effect">
                                                <input
                                                    class="primary-input form-control {{ $errors->has('attached_file') ? ' is-invalid' : '' }}"
                                                    readonly="true" type="text"
                                                    placeholder="{{isset($editdata->attached_file) && @$editdata->attached_file != ""? getFilePath3(@$editdata->attached_file) : trans('zoom.Attached File')}}"
                                                    id="placeholderUploadContent">
                                                <span class="focus-border"></span>
                                                @if ($errors->has('attached_file'))
                                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('attached_file') }}</strong>
                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button class="primary-btn-small-input" type="button">
                                                <label class="primary-btn small fix-gr-bg"
                                                       for="upload_content_file">{{__('zoom.Browse')}}</label>
                                                <input type="file" class="d-none form-control"
                                                       name="attached_file"
                                                       id="upload_content_file">
                                            </button>
                                        </div>
                                    </div>

                                    {{-- Start setting  --}}
                                    <div class="row mt-40">
                                        <div class="col-lg-12 d-flex">
                                            <p class="text-uppercase fw-500 mb-10"
                                               style="width: 130px;">{{__('zoom.Change Default Settings')}}</p>
                                            <div class="d-flex radio-btn-flex ml-40">
                                                <div class="mr-30 row">
                                                    <input type="radio" name="chnage-default-settings"
                                                           id="change_default_settings" value="1"
                                                           @if (isset($editdata)) checked
                                                           @endif class="common-radio chnage-default-settings relationButton">
                                                    <label
                                                        for="change_default_settings">{{__('zoom.Yes')}}</label>
                                                </div>
                                                <div class="mr-30 row">
                                                    <input type="radio" name="chnage-default-settings"
                                                           id="change_default_settings2" value="0"
                                                           @if (!isset($editdata)) checked
                                                           @endif  class="common-radio chnage-default-settings relationButton">
                                                    <label
                                                        for="change_default_settings2">{{__('zoom.No')}}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-40 default-settings">
                                        <div class="col-lg-12 d-flex">
                                            <p class="text-uppercase fw-500 mb-10"
                                               style="width: 130px;">{{__('zoom.Join Before Host')}}</p>
                                            <div class="d-flex radio-btn-flex ml-40">
                                                @if (isset($editdata))
                                                    <div class="mr-30 row">
                                                        <input type="radio" name="join_before_host"
                                                               id="metting_options1"
                                                               value="1"
                                                               class="common-radio relationButton" {{ old('join_before_host',$editdata->join_before_host) == 1 ? 'checked': ''}}>
                                                        <label
                                                            for="metting_options1">{{__('zoom.Yes')}}</label>
                                                    </div>
                                                    <div class="mr-30 row">
                                                        <input type="radio" name="join_before_host"
                                                               id="metting_options2"
                                                               value="0"
                                                               class="common-radio relationButton" {{ old('join_before_host',$editdata->join_before_host) == 0 ? 'checked': ''}}>
                                                        <label
                                                            for="metting_options2">{{__('zoom.No')}}</label>
                                                    </div>
                                                @else
                                                    <div class="mr-30 row">
                                                        <input type="radio" name="join_before_host"
                                                               id="metting_options1"
                                                               value="1"
                                                               class="common-radio relationButton" {{ old('join_before_host', $default_settings->join_before_host) == 1? 'checked': ''}}>
                                                        <label
                                                            for="metting_options1">{{__('zoom.Yes')}}</label>
                                                    </div>
                                                    <div class="mr-30 row">
                                                        <input type="radio" name="join_before_host"
                                                               id="metting_options2"
                                                               value="0"
                                                               class="common-radio relationButton" {{ old('join_before_host', $default_settings->join_before_host) == 0? 'checked': ''}}>
                                                        <label
                                                            for="metting_options2">{{__('zoom.No')}}</label>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-30 default-settings">
                                        <div class="col-lg-12 d-flex">
                                            <p class="text-uppercase fw-500 mb-10"
                                               style="width: 130px;">{{__('zoom.Host Video')}}</p>
                                            <div class="d-flex radio-btn-flex ml-40">
                                                @if (isset($editdata))
                                                    <div class="mr-30 row">
                                                        <input type="radio" name="host_video"
                                                               id="host_video1" value="1"
                                                               class="common-radio relationButton" {{old('host_video',$editdata->host_video) == 1? 'checked': ''}}>
                                                        <label for="host_video1">{{__('zoom.Yes')}}</label>
                                                    </div>
                                                    <div class="mr-30 row">
                                                        <input type="radio" name="host_video"
                                                               id="host_video2" value="0"
                                                               class="common-radio relationButton" {{old('host_video',$editdata->host_video) == 0? 'checked': ''}}>
                                                        <label for="host_video2">{{__('zoom.No')}}</label>
                                                    </div>
                                                @else
                                                    <div class="mr-30 row">
                                                        <input type="radio" name="host_video"
                                                               id="host_video1" value="1"
                                                               class="common-radio relationButton" {{old('host_video',$default_settings->host_video) == 1? 'checked': ''}}>
                                                        <label for="host_video1">{{__('zoom.Yes')}}</label>
                                                    </div>
                                                    <div class="mr-30 row">
                                                        <input type="radio" name="host_video"
                                                               id="host_video2" value="0"
                                                               class="common-radio relationButton" {{old('host_video',$default_settings->host_video) == 0? 'checked': ''}}>
                                                        <label for="host_video2">{{__('zoom.No')}} </label>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-30 default-settings">
                                        <div class="col-lg-12 d-flex">
                                            <p class="text-uppercase fw-500 mb-10"
                                               style="width: 130px;">{{__('zoom.Participant Video')}}</p>
                                            <div class="d-flex radio-btn-flex ml-40">
                                                @if (isset($editdata))
                                                    <div class="mr-30 row">
                                                        <input type="radio" name="participant_video"
                                                               id="host_video3"
                                                               value="1"
                                                               class="common-radio" {{old('participant_video', $editdata->participant_video) == 1 ? 'checked': ''}}>
                                                        <label for="host_video3">{{__('zoom.Yes')}}</label>
                                                    </div>
                                                    <div class="mr-30 row">
                                                        <input type="radio" name="participant_video"
                                                               id="host_video4"
                                                               value="0"
                                                               class="common-radio" {{old('participant_video', $editdata->participant_video) == 0 ? 'checked': ''}}>
                                                        <label for="host_video4">{{__('zoom.No')}}</label>
                                                    </div>
                                                @else
                                                    <div class="mr-30 row">
                                                        <input type="radio" name="participant_video"
                                                               id="host_video3"
                                                               value="1"
                                                               class="common-radio" {{ old('participant_video', $default_settings->participant_video) == 1 ? 'checked': ''}}>
                                                        <label for="host_video3">{{__('zoom.Yes')}}</label>
                                                    </div>
                                                    <div class="mr-30 row">
                                                        <input type="radio" name="participant_video"
                                                               id="host_video4"
                                                               value="0"
                                                               class="common-radio" {{ old('participant_video', $default_settings->participant_video) == 0 ? 'checked': ''}}>
                                                        <label for="host_video4">{{__('zoom.No')}}</label>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-30 default-settings">
                                        <div class="col-lg-12 d-flex">
                                            <p class="text-uppercase fw-500 mb-10"
                                               style="width: 130px;">{{__('zoom.Mute Upon Entry')}}  </p>
                                            <div class="d-flex radio-btn-flex ml-40">
                                                @if (isset($editdata))
                                                    <div class="mr-30 row">
                                                        <input type="radio" name="mute_upon_entry"
                                                               id="mute_upon_entry_on"
                                                               value="1"
                                                               class="common-radio" {{old('mute_upon_entry', $editdata->mute_upon_entry) == 1 ? 'checked': ''}}>
                                                        <label
                                                            for="mute_upon_entry_on">{{__('zoom.Yes')}}</label>
                                                    </div>
                                                    <div class="mr-30 row">
                                                        <input type="radio" name="mute_upon_entry"
                                                               id="mute_upon_entry"
                                                               value="0"
                                                               class="common-radio" {{old('mute_upon_entry', $editdata->mute_upon_entry) == 0 ? 'checked': ''}}>
                                                        <label
                                                            for="mute_upon_entry">{{__('zoom.No')}}</label>
                                                    </div>
                                                @else
                                                    <div class="mr-30 row">
                                                        <input type="radio" name="mute_upon_entry"
                                                               id="mute_upon_entry_on"
                                                               value="1"
                                                               class="common-radio" {{ old('mute_upon_entry', $default_settings->mute_upon_entry) == 1 ? 'checked': ''}}>
                                                        <label
                                                            for="mute_upon_entry_on">{{__('zoom.Yes')}}</label>
                                                    </div>
                                                    <div class="mr-30 row">
                                                        <input type="radio" name="mute_upon_entry"
                                                               id="mute_upon_entry"
                                                               value="0"
                                                               class="common-radio" {{ old('mute_upon_entry', $default_settings->mute_upon_entry) == 0 ? 'checked': ''}}>
                                                        <label
                                                            for="mute_upon_entry">{{__('zoom.No')}}</label>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-30 default-settings">
                                        <div class="col-lg-12 d-flex">
                                            <p class="text-uppercase fw-500 mb-10"
                                               style="width: 130px;">{{__('zoom.Waiting Room')}}</p>
                                            <div class="d-flex radio-btn-flex ml-40">
                                                @if (isset($editdata))
                                                    <div class="mr-30 row">
                                                        <input type="radio" name="waiting_room"
                                                               id="waiting_room_on"
                                                               value="1"
                                                               class="common-radio" {{old('waiting_room', $editdata->waiting_room) == 1 ? 'checked': ''}}>
                                                        <label
                                                            for="waiting_room_on">{{__('zoom.Yes')}}</label>
                                                    </div>
                                                    <div class="mr-30 row">
                                                        <input type="radio" name="waiting_room"
                                                               id="waiting_room" value="0"
                                                               class="common-radio" {{old('waiting_room', $editdata->waiting_room) == 0 ? 'checked': ''}}>
                                                        <label for="waiting_room">{{__('zoom.No')}}</label>
                                                    </div>
                                                @else
                                                    <div class="mr-30 row">
                                                        <input type="radio" name="waiting_room"
                                                               id="waiting_room_on"
                                                               value="1"
                                                               class="common-radio" {{ old('waiting_room', $default_settings->waiting_room) == 1 ? 'checked': ''}}>
                                                        <label
                                                            for="waiting_room_on">{{__('zoom.Yes')}}</label>
                                                    </div>
                                                    <div class="mr-30 row">
                                                        <input type="radio" name="waiting_room"
                                                               id="waiting_room" value="0"
                                                               class="common-radio" {{ old('waiting_room', $default_settings->waiting_room) == 0 ? 'checked': ''}}>
                                                        <label for="waiting_room">{{__('zoom.No')}}</label>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @if ($default_settings->package_id != 1 )
                                        <div class="row mt-30">
                                            <div class="col-lg-12 row">
                                                <p class="text-uppercase fw-500 mb-10 col-lg-6"
                                                   style="width: 130px;">{{__('zoom.Auto Recording')}}</p>
                                                <div class="col-lg-6">
                                                    <select
                                                        class="w-100 bb niceSelect form-control {{ @$errors->has('auto_recording') ? ' is-invalid' : '' }}"
                                                        name="auto_recording">
                                                        @if (isset($editdata))
                                                            <option
                                                                value="none" {{ old('auto_recording',$editdata->auto_recording) == 'none'? 'selected' : ''}} >
                                                                None
                                                            </option>
                                                            <option
                                                                value="local" {{ old('auto_recording',$editdata->auto_recording) == 'local'? 'selected' : ''}} >
                                                                Local
                                                            </option>
                                                            <option
                                                                value="cloud" {{ old('auto_recording',$editdata->auto_recording) == 'cloud'? 'selected' : ''}} >
                                                                Cloud
                                                            </option>
                                                        @else
                                                            <option
                                                                value="none" {{ old('auto_recording',$default_settings->auto_recording) == 'none'? 'selected' : ''}} >
                                                                None
                                                            </option>
                                                            <option
                                                                value="local" {{ old('auto_recording',$default_settings->auto_recording) == 'local'? 'selected' : ''}} >
                                                                Local
                                                            </option>
                                                            <option
                                                                value="cloud" {{ old('auto_recording',$default_settings->auto_recording) == 'cloud'? 'selected' : ''}} >
                                                                Cloud
                                                            </option>
                                                        @endif
                                                    </select>
                                                    @if ($errors->has('auto_recording'))
                                                        <span class="invalid-feedback invalid-select"
                                                              role="alert">
                                        <strong>{{ @$errors->first('auto_recording') }}</strong>
                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="row mt-30 default-settings">
                                        <div class="col-lg-12 row">
                                            <p class="text-uppercase fw-500 mb-10 col-lg-6"
                                               style="width: 130px;">{{__('zoom.Audio Option')}}</p>
                                            <div class="col-lg-6">
                                                <select
                                                    class="w-100 bb niceSelect form-control {{ @$errors->has('audio') ? ' is-invalid' : '' }}"
                                                    name="audio">
                                                    <option
                                                        data-display="{{__('zoom.Student')}}select_section') *"
                                                        value="">Select Pakage *
                                                    </option>
                                                    @if (isset($editdata))
                                                        <option
                                                            value="both" {{ old('audio',$editdata->audio) == 'both' ? 'selected' : ''}} >
                                                            Both
                                                        </option>
                                                        <option
                                                            value="telephony" {{ old('audio',$editdata->audio) == 'telephony'? 'selected' : ''}}>
                                                            Telephony
                                                        </option>
                                                        <option
                                                            value="voip" {{ old('audio',$editdata->audio) == 'voip'? 'selected' : ''}} >
                                                            Voip
                                                        </option>
                                                    @else
                                                        <option
                                                            value="both" {{ old('audio',$default_settings->audio) == 'both' ? 'selected' : ''}} >
                                                            Both
                                                        </option>
                                                        <option
                                                            value="telephony" {{ old('audio',$default_settings->audio) == 'telephony'? 'selected' : ''}}>
                                                            Telephony
                                                        </option>
                                                        <option
                                                            value="voip" {{ old('audio',$default_settings->audio) == 'voip'? 'selected' : ''}} >
                                                            Voip
                                                        </option>
                                                    @endif

                                                </select>
                                                @if ($errors->has('audio'))
                                                    <span class="invalid-feedback invalid-select"
                                                          role="alert">
                                    <strong>{{ @$errors->first('audio') }}</strong>
                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-30 default-settings">
                                        <div class="col-lg-12 row">
                                            <p class="text-uppercase fw-500 mb-10 col-lg-6"
                                               style="width: 130px;">{{__('zoom.Class Approval')}} </p>
                                            <div class="col-lg-6">
                                                <select
                                                    class="w-100 bb niceSelect form-control {{ @$errors->has('approval_type') ? ' is-invalid' : '' }}"
                                                    name="approval_type">
                                                    @if (isset($editdata))
                                                        <option data-display="{{__('zoom.Package')}} *"
                                                                value="">Select Package *
                                                        </option>
                                                        <option
                                                            value="0" {{ old('approval_type',$editdata->approval_type) == 0? 'selected' : ''}} >
                                                            Automatically
                                                        </option>
                                                        <option
                                                            value="1" {{ old('approval_type',$editdata->approval_type) == 1? 'selected' : ''}} >
                                                            Manually Approve
                                                        </option>
                                                        <option
                                                            value="2" {{ old('approval_type',$editdata->approval_type) == 2? 'selected' : ''}} >
                                                            No Registration Required
                                                        </option>
                                                    @else
                                                        <option data-display="{{__('zoom.Package')}} *"
                                                                value="">Select
                                                            Package *
                                                        </option>
                                                        <option
                                                            value="0" {{ old('approval_type',$default_settings->approval_type) == 0? 'selected' : ''}} >
                                                            Automatically
                                                        </option>
                                                        <option
                                                            value="1" {{ old('approval_type',$default_settings->approval_type) == 1? 'selected' : ''}} >
                                                            Manually Approve
                                                        </option>
                                                        <option
                                                            value="2" {{ old('approval_type',$default_settings->approval_type) == 2? 'selected' : ''}} >
                                                            No Registration Required
                                                        </option>
                                                    @endif

                                                </select>
                                                @if ($errors->has('approval_type'))
                                                    <span class="invalid-feedback invalid-select"
                                                          role="alert">
                                        <strong>{{ @$errors->first('approval_type') }}</strong>
                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Start setting  --}}


                                    <div class="row mt-40">
                                        <div class="col-lg-12 text-center">
                                            @if(empty($user->zoom_api_key_of_user) ||empty($user->zoom_api_serect_of_user))
                                                <small class="text-danger">* Please make sure zoom api key
                                                    setup successfully. Without zoom api
                                                    key setup, you can't create class</small>
                                            @else
                                                <button class="primary-btn fix-gr-bg">
                                                    <span class="ti-check"></span>
                                                    @if(isset($editdata))
                                                        {{__('zoom.Update')}}
                                                    @else
                                                        {{__('zoom.Save')}}
                                                    @endif
                                                    {{__('zoom.Class')}}

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
