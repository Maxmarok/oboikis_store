<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
    <link rel="icon" type="image/x-icon" href="/favicon_icon.ico?v=2">
    <link rel="icon" type="image/png" href="/favicon_icon.png?v=2" />
    <link rel="apple-touch-icon" href="/favicon_icon.png?v=2"/>

    @yield('meta')
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>

<body>
    <div id="app" class="d-flex flex-column min-vh-100">
        <!-- @yield('content') -->
    </div>
</body>
</html>
