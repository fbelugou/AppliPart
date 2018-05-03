<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('titre')</title>
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('js/bootstrap.js') }}"></script>
    <style> textarea { resize: none; } </style>
</head>
<body>
    @yield('contenu')
</body>
</html>
