@extends("layouts.profile")

@section("title") Добавить урок @endsection


@section('content')

  <link rel="stylesheet" href="{{ asset("css/forms.css") }}">
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
            <a class="nav-link" href="/profile/settings" tabindex="-1">Персональные данные</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://vk.com/1ommy" tabindex="-1" target="_blank">Сообщить о проблеме
                                                                                          разработчику</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/logout" tabindex="-1">Выйти из аккаунта</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>


  <div class="limiter table-responsive">
      <div class="container-fluid container-login100 h-100 table-responsive">
        <div class="table-responsive wrap-login100 p-l-15 p-r-55 p-t-25 p-b-50" style="width: 700px !important;">
          <a href="/group/{{$group_id}}" class="btn-sm btn-orange"
             style="color:white;border:1px solid #eee;cursor:pointer;padding-left:20px;padding-right:20px"> <i
              class="fa fa-arrow-left" aria-hidden="true"></i>
            Назад</a>
           
          <form class="login100-form validate-form p-l-25 p-t-45" method="POST">
            @csrf
            @include('layouts.alerts')
            <span class="login100-form-title p-b-33">
                    Добавление занятия
                </span>

            <div class="wrap-input100 validate-input">
              <input class="input100" type="date" id="datelesson" name="date" value=<?= date('Y-m-d'); ?>
                required>
              <span class="focus-input100-1"></span>
              <span class="focus-input100-2"></span>
            </div>

            <div class="wrap-input100 rs1 validate-input">
                    <textarea class="input100" id="hw" rows="4" placeholder="Домашнее задание" name="homework"
                              required></textarea>
              <span class="focus-input100-1"></span>
              <span class="focus-input100-2"></span>
            </div>
            <div class="wrap-input100 rs1 validate-input">
              <input class="input100" type="text" id="theme" placeholder="Тема урока" name="lesson_theme"
                     required>
              <span class="focus-input100-1"></span>
              <span class="focus-input100-2"></span>
            </div>
            <small>Стоимость занятия с ДЗ (необязательно)</small>
            <div class="wrap-input100 rs1 validate-input">
              <input class="input100" type="number" id="costHome"
                     placeholder="Стоимость занятия с ДЗ (необязательно)" name="cost_home"
                     value=@if($age== 1)500 @else 1000 @endif">
              <span class="focus-input100-1"></span>
              <span class="focus-input100-2"></span>
            </div>
            <small>Стоимость занятия без ДЗ (необязательно)</small>
            <div class="wrap-input100 rs1 validate-input">
              <input class="input100" type="number" id="costClassic"
                     placeholder="Стоимость занятия без ДЗ (необязательно)" name="cost_classic"
                     value=@if ($age== 1)550 @else 1000 @endif>
              <span class="focus-input100-1"></span>
              <span class="focus-input100-2"></span>
            </div>
            <small>Стоимость видео (необязательно)</small>
            <div class="wrap-input100 rs1 validate-input">
              <input class="input100" type="number" id="costVideo" placeholder="Стоимость видео (необязательно)"
                     value=@if ($age== 1)300 @else 1000 @endif
                     name="cost_video">
              <span class="focus-input100-1"></span>
              <span class="focus-input100-2"></span>
            </div>
            <script>
              document.querySelector("#costHome").addEventListener("change", (e) => {
                if (e.target.value !== "") {
                  document.querySelector("#costClassic").setAttribute('required', "true");
                  document.querySelector("#costVideo").setAttribute('required', "true");
                } else {
                  document.querySelector("#costClassic").removeAttribute('required');
                  document.querySelector("#costVideo").removeAttribute('required');
                }
              })
            </script>
            <div class="table-responsive">
            <table class="table border table-striped table-hover" >
              <thead class="table-dark">
              <tr>
                <th style="margin: 5px !important;" class="border" scope="col">Имя ученика</th>
                <th class="border" scope="col">Присутствие на уроке</th>
  <th class="border" scope="col">Оценка</th>
               </tr>
              </thead>
              <tbody>
              @foreach($students as $student)
                <tr class="border">
                  <td class="border">{{$student->name }}</td>
                  <td class="border">
                    <select name="{{$student->id}}"
                            class="form-control" style="display:block !important;font-size: 12px !important">
                      <option value="1">Выполняет ДЗ</option>
                      <option value="2">Не Выполняет ДЗ</option>
                      <option value="3">Смотрит Видео</option>
                    </select>
                  </td>
                  <td class="border">
                   <input name="{{$student->id}}mark" type="number" placeholder="Оценка" value="-1" required class="form-control">
                  </td>
                </tr>
              @endforeach
              </tbody>
            </table>
            </div>
            <div class="container-login100-form-btn m-t-20">
              <button class="login100-form-btn">
                Добавить занятие
              </button>
            </div>
          </form>
          
        </div>
      </div>
  </div>
@endsection