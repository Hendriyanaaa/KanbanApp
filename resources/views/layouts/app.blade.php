<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
</head>
<body>
    <div class="container">
        @include('sidebar')
        @yield('content')
    </div>
</body>
</html>