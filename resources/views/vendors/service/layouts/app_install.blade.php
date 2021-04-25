<!DOCTYPE html>
<html lang="en">

<head>
    @php

        $base_path = 'public/vendor/spondonit';

    @endphp
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ isset($title) ? $title .' | '. config('app.name') :  config('app.name') }}</title>

    <link rel="stylesheet" href="{{ asset($base_path . '/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset($base_path . '/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset($base_path . '/css/infix.css') }}">
    <link rel="stylesheet" href="{{ asset($base_path . '/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset($base_path . '/css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset($base_path . '/css/parsley.css') }}">

    @stack('css')


</head>

<body class="admin">
    <div class="preloader">
        <div class="loader_img">
            <img src="{{ asset($base_path . '/loader.gif') }}" alt="loading..." height="64" width="64">
            <h2>Please Wait</h2>
        </div>
    </div>
    <div class="container">
        <div class="col-md-8 offset-2  mt-40">
            <ul id="progressbar">
                <li class="{{ active_progress_bar(['service.install', 'service.preRequisite','service.license',  'service.database', 'service.user', 'service.done']) }}">{{ __('service::install.welcome') }}</li>
                <li class="{{ active_progress_bar(['service.preRequisite','service.license',  'service.database', 'service.user', 'service.done']) }} {{ active_link('service.license') }}">{{ __('service::install.environment') }}</li>
                <li class="{{ active_progress_bar(['service.license',  'service.database', 'service.user', 'service.done']) }}">{{ __('service::install.license') }}</li>
                <li class="{{ active_progress_bar([ 'service.database', 'service.user', 'service.done']) }}">{{ __('service::install.database') }}</li>
                <li class="{{ active_progress_bar([ 'service.user', 'service.done']) }}">{{ __('service::install.admin_setup') }}</li>
                <li class="{{ active_progress_bar([ 'service.done']) }}">{{ __('service::install.done') }}</li>

            </ul>
            <div class="card" id="content">
                @section('content')

                @show
            </div>
        </div>
    </div>

    <script src="{{ asset($base_path . '/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset($base_path . '/js/popper.js') }}"></script>
    <script src="{{ asset($base_path . '/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset($base_path . '/js/toastr.min.js') }}"></script>
    <script src="{{ asset($base_path . '/js/parsley.min.js') }}"></script>
    <script src="{{ asset($base_path . '/js/function.js') }}"></script>
    <script src="{{ asset($base_path . '/js/common.js') }}"></script>

    @if (session("message"))
    <script>
        toastr.{{ session('status') }}('{{ session("message") }}', '{{ ucfirst(session('status', 'error')) }}');
    </script>
    @endif
    @stack('js')

</body>

</html>
