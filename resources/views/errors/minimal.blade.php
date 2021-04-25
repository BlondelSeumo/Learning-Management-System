<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{ asset('public/') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('public/') }}/css/error.css">

    <title>
        @yield('code') | @yield('title')
    </title>

    <style>

    </style>
</head>
<body class="antialiased font-sans">

<div class="md:flex min-h-screen">
    <div class="w-full md:w-1/2   flex items-center justify-center">
        @yield('content')

    </div>


</div>
</body>

</html>
