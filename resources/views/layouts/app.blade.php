<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

    @yield('extra-css')
</head>
<body>

@include('components.audio-alert')

@yield('content')

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>

@include('sweetalert::alert')

<script>
    $(document).tooltip({
        track: true,
        classes: {
            "ui-tooltip": "text-primary shadow border-primary rounded"
        }
    });
</script>
<script src="{{ asset('js/extra/jquery.multipage.js') }}"></script>
<script>
    $('#myform').multipage({
        generateNavigation: false,
    });
</script>

@yield('extra-script')
<script src="https://kit.fontawesome.com/01809e8659.js" crossorigin="anonymous"></script>
</body>
</html>
