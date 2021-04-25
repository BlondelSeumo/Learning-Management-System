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
    <link rel="stylesheet" type="text/css" href="{{ asset($base_path . '/css/sweetalert2.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset($base_path . '/css/sweet_alert2.css') }}">

    @stack('css')


</head>

<body class="admin">
    <div class="container">
        <div class="col-md-8 offset-2  mt-40">
            <div class="card" id="content">
                @section('content')

                @show
            </div>
        </div>
    </div>

    <script type="text/javascript" src="{{ asset($base_path . '/js/jquery-3.2.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset($base_path . '/js/popper.js') }}"></script>
    <script type="text/javascript" src="{{ asset($base_path . '/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset($base_path . '/js/toastr.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset($base_path . '/js/parsley.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset($base_path . '/js/sweetalert2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset($base_path . '/js/function.js') }}"></script>
    <script type="text/javascript" src="{{ asset($base_path . '/js/common.js') }}"></script>

    @if (session("message"))
    <script>
        toastr. {
            {
                session('status')
            }
        }('{{ session("message") }}', '{{ ucfirst(session('
            status ', '
            error ')) }}');

    </script>
    @endif
    @stack('js')

</body>

</html>
