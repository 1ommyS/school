@extends("layouts.profile")

@section("title") Итоговая аналитика @endsection

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
            class="nav-link active dropdown-toggle nav-item"
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
            class="nav-link dropdown-toggle nav-item"
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
            class="nav-link dropdown-toggle nav-item"
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
  <div class="dashboard">
    <div class="dashboard__amounts" style="border:1px solid #eee; padding:25px; border-radius:7px; margin-top:2px;">
      <h4 class="text-center">Сводная таблица</h4>
      <div class="dashboard__params mb-5" style="text-align: center">
        <form method="POST" class="form">
          @csrf
          <div class="form-control">
            <label for="start">С какого дня: </label>
            <input type="date" id="start" value="{{ isset($start) ? $start : date("Y-m-d") }}" name="day_start"
                   style="width:150px">
          </div>
          <br>
          <div class="form-control">
            <label for="finish">По какой день: </label>
            <input type="date" id="finish" value="{{ isset($finish) ? $finish : date("Y-m-d") }}" name="day_finish"
                   style="width:150px">
          </div>
          <div class="form__submit">
            <button type="submit" class="btn btn-data text-center mt-2">Получить данные</button>
            <a href="/profile/setpercent" class="btn btn-data text-center mt-2">Установить банковский процент
            </a>
          </div>
        </form>
      </div>
      @if(!isset($show))
        <div class="accordion" id="accordionExample">
          <div class="container-fluid table-responsive">
            @if (!empty($information))
              @foreach($information as $index => $info)
                <div class="card mt-3">
                  <div class="card-header" id="acc{{ $index }}">

                    <button
                      class="btn btn-link"
                      type="button"
                      data-mdb-toggle="collapse"
                      data-mdb-target="#accounting{{ $index }}"
                      aria-expanded="false"
                      aria-controls="collapseExample"
                    >
                      {{ $index + 1 }} неделя ( {{ implode(".",array_reverse(explode("-",$weeks[$index]['start'])))}}
                                       - {{ implode(".",array_reverse(explode("-",$weeks[$index]['end']))) }})
                    </button>
                  </div>
                  <div id="accounting{{ $index }}" class="collapse" aria-labelledby="{{ $index }}"
                       data-parent="#accordionExample">
                    <div class="card-body table-responsive">
                      <table class="table table-striped table-bordered text-center">
                        <thead class="table-dark">
                        <th>Выручка</th>
                        <th>Банковский процент</th>
                        <th>Выручка с учетом банковского процента</th>
                        <th>Оплата ЗП</th>
                        <th>Оплата премий</th>
                        <th>Оплата ЗП с учетом премий</th>
                        <th>Дополнительные затраты</th>
                        <th>Прибыль</th>
                        </thead>
                        <tbody>
                        <tr>
                          <td>{{ $info['revenue'] }}</td>
                          <td id="accHM{{ $index + 1 }}">{{ $info['percent'] }}</td>
                          <td id="accVD{{ $index + 1 }}">{{ $info['revenue_with_percent'] }}</td>
                          <td id="accAL{{ $index + 1 }}">{{ $info['wages'] }}</td>
                          <td id="accRV{{ $index + 1 }}">{{ $info['premiums'] }}</td>
                          <td id="accPrem{{ $index + 1 }}">{{ $info['wages_with_premiums'] }}</td>
                          <td id="accFinals{{ $index + 1 }}">{{ $info['other_payments'] }}</td>
                          <td id="accFinals{{ $index + 1 }}">{{ $info['income'] }}</td>
                        </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              @endforeach
              <div class="card mt-3">
                <div class="card-header" id="acc{{ $index+132 }}">
                  <button
                    class="btn btn-link"
                    type="button"
                    data-mdb-toggle="collapse"
                    data-mdb-target="#accounting{{ $index+132 }}"
                    aria-expanded="false"
                    aria-controls="collapseExample"
                  >
                    Период ( {{ implode(".",array_reverse(explode("-",$weeks[0]['start'])))}}
                    - {{ implode(".",array_reverse(explode("-",$weeks[count($weeks)-1]['end']))) }})
                  </button>

                </div>
                <div id="accounting{{ $index+132 }}" class="collapse" aria-labelledby="{{ $index+132 }}">
                  <div class="card-body table-responsive">
                    <table class="table border table-striped table-bordered table-hover text-center">
                      <thead class="table-dark">
                      <th>Выручка</th>
                      <th>Банковский процент</th>
                      <th>Выручка с учетом банковского процента</th>
                      <th>Оплата ЗП</th>
                      <th>Оплата премий</th>
                      <th>Оплата ЗП с учетом премий</th>
                      <th>Дополнительные затраты</th>
                      <th>Прибыль</th>
                      </thead>
                      <tbody>
                      <tr>
                        <td>{{ $period['revenue'] }}</td>
                        <td id="accHM{{ $index + 1 }}">{{ $period['percent'] }}</td>
                        <td id="accVD{{ $index + 1 }}">{{ $period['revenue_with_percent'] }}</td>
                        <td id="accAL{{ $index + 1 }}">{{ $period['wages'] }}</td>
                        <td id="accRV{{ $index + 1 }}">{{ $period['premiums'] }}</td>
                        <td id="accPrem{{ $index + 1 }}">{{ $period['wages_with_premiums'] }}</td>
                        <td id="accFinals{{ $index + 1 }}">{{ $period['other_payments'] }}</td>
                        <td id="accFinals{{ $index + 1 }}">{{ $period['income'] }}</td>
                      </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            @endif
          </div>
        </div>
      @endisset
    </div>
  </div>
@endsection