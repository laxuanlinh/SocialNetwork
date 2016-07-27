<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ Session::token() }}">
    <title>LinK</title>
    <link rel="stylesheet" href="{{asset("/css/bootstrap.min.css")}}"/>
    <link rel="stylesheet" href="{{asset("/css/style.css")}}" type="text/css"/>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script type="text/javascript" src="{{asset("/js/jquery-3.0.0.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("/js/script.js")}}"></script>
    <script type="text/javascript" src="{{asset("/js/mustache.js")}}"></script>
    <script type="text/javascript" src="{{asset("/js/timeago.js")}}"></script>

</head>
<body>

    @include('templates.partial.emoticons')
    @include('templates.partial.navigation')
    <div class="container">
        @include('templates.partial.alert')
        @yield('content')
    </div>
</body>
</html>