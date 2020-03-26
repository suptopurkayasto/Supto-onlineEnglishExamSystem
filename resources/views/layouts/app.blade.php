<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

{{--    <title>{{ config('app.name', 'Laravel') }}</title>--}}
    <title>Student | @auth('student') {{ auth()->guard('student')->user()->name }}@endauth - @yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <script>
        var h = window.innerHeight
            || document.documentElement.clientHeight
            || document.body.clientHeight;
    </script>
</head>
<body style="height: 100vh">
    <div id="app" class="h-100">
        <main class=" h-100">
            @yield('content')
        </main>
    </div>

    @yield('extra-scripts')
</body>
</html>
