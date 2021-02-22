<!doctype html>

<html lang="ru">

<head>
    <title>Админ панель </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta name="description" content="IT-ПАРК - Образовательный онлайн проект для начинающих программистов">
    <link rel="shortcut icon" href=" {{ asset('public/img/landing/favicon.ico') }}">
    <link
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
            rel="stylesheet"
    />
    <link
            href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
            rel="stylesheet"
    />

</head>
<body>

<div id="app">
    @yield('content')
</div>
<script src={{  asset("public/dist/bundle.js") }}></script>
</body>

</html>

