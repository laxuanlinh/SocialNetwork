<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LinK</title>
    <link rel="stylesheet" href="{{asset("/css/bootstrap.min.css")}}"/>
    <link rel="stylesheet" href="{{asset("/css/style.css")}}" type="text/css"/>
</head>
<body>
    @include('templates.partial.navigation')
    <div class="container">
        @include('templates.partial.alert')
        @yield('content')
    </div>
</body>
</html>