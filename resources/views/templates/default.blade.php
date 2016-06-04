<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Link Social Network</title>
    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">--}}
    <link rel="stylesheet" href="{{asset("/css/bootstrap.min.css")}}"/>
</head>
<body>
    @include('templates.partial.navigation')
    <div class="container">
        @include('templates.partial.alert')
        @yield('content')
    </div>
</body>
</html>