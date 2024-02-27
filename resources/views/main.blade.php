<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{env('APP_NAME')}}</title>
    @vite('resources/css/app.css')
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <script charset="utf-8" src="https://floors-widget.api.2gis.ru/loader.js" id="dg-floors-widget-loader"></script>

</head>


<script charset="utf-8">
    DG.FloorsWidget.init({
        width: '960px',
        height: '600px',
        initData: {
            complexId: '141373143573143'
        }
    });
</script>
<body class="d-flex flex-column min-vh-100">
    <div id="app"></div>
    @vite('resources/js/app.js')
</body>
</html>