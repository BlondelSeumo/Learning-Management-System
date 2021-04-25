@extends('backend.master')
@section('mainContent')
    @include("backend.partials.alertMessage")
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1> {{__('zoom.Virtual Class')}}</h1>
                <div class="bc-pages">
                    <a href="{{route('dashboard')}}">{{__('common.Dashboard')}}</a>
                    <a href="#">{{__('virtual-class.Setup')}}</a>
                </div>
            </div>
        </div>
    </section>

    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-title">
                                <h3 class="mb-30">

                                    {{__('virtual-class.Setup')}}
                                </h3>
                            </div>

                            {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'setting.update','method' => 'POST', 'enctype' => 'multipart/form-data']) }}

                            <div class="white-box">
                                <div class="add-visitor">

                                    <div class="row">
                                        <div class="col-lg-6 mt-40">
                                            <label class="primary_input_label"
                                                   for="">{{__('virtual-class.Type')}}</label>
                                            <select
                                                class="primary_select type {{ $errors->has('type') ? ' is-invalid' : '' }}"
                                                id="type" name="class">
                                                <option
                                                    value="0" {{ $setting->default_class == 0 ? 'selected' : ''}}>{{__('virtual-class.Zoom')}}</option>
                                                @if(moduleStatusCheck("BBB"))

                                                    <option
                                                        value="1" {{$setting->default_class == 1 ? 'selected' :''}}>{{__('virtual-class.Big Blue Button')}}</option>
                                                @endif

                                                @if(moduleStatusCheck("Jitsi"))
                                                    <option
                                                        value="2" {{$setting->default_class == 2 ? 'selected' :''}}>{{__('jitsi.Jitsi')}}</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mt-40">
                                        <div class="col-lg-12 text-center">
                                            <button class="primary-btn fix-gr-bg" data-toggle="tooltip">
                                                <span class="ti-check"></span>

                                                {{__('virtual-class.Update')}}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <div id="edit_form">

    </div>
    <div id="view_details">

    </div>

    @include('backend.partials.delete_modal')
@endsection
@push('scripts')
@endpush
