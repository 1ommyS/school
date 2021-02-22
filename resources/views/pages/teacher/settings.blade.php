@extends('layouts.profile')



@section('title') Настройки @endsection



@section('content')


  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <span class="navbar-brand">С возвращением, <br> {{ Auth::user()->login }} </span>
      <button
        class="navbar-toggler"
        type="button"
        data-mdb-toggle="collapse"
        data-mdb-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <i class="fas fa-bars"></i>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link " href="/profile/" aria-current="page">Мои группы</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="/profile/wages/">Зарплата</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="/profile/settings" tabindex="-1">Персональные данные</a>
          </li>
          <li class="nav-item">
            <a class="nav-link"  href="https://vk.com/1ommy" tabindex="-1" target="_blank">Сообщить о проблеме разработчику</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/logout" tabindex="-1">Выйти из аккаунта</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="limiter table-responsive">
    <div class=" container-fluid h-100 container-login100">
      <div class="wrap-login100 p-l-15 p-r-55 p-t-25 p-b-50">
        <a href=" {{ route('profile') }}" class="btn-sm btn-orange"
           style="color:white;border:1px solid #eee;padding-left:20px;padding-right:20px"> <i class="fa fa-arrow-left"
                                                                                              aria-hidden="true"></i>
          Назад</a>
        <form class="login100-form validate-form p-l-55 p-r-45 p-t-45" method="POST"
              action="{{ route('profile.save') }}">
          @csrf
          @include('layouts.alerts')

         <span class="login100-form-title p-b-33">
          Персональные данные
        </span>

         <small style='font-size:16px; color:#666'>Логин:</small>
          <div class='mt-1 mb-2 wrap-input100 rs1 validate-input'>
            <input class='input100' type='text' name='login' value="{{ Auth::user()->login }}" placeholder='login'
                   required>
            <span class='focus-input100-1'></span>
           <span class='focus-input100-2'></span>
          </div>

          <small style='font-size:16px; color:#666'>Пароль:</small>
         <div class='mt-1 mb-2 wrap-input100 rs1 validate-input'>
            <input class='input100' type='text' name='password' placeholder='Пароль' required>
            <span class='focus-input100-1'></span>
            <span class='focus-input100-2'></span>
          </div>

         <small style='font-size:16px; color:#666'>Имя:</small>
          <div class='mt-1 mb-2 wrap-input100 rs1 validate-input'>
           <input class='input100' type='text' name='name' value="{{ Auth::user()->name }}" placeholder='имя' required>
            <span class='focus-input100-1'></span>
            <span class='focus-input100-2'></span>
         </div>
          <small style='font-size:16px; color:#666'>Ваш телефон:</small>
          <div class='mt-1 mb-2 wrap-input100 rs1 validate-input'>
           <input class='input100' type='text' name='phone_teacher' value="{{ Auth::user()->phone_teacher }}" placeholder='Ваш телефон:' required>
            <span class='focus-input100-1'></span>
            <span class='focus-input100-2'></span>
          </div>

          <small style='font-size:16px; color:#666'>Страница ВК:</small>
          <div class='mt-1 mb-2 wrap-input100 rs1 validate-input'>
          <input class='input100' type='text' name='link_vk' value="{{ Auth::user()->link_vk }}"
                  placeholder='Номер родителя' required>
            <span class='focus-input100-1'></span>
           <span class='focus-input100-2'></span>
          </div>
        <div class='container-login100-form-btn m-t-20'>
           <button class='login100-form-btn'>
              Сменить Данные
           </button>

        </div>
        </form>
      </div>
   </div>
  </div>
@endsection