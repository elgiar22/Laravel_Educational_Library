<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <title>@yield('title')</title>
   @yield('css') 
</head>
<body>
@yield('content')

@yield('js')

<script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>
</html>