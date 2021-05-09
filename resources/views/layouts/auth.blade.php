<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <title>Company - @yield('title')</title>

    @yield('styles')

    <!-- Styles -->
    <link href="{{asset('assets/css/core.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/thesaas.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/assets/img/car_small.jpg">
    <link rel="icon" href="/assets/img/car_small.jpg">

    <style>
    </style>
</head>

<body class="mh-fullscreen bg-img center-vh p-20" style="background-image: url({{asset('assets/img/bg-girl.jpg')}});">

    @yield('content')

<!-- Scripts -->
{{--<script src="/assets/js/core.min.js"></script>--}}
{{--<script src="/assets/js/thesaas.min.js"></script>--}}
{{--<script src="/assets/js/script.js"></script>--}}

@yield('scripts')

</body>
</html>

