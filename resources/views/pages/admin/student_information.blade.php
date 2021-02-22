@extends("layouts.profile")@section("title") Учителя @endsection<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"        crossorigin="anonymous"></script>@section('content')  <link rel="stylesheet" href="{{ asset('css/forms.css') }}">  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">    <span class="navbar-brand ">С возвращением, <br> {{ Auth::user() ->login}}</span>    <button      class="navbar-toggler"      type="button"      data-mdb-toggle="collapse"      data-mdb-target="#navbarSupportedContent"      aria-controls="navbarSupportedContent"      aria-expanded="false"      aria-label="Toggle navigation"    >      <i class="fas fa-bars"></i>    </button>    <div class="collapse navbar-collapse" id="navbarSupportedContent">      <div class="navbar-nav">        <li class="nav-item dropdown">          <a            class="nav-link  dropdown-toggle nav-item"            href="#"            id="analytic"            role="button"            data-mdb-toggle="dropdown"            aria-expanded="false"          >            Аналитика          </a>          <!-- Dropdown menu -->          <ul class="dropdown-menu" aria-labelledby="analytic">            <li>              <a href="/profile/auxil" class="dropdown-item">Дополнительные расходы</a>            </li>            <li>              <a href="/profile" class="dropdown-item">Аналитика (преподаватели)</a>            </li>            <li>              <a href="/profile/all" class="dropdown-item">Аналитика (месяц)</a>            </li>            <li>              <a href="/profile/period" class="dropdown-item">Аналитика (период)</a>            </li>          </ul>        </li>        <li class="nav-item dropdown">          <a            class="nav-link active dropdown-toggle nav-item"            href="#"            id="infrastructure"            role="button"            data-mdb-toggle="dropdown"            aria-expanded="false"          >            Структура организации          </a>          <!-- Dropdown menu -->          <ul class="dropdown-menu" aria-labelledby="infrastructure">            <li>              <a href="/profile/teachers" class="dropdown-item">Учителя</a>            </li>            <li>              <a href="/profile/students" class="dropdown-item">Ученики</a>            </li>            <li>              <a href="/profile/birthdays" class="dropdown-item">Дни рождения</a>            </li>            <li>              <a href="/profile/groups" class="dropdown-item">Группы</a>            </li>          </ul>        </li>        <li class="nav-item dropdown">          <a            class="nav-link dropdown-toggle nav-item"            href="#"            id="others"            role="button"            data-mdb-toggle="dropdown"            aria-expanded="false"          >            Дополнительно          </a>          <!-- Dropdown menu -->          <ul class="dropdown-menu" aria-labelledby="others">            <li>              <a href="/profile/sending" class="dropdown-item">Рассылка</a>            </li>            <li>              <a href="/profile/settings" class="dropdown-item">Персональные данные</a>            </li>            <li>              <a href="/profile/logs" class="dropdown-item ">Логи</a>            </li>            <li>              <a href="/panel" class="dropdown-item ">Админ панель</a>            </li>          </ul>        </li>        <a href="/logout" class="nav-item nav-link" tabindex="-1">Выйти из аккаунта</a>      </div>    </div>  </nav>  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.jqueryui.min.css" /> <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>  <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/dataTables.jqueryui.min.js"></script>  <script>    $(document).ready(function () {      $('#myTable').DataTable();    });    $(document).ready(function () {      $('#myTable1').DataTable();    });  </script>  <div class="container">    <div class="wrapper m-5 table-responsive ">      <table class="table table-striped table-bordered table-hover mt-2" style="padding:30px; border:1px solid #ccc; border-radius:7px">        <thead class="table-dark">        <th>Графа</th>        <th>Значение</th>        </thead>        <tbody>        <tr>          <td style="border:1px solid #ccc;border-radius: 7px;">Номер аккаунта</td>          <td style="border:1px solid #ccc;border-radius: 7px;">{{ $information['information']->id }}</td>        </tr>        <tr>          <td style="border:1px solid #ccc;border-radius: 7px;">Логин</td>          <td style="border:1px solid #ccc;border-radius: 7px;">{{ $information['information']->login }}</td>        </tr>        <tr>          <td style="border:1px solid #ccc;border-radius: 7px;">Имя ученика</td>          <td style="border:1px solid #ccc;border-radius: 7px;">{{ $information['information']->name }}</td>        </tr>        <tr>          <td style="border:1px solid #ccc;border-radius: 7px;">Номер телефона</td>          <td style="border:1px solid #ccc;border-radius: 7px;">{{ $information['information']->phone_student }}</td>        </tr>        <tr>          <td style="border:1px solid #ccc;border-radius: 7px;">Страница ВК</td>          <td style="border:1px solid #ccc;border-radius: 7px;">{{ $information['information']->link_vk }}</td>        </tr>        <tr>          <td style="border:1px solid #ccc;border-radius: 7px;">ФИО Родителя</td>          <td style="border:1px solid #ccc;border-radius: 7px;">{{ $information['information']->name_parent }}</td>        </tr>        <tr>          <td style="border:1px solid #ccc;border-radius: 7px;">Телефон Родителя</td>          <td style="border:1px solid #ccc;border-radius: 7px;">{{ $information['information']->phone_parent }}</td>        </tr>        <tr>          <td style="border:1px solid #ccc;border-radius: 7px;">День рождения</td>          <td            style="border:1px solid #ccc;border-radius: 7px;">{{ date('d.m.Y',strtotime($information['information']->birthday)) }}</td>        </tr>        <tr>          <td style="border:1px solid #ccc;border-radius: 7px;">Город</td>          <td style="border:1px solid #ccc;border-radius: 7px;">{{ $information['information']->city }}</td>        </tr>        <tr>          <td style="border:1px solid #ccc;border-radius: 7px;">Возраст</td>          <td style="border:1px solid #ccc;border-radius: 7px;">{{ $ages[$information['information']->age] }}</td>        </tr>        <tr>          <td style="border:1px solid #ccc;border-radius: 7px;">Выпускался ли из какой-то группы</td>          <td            style="border:1px solid #ccc;border-radius: 7px;">{{ $information['information']->finished == 1 ? "Да": "Нет" }}</td>        </tr>        </tbody>      </table>      <hr>      <p>Транзакции</p>      <hr>      <table id="myTable" class="table table-hover table-striped table-bordered table-sm">        <thead class="table-dark">        <tr>          <th scope="col">Группа</th>          <th scope="col">Дата перевода</th>          <th scope="col">Сумма перевода</th>          <th scope="col">Кол-во занятий</th>          <th scope="col">Кол-во бонусных занятий</th>        </tr>        </thead>        <tbody>        @foreach($information['transactions'] as $info)          <tr>            <td>{{ $info->group_name }}</td>            <td>{{ date("d.m.Y",strtotime($info->date_transaction)) }}</td>            <td>{{ $info->sum_transaction }}</td>            <td>{{ $info->count_lessons }}</td>            <td>{{ $info->count_bonus_lessons }}</td>          </tr>        @endforeach        </tbody>      </table>      <hr>      <p>Уроки</p>      <hr>      <table id="myTable1" class="table table-hover table-striped table-bordered table-sm">        <thead class="table-dark">       <tr>          <th scope="col">Группа</th>          <th scope="col">Дата</th>          <th scope="col">Тема урока</th>          <th scope="col">Домашнее Задание</th>          <th scope="col">Формат посещения</th>          <th scope="col">Стоимость занятия</th>        </tr>        </thead>        <tbody>        @foreach($information['lessons'] as $info)          <tr>            <td>{{ $info->group_name }}</td>            <td>{{ date("d.m.Y",strtotime($info->date)) }}</td>            <td>{{ $info->lesson_theme }}</td>            <td>{{ $info->homework }}</td>            <td>{{ $formats[$info->payment_status] }}</td>            <td>{{ $info->lesson_cost }}</td>         </tr>        @endforeach        </tbody>      </table>    </div>  </div>@endsection