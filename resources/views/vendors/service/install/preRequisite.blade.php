@extends('service::layouts.app_install', ['title' => __('service::install.environment')])

@section('content')
<div class="single-report-admit">
    <div class="card-header">
        <h2 class="text-center text-uppercase" style="color: whitesmoke">{{ __('service::install.environment_title') }}
        </h2>

    </div>
</div>

<div class="card-body">
    <div class="requirements">
        <div class="row">
            <div class="col-md-12">
                <h4>Serviver Requirements </h4>
                <hr class="mt-0">
            </div>
            @foreach ($server_checks as $server)
             @php
                if(gv($server, 'type') == 'error' and !$has_false){
                    $has_false = true;
                }
            @endphp
            <div class="col-md-6">
                <p style="font-size: 13px; padding:5px;"
                    class="alert alert-{{ gv($server, 'type') == 'error' ? 'danger' : 'success' }}">
                    <i class="ti-{{ gv($server, 'type') == 'error' ? 'na' : 'check-box' }} mr-1"></i>
                    {{ gv($server, 'message') }}
                </p>
            </div>
            @endforeach
            <div class="col-md-12">
                <h4>Folder Requirements </h4>
                <hr class="mt-0">
            </div>
            @foreach ($folder_checks as $folder)
            @php
                if(gv($folder, 'type') == 'error' and !$has_false){
                    $has_false = true;
                }
            @endphp
            <div class="col-md-6">
                <p style="font-size: 13px; padding:5px;"
                    class="alert alert-{{ gv($folder, 'type') == 'error' ? 'danger' : 'success' }}">
                    <i class="ti-{{ gv($folder, 'type') == 'error' ? 'na' : 'check-box' }} mr-1"></i>
                    {{ gv($folder, 'message') }}
                </p>
            </div>
            @endforeach
        </div>
    </div>
    @if($has_false)
    <p class="text-center alert alert-danger mt-40">
        Please solve the requirements issue.
    </p>
    <a href="{{ route('service.preRequisite') }}" class="offset-3 col-sm-6 primary-btn fix-gr-bg mb-20 ">
        {{ __('service::install.refresh') }} </a>
    @else
    <p class="text-center alert alert-success mt-40">
        All The Requirements look's Fine. Let's Dig in
    </p>
    <a href="{{ route('service.license') }}" class="offset-3 col-sm-6 primary-btn fix-gr-bg  mb-20">
        {{ __('service::install.lets_go_next') }} </a>

    @endif
</div>
@stop
