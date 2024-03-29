<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel React application</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{mix('css/app.css')}}" rel="stylesheet" type="text/css">
</head>
<body>
<h2 style="text-align: center"> UrlShortener </h2>
<div id="root"></div>
<script src="{{mix('js/app.js')}}" ></script>
<script>
    window.token = '{{ csrf_token() }}';
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = window.token;
</script>
</body>
</html>