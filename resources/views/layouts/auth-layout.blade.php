<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$page_title ?? 'Auth'}}</title>
    <link rel="stylesheet" href="{{asset('assets/css/reset-css.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/auth.css')}}">
</head>
<body>
    <div class="main">
        <div class="container">
            <h2 class = "title">{{$page_title ?? 'Auth'}}</h2>
            @yield('main')
        </div>
    </div>
</body>
</html>