<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Voodu</title>
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
</head>

<body>
    <!-- App container -->
    <div id="app"></div>

    <!-- Bootstrapped Vue data -->
    <script>
        window.Voodu = {
            bootstrapped: @yield('bootstrapped', '{}')
        };
    </script>

    <script src="{{ mix('/js/app.js') }}"></script>
</body>

</html>