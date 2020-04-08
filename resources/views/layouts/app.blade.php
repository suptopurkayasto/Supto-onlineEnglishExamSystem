<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://kit.fontawesome.com/01809e8659.js" crossorigin="anonymous"></script>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

{{--    <title>{{ config('app.name', 'Laravel') }}</title>--}}
    <title>@yield('title')</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    @yield('extra-css')
    <script>
        var h = window.innerHeight
            || document.documentElement.clientHeight
            || document.body.clientHeight;
    </script>
</head>
<body>
    @include('components.audio-alert')
    <div id="app" class="h-100">
        <main class=" h-100">
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('extra-scripts')
    @include('sweetalert::alert')

    <script>
        $(document).ready(function () {
            var height = $(window).innerHeight();
            $('body').css({'height': height});
        });
    </script>

</body>
</html>
