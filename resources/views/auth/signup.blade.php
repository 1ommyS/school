@extends('layouts.profile')
{{--<link rel="stylesheet" href="{{ asset("public/css/forms.css") }}">--}}
@section('title')
  Регистрация
@endsection

@section('content')
  <div class="container-fluid" style="background:  #dfdfdf !important; margin-bottom: 0 !important;">
    <div class="w-auto h-100 d-flex justify-content-center">
      <div class="wrap-login100 mt-5 p-l-25 p-r-25 p-t-35 p-b-10">
        <form class="login100-form validate-form" method="POST" action="{{ route('auth.create') }}">
          <a href="{{ route('auth.login') }}" class="btn-sm btn-orange" style="color: white">
            <i class="fa fa-arrow-left" aria-hidden="true"></i>Авторизация </a>
          @csrf
          @include('layouts.alerts')
          <span class="login100-form-title p-b-33">
             Регистрация
           </span>

          <small style='font-size:16px; color:#666'>Логин:</small>
          <div class="wrap-input100 validate-input mt-1">
            <input class="input100" type="text" name="login" value="{{ old('login') }}" placeholder="Логин" required>
            <span class="focus-input100-1"></span>
            <span class="focus-input100-2"></span>
          </div>

          <small style='font-size:16px; color:#666'>Пароль:</small>
          <div class="wrap-input100 rs1 validate-input mt-1">
            <input class="input100" type="text" name="password" placeholder="Пароль" required>
            <span class="focus-input100-1"></span>
            <span class="focus-input100-2"></span>
          </div>

          <small style='font-size:16px; color:#666'>Подтверждение пароля:</small>
          <div class="wrap-input100 rs1 validate-input mt-1">
            <input class="input100" type="text" name="password_confirmation" placeholder="Введите пароль ещё раз"
                   required>
            <span class="focus-input100-1"></span>
            <span class="focus-input100-2"></span>
          </div>

          <small style='font-size:16px; color:#666'>ФИО:</small>
          <div class="wrap-input100 rs1 validate-input mt-1">
            <input class="input100" type="text" name="name" value="{{ old('name') }}" placeholder="ФИО" required>
            <span class="focus-input100-1"></span>
            <span class="focus-input100-2"></span>
          </div>
          <small style='font-size:16px; color:#666'>Город проживания:</small>
          <div class="wrap-input100 rs1 validate-input mt-1">
            <input class="input100" type="text" name="city" value="{{ old('city') }}" placeholder="город проживания"
                   required>
            <span class="focus-input100-1"></span>
            <span class="focus-input100-2"></span>
          </div>
          <small style='font-size:16px; color:#666'>Номер телефона:</small>
          <div class="wrap-input100 rs1 validate-input mt-1">
            <input class="input100" type="text" name="phone_student" value="{{ old('phone_student') }}"
                   placeholder="номер телефона" required>
            <span class="focus-input100-1"></span>
            <span class="focus-input100-2"></span>
          </div>
          <small style='font-size:16px; color:#666'>Дата рождения:</small>
          <div class="wrap-input100 rs1 validate-input mt-1">
            <input class="input100" type="date" name="birthday" value="{{ old('birthday') }}"
                   placeholder="День рождения" required>
            <span class="focus-input100-1"></span>
            <span class="focus-input100-2"></span>
          </div>
          <small style='font-size:16px; color:#666'>Возраст:</small>
          <div class="wrap-input100 rs1 validate-input mt-1">
            <select name="age" class="form-control">
              <option value="1">Школьник</option>
              <option value="2">Студент</option>
              <option value="3">Взрослый</option>
            </select>
            <span class="focus-input100-1"></span>
            <span class="focus-input100-2"></span>
          </div>

          <small style='font-size:16px; color:#666'>Страница ВК:</small>
          <div class="wrap-input100 rs1 validate-input mt-1">
            <input class="input100" type="text" name="link_vk" value="{{ old('link_vk') }}"
                   placeholder="Ваш ВК: https://vk.com/1ommy" required>
            <span class="focus-input100-1"></span>
            <span class="focus-input100-2"></span>
          </div>
          <small style='font-size:16px; color:#666'>ФИО родителя:</small>
          <div class="wrap-input100 rs1 validate-input mt-1">
            <input class="input100" type="text" name="name_parent" value="{{ old('name_parent') }}"
                   placeholder="ФИО родителя" required>
            <span class="focus-input100-1"></span>
            <span class="focus-input100-2"></span>
          </div>
          <small style='font-size:16px; color:#666'>Номер телефона родителя:</small>
          <div class="wrap-input100 rs1 validate-input mt-1">
            <input class="input100" type="text" name="phone_parent" value="{{ old('phone_parent') }}"
                   placeholder="номер телефона родителя" required>
            <span class="focus-input100-1"></span>
            <span class="focus-input100-2"></span>
          </div>
          <small style='font-size:16px; color:#666'>ВК родителя:</small>
          <div class="wrap-input100 rs1 validate-input mt-1">
            <input class="input100" type="text" name="parent_vk" value="{{ old('parent_vk') }}"
                   placeholder="ВК родителя: https://vk.com/1ommy" required>
            <span class="focus-input100-1"></span>
            <span class="focus-input100-2"></span>
          </div>
          <div class="container-login100-form-btn m-t-20">
            <button class="login100-form-btn">
              Зарегистрироваться
            </button>
          </div>
          <div class="text-center">
          <span class="txt1">
            Есть аккаунт?
           </span>
            <a href="{{ route('login') }}" class="txt2 hov1">
              Авторизация
            </a> <br>
          </div>

        </form>

      </div>

    </div>

  </div>-
@endsection

