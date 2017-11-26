<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Voodu') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
    @yield('content')

    <!-- Bootstrapped Vue data -->
    <script>
        window.Voodu = {
            bootstrapped: @yield('bootstrapped', '{}')
        };
    </script>

    <script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>
