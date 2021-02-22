<!doctype html>
<html lang="ru">
<head>
  <title>IT-ПАРК | @section('title') @show</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <meta name="description" content="IT-ПАРК - Образовательный онлайн проект для начинающих программистов">
  <link rel="stylesheet" href=" {{ asset('public/css/landing/style.css') }}">
  <link rel="stylesheet" href=" {{ asset('public/css/landing/media.css') }}">
  <link rel="shortcut icon" href=" {{ asset('public/img/landing/favicon.ico') }}">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous" />
</head>
<body>
@yield('content')

@include('layouts.footer')
</body>
</html>
