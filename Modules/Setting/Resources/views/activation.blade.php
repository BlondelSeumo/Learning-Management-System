@extends('setting::layouts.master')

@section('mainContent')

    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>{{__('setting.Activation')}}</h1>
                <div class="bc-pages">
                    <a href="{{route('dashboard')}}">{{__('common.Dashboard')}}</a>
                    <a href="#">{{__('setting.Settings')}}</a>
                    <a href="#">{{__('setting.Activation')}}</a>
                </div>
            </div>
        </div>
    </section>
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
                        <div class="main-title">
                            <h3 class="mb-0">{{ __('setting.Activation') }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    @include('setting::page_components.activation')
                </div>
            </div>
        </div>
    </section>
@endsection

@include('setting::page_components.script')
