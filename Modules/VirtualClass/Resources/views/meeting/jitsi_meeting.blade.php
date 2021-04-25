@extends('backend.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>{{__('jitsi.Classes')}} {{__('jitsi.List')}}</h1>
            <div class="bc-pages">
                <a href="{{route('dashboard')}}">{{__('dashboard.Dashboard')}}</a>
                <a href="#">{{__('jitsi.Classes')}}</a>
                <a href="#">{{__('jitsi.List')}}</a>
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
                            {{__('jitsi.Edit')}}
                        @else
                            {{__('jitsi.Add')}}
                        @endif
                        {{__('jitsi.Classes')}}
                    </h3>
                </div>


                <form class="form-horizontal"
                      action="@if(isset($editdata)){{ route('virtual-class.jitsiMeetingStore',$class->id) }} @else {{ route('virtual-class.jitsiMeetingStore',$class->id) }} @endif"
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
                                            <label>{{__('jitsi.Topic')}} <span>*</span></label>
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
                                            <label>{{__('jitsi.Description')}}</label>
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
                                        <label>{{__('jitsi.Date Of Class')}} <span>*</span></label>
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
                                        <label>{{__('jitsi.Time Of Class')}} <span>*</span></label>
                                        <input
                                            class="primary-input time form-control{{ @$errors->has('time') ? ' is-invalid' : '' }}"
                                            type="text" name="time"
                                            value="{{ isset($editdata) ?  old('topic',$editdata->time_of_meeting) : $class->time}}">
                                        <span class="focus-border"></span>
                                        @if ($errors->has('time'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ @$errors->first('time') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                        @if(empty($env['security_salt']) ||empty($env['server_base_url']))
                                            <small class="text-danger">* Please make sure jitsi api key
                                                setup
                                                successfully. Without jitsi api setup, you can't create
                                                class</small>
                                        @else
                                            <button class="primary-btn fix-gr-bg">
                                                <span class="ti-check"></span>
                                                @if(isset($editdata))
                                                    {{__('jitsi.Update')}}
                                                @else
                                                    {{__('jitsi.Save')}}
                                                @endif
                                                {{__('jitsi.Class')}}

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
