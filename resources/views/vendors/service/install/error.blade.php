@extends('service::layouts.app', ['title' => __('service::install.error')])


@section('content')

<div class="single-report-admit">
    <div class="card-header">
        <h2 class="text-center text-uppercase" style="color: whitesmoke">{{ $title ??  __('service::install.error') }}
        </h2>

    </div>
</div>

<div class="card-body">
    <p style="text-align: center">
        {{$message }}
    </p>

    <a href="{{ url('/') }}" class="offset-3 col-sm-6 primary-btn fix-gr-bg mt-40 mb-20">
        {{ __('service::install.goto_home') }} </a>
</div>

@stop
