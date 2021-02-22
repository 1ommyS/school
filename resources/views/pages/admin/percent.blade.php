@extends("layouts.profile")@section("title") Установка банковского процента @endsection<link rel="stylesheet" href="{{ asset("css/forms.css") }}">@section('content')  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">    <span class="navbar-brand ">С возвращением, <br> {{ Auth::user() ->login}}</span>    <button      class="navbar-toggler"      type="button"      data-mdb-toggle="collapse"      data-mdb-target="#navbarSupportedContent"      aria-controls="navbarSupportedContent"      aria-expanded="false"      aria-label="Toggle navigation"    >      <i class="fas fa-bars"></i>    </button>    <div class="collapse navbar-collapse" id="navbarSupportedContent">      <div class="navbar-nav">        <li class="nav-item dropdown">          <a            class="nav-link active dropdown-toggle nav-item"            href="#"            id="analytic"            role="button"            data-mdb-toggle="dropdown"            aria-expanded="false"          >            Аналитика          </a>          <!-- Dropdown menu -->          <ul class="dropdown-menu" aria-labelledby="analytic">            <li>              <a href="/profile/auxil" class="dropdown-item">Дополнительные расходы</a>            </li>            <li>              <a href="/profile" class="dropdown-item">Аналитика (преподаватели)</a>            </li>            <li>              <a href="/profile/all" class="dropdown-item">Аналитика (месяц)</a>            </li>            <li>              <a href="/profile/period" class="dropdown-item">Аналитика (период)</a>            </li>          </ul>        </li>        <li class="nav-item dropdown">          <a            class="nav-link dropdown-toggle nav-item"            href="#"            id="infrastructure"            role="button"            data-mdb-toggle="dropdown"            aria-expanded="false"          >            Структура организации          </a>          <!-- Dropdown menu -->          <ul class="dropdown-menu" aria-labelledby="infrastructure">            <li>              <a href="/profile/teachers" class="dropdown-item">Учителя</a>            </li>            <li>              <a href="/profile/students" class="dropdown-item">Ученики</a>            </li>            <li>              <a href="/profile/birthdays" class="dropdown-item">Дни рождения</a>            </li>            <li>              <a href="/profile/groups" class="dropdown-item">Группы</a>            </li>          </ul>        </li>        <li class="nav-item dropdown">          <a            class="nav-link dropdown-toggle nav-item"            href="#"            id="others"            role="button"            data-mdb-toggle="dropdown"            aria-expanded="false"          >            Дополнительно          </a>          <!-- Dropdown menu -->          <ul class="dropdown-menu" aria-labelledby="others">            <li>              <a href="/profile/sending" class="dropdown-item">Рассылка</a>            </li>            <li>              <a href="/profile/settings" class="dropdown-item">Персональные данные</a>            </li>            <li>              <a href="/profile/logs" class="dropdown-item ">Логи</a>            </li>            <li>              <a href="/panel" class="dropdown-item ">Админ панель</a>            </li>          </ul>        </li>        <a href="/logout" class="nav-item nav-link" tabindex="-1">Выйти из аккаунта</a>      </div>    </div>  </nav>  <div class="limiter table-responsive h-100">    <div class="container-login100 container-fluid h-100">      <div class="wrap-login100 p-l-15 p-r-55 p-t-25 p-b-50">        <a href="/profile/all" class="btn-sm btn-orange"           style="color:white;border:1px solid #eee;padding-left:20px;padding-right:20px">  <i class="fa fa-arrow-left" aria-hidden="true"></i>          Назад</a>        <form class="login100-form validate-form p-t-45 p-l-25" method="POST">          @csrf          @include('layouts.alerts')          <span class="login100-form-title p-b-33">          Установка банковского процента        </span>          <small style='font-size:16px; color:#666'>Дата:</small>          <div class='mt-1 mb-2 wrap-input100 rs1 validate-input'>            <input class='input100' type='date' name='date' required>            <span class='focus-input100-1'></span>            <span class='focus-input100-2'></span>          </div>          <small style='font-size:16px; color:#666'>Процент: </small>          <div class='mt-1 mb-2 wrap-input100 rs1 validate-input'>            <input class='input100' name='value' placeholder='Значение в %' required max="100">            <span class='focus-input100-1'></span>            <span class='focus-input100-2'></span>          </div>          <div class='container-login100-form-btn m-t-20'>            <button class='login100-form-btn'>              Установить            </button>          </div>        </form>      </div>    </div>  </div>@endsection