<!DOCTYPE html>
<html>
<head>
  <title>IT-Park</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <link rel="stylesheet" href="{{ asset('public/css/landing/media.css') }}">
  <link rel="stylesheet" href="{{ asset('public/css/landing/style.css') }}">
  <link rel="shortcut icon" href="{{asset('/favicon.ico')}}">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous" />
</head>
<body>
<style>
    .error-main .btn-reg {
        padding: 10px 20px;
        background: linear-gradient(180deg, #FFA632 0%, #E8880B 100%);
        margin-bottom: 30px;
        border-radius: 8px;
        transform: translate(-20px, 0px);
        font-size: 20px;
        color: white;
        transition: 0s !important;
    }

    .error-main .btn-reg:hover {
        color: white;
        background: rgb(248, 157, 38);
    }
</style>
<header>
  <div class="container-fluid">
    <div class="row">
      <div class="col-12 header-navbar text-center">
        <img src="{{asset("public/img/landing/logo.png")}}" class="logo logo-large ">
      </div>
    </div>
  </div>
</header>
<section class="error-main">
  <div class="row">
    <div class="col-12 text-center" style="margin-bottom: 90px;">
      <h1 style="font-size: 60px; margin-bottom: 10px;">404</h1>
      <a class="btn btn-reg" href="https://vk.com/itpark32">Связаться</a>
      <div>
        <img src="{{asset("public/img/landing/Group.png")}}" style="width: 300px"></div>
    </div>
  </div>
</section>
<footer>
  <div class="container-fluid">
    <div class="row text-lg-left" style="color:rgb(138, 138, 138); font-size:12px">
      <div class="col-lg-4 ">
        <p>ИП Смыслов Алексей Михайлович <br>ОГРНИП: 318325600036243</p>
      </div>
      <div class="col-lg-4">
        <p>ИНН: 325502986267 <br>Дата присвоения ОГРНИП: 06.07.2018</p>
      </div>
      <div class="col-lg-4">
        <p>a.m.smyslov@yandex.ru <br>г. Брянск ул. Орловская д.19 кв.9</p>
      </div>

    </div>
  </div>
</footer>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
        crossorigin="anonymous"></script>
<script src="{{asset("public/js/landing/script.js")}}">
</script>
</body>
</html>

