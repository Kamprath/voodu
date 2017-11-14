<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Voodu</title>
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
</head>

<body>
    <!-- App container -->
    <div id="app"></div>

    <script src="{{ mix('/js/app.js') }}"></script>

    <!-- Bootstrapped Vue data -->
    <script id="bootstrapped">@yield('bootstrapped')</script>
</body>

</html>