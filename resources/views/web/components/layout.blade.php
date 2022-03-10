<!DOCTYPE html>
<html>
<head>
    <title>@yield('title') | Laravel</title>
{{--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">--}}
    <link href="{{ asset('/assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/css/dashboard.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body>
@include('web/components/header')

<div class="container">
    <div class="row">
        @yield('main')
    </div>

    @include('web/components/footer')
</div>

<script src="/assets/js/app.js"></script>
@yield('script')
</body>
</html>

