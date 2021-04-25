<!DOCTYPE html>
<html>
<head>
    <title>{{ $name }}</title>
</head>
<body>
    <h1>{{ getSetting()->mail_header }}</h1>
    <h4>{{ $subject }}</h4>
    <p>{!! $message !!}</p>

    <p>By</p>
    <p>{{ $user }}</p>
    <p>{{$pass['email'] }}</p>
</body>
</html>
