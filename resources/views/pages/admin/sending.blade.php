@extends("layouts.profile")

@section("title") Рассылка сообщений@endsection

<link rel="stylesheet" href="{{ asset("css/forms.css") }}">

@section('content')

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <span class="navbar-brand ">С возвращением, <br> {{ Auth::user() ->login}}</span>
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
      <div class="navbar-nav">
        <li class="nav-item dropdown">
          <a
            class="nav-link  dropdown-toggle nav-item"
            href="#"
            id="analytic"
            role="button"
            data-mdb-toggle="dropdown"
            aria-expanded="false"
          >
            Аналитика
          </a>
          <!-- Dropdown menu -->
          <ul class="dropdown-menu" aria-labelledby="analytic">
            <li>
              <a href="/profile/auxil" class="dropdown-item">Дополнительные расходы</a>
            </li>
            <li>
              <a href="/profile" class="dropdown-item">Аналитика (преподаватели)</a>
            </li>
            <li>
              <a href="/profile/all" class="dropdown-item">Аналитика (месяц)</a>
            </li>
            <li>
              <a href="/profile/period" class="dropdown-item">Аналитика (период)</a>
            </li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a
            class="nav-link  dropdown-toggle nav-item"
            href="#"
            id="infrastructure"
            role="button"
            data-mdb-toggle="dropdown"
            aria-expanded="false"
          >
            Структура организации
          </a>
          <!-- Dropdown menu -->
          <ul class="dropdown-menu" aria-labelledby="infrastructure">
            <li>
              <a href="/profile/teachers" class="dropdown-item">Учителя</a>
            </li>
            <li>
              <a href="/profile/students" class="dropdown-item">Ученики</a>
            </li>
            <li>
              <a href="/profile/birthdays" class="dropdown-item">Дни рождения</a>
            </li>
            <li>
              <a href="/profile/groups" class="dropdown-item">Группы</a>
            </li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a
            class="nav-link active dropdown-toggle nav-item"
            href="#"
            id="others"
            role="button"
            data-mdb-toggle="dropdown"
            aria-expanded="false"
          >
            Дополнительно
          </a>
          <!-- Dropdown menu -->
          <ul class="dropdown-menu" aria-labelledby="others">
            <li>
              <a href="/profile/sending" class="dropdown-item">Рассылка</a>
            </li>
            <li>
              <a href="/profile/settings" class="dropdown-item">Персональные данные</a>
            </li>
            <li>
              <a href="/profile/logs" class="dropdown-item ">Логи</a>
            </li>
            <li>
              <a href="/panel" class="dropdown-item ">Админ панель</a>
            </li>
          </ul>
        </li>
        <a href="/logout" class="nav-item nav-link" tabindex="-1">Выйти из аккаунта</a>
      </div>
    </div>
  </nav>

  <div class="limiter  table-responsive h-100">
    <div class="container-login100 container-fluid h-100">
      <div class="wrap-login100 p-l-15 p-r-55 p-t-25 p-b-50">
        <a href="/profile" class="btn-sm btn-orange"
           style="color:white;border:1px solid #eee;padding-left:20px;padding-right:20px"> <i class="fa fa-arrow-left" aria-hidden="true"></i>
          Назад</a>
        <form class="login100-form validate-form p-t-45 p-l-25" method="POST">
          @csrf
          <span class="login100-form-title p-b-33">
          Рассылка сообщений
          @include('layouts.alerts')
        </span>
          <small style='font-size:16px'>Список пользователей:</small>
          <div class="wrap-input100 rs1 validate-input">
            <input type="text" class="input100" id="search" placeholder="Имя ученика">
            <select class="form-control imprt" multiple id="multiple" required>
              @foreach ( $students as $student )
                <option id='searchable' class='checked' value={{$student->id}}>{{$student->name}}</option>
              @endforeach
            </select>
            <span class="focus-input100-1"></span>
            <span class="focus-input100-2"></span>
         </div>
          <br>
          <small style='font-size:16px'>Выбранные ученики:</small>
          <div class="wrap-input100 rs1 validate-input">
            <select class="form-control checking" multiple id="multiple" name="users[]"></select>
            <span class="focus-input100-1"></span>
            <span class="focus-input100-2"></span>
          </div>
          <br>
          <small style='font-size:16px; color:#666'>Сообщение:</small>
          <div class='mt-1 mb-2 wrap-input100 rs1 validate-input'>
            <input class='input100' type='text' style="color: black;" name="message" required>
            <span class='focus-input100-1'></span>
            <span class='focus-input100-2'></span>
          </div>
          <div class='container-login100-form-btn m-t-20'>
            <button type="button" class='login100-form-btn' id="selectAll">
              Выделить всех
            </button>
          </div>
          <div class='container-login100-form-btn m-t-20'>
            <button type="button" class='login100-form-btn' id="deleteAll">
              Снять выделение со всех
            </button>
          </div>
          <div class='container-login100-form-btn m-t-20'>
            <button class='login100-form-btn' name="VK">
              Сделать рассылку в ВК ученикам
            </button>
          </div>
          <div class='container-login100-form-btn m-t-20'>
            <button class='login100-form-btn' name="SMS">
              Сделать рассылку SMS ученикам
            </button>
          </div>
          <div class='container-login100-form-btn m-t-20'>
            <button class='login100-form-btn' name="SMS_parent">
              Сделать рассылку SMS родителям
            </button>
          </div>
          <script>
            let chosedUsers = {};
            document.querySelector(".imprt").addEventListener("click", e => {
             if (e.target.id !== "searchable") return false;
              chosedUsers[e.target.value] = e.target.textContent;
              let options = "";
              for (const chosedUsersKey in chosedUsers) {
               options +=
                  `<option value="${chosedUsersKey}" id="sendToServer" selected>${chosedUsers[chosedUsersKey]}</option>`;
               document.querySelector(".checking").innerHTML = options;
              }
            })
            document.querySelector(".checking").addEventListener("click", e => {
              let elementsNodeList = document.querySelectorAll("#sendToServer");
              let elements = [];
              let options = "";
              Object.keys(chosedUsers).forEach(key => {
                if (key === e.target.value) {
                  delete chosedUsers[key];
                }
              });
              console.log(chosedUsers);
              for (const chosedUsersKey in chosedUsers) {
                options +=
                  `<option value="${chosedUsersKey}" id="sendToServer" selected>${chosedUsers[chosedUsersKey]}</option>`;
              }
              document.querySelector(".checking").innerHTML = options;
              if (Object.keys(chosedUsers).length === 0) {
                document.querySelector(".checking").innerHTML = "";
              }
            })
            document.querySelector("#search").addEventListener("input", e => {
              document.querySelectorAll("#searchable").forEach(element => {
                if (
                  !element.textContent.toLowerCase().includes(e.target.value
                    .toLowerCase())
                ) {
                  element.style = "display:none";
                } else {
                  element.style = "display:block";
                }
              });
            });
            document.querySelector("#selectAll").addEventListener("click", e => {
              e.preventDefault();
              let options = "";
              document.querySelector(".checking").innerHTML = "";
              document.querySelectorAll("#searchable").forEach(elem => {
                elem.selected = true;
                let id = elem.value;
                chosedUsers[elem.value] = elem.innerHTML;
                options += `<option value="${id}" id="sendToServer" selected>${elem.textContent}</option>`;
              })
              document.querySelector('.checking').innerHTML = options;
            })
            document.querySelector('#deleteAll').addEventListener('click', e => {
              e.preventDefault();
              chosedUsers = {};
              document.querySelector('.checking').innerHTML = "";
              document.querySelectorAll('#searchable').forEach(el => el.selected = false)
           })
          </script>
        </form>
      </div>
    </div>
  </div>
@endsection