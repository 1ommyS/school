@extends("layouts.profile")@section("title") Доп.платежи @endsection@section('content')    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">        <span class="navbar-brand ">С возвращением, <br> {{ Auth::user() ->login}}</span>        <button          class="navbar-toggler"          type="button"          data-mdb-toggle="collapse"          data-mdb-target="#navbarSupportedContent"          aria-controls="navbarSupportedContent"          aria-expanded="false"          aria-label="Toggle navigation"        >            <i class="fas fa-bars"></i>        </button>        <div class="collapse navbar-collapse" id="navbarSupportedContent">            <div class="navbar-nav">                <li class="nav-item dropdown">                    <a                      class="nav-link active dropdown-toggle nav-item"                      href="#"                      id="analytic"                      role="button"                      data-mdb-toggle="dropdown"                      aria-expanded="false"                    >                        Аналитика                    </a>                    <!-- Dropdown menu -->                    <ul class="dropdown-menu" aria-labelledby="analytic">                        <li>                            <a href="/profile/auxil" class="dropdown-item">Дополнительные расходы</a>                        </li>                        <li>                            <a href="/profile" class="dropdown-item">Аналитика (преподаватели)</a>                        </li>                        <li>                            <a href="/profile/all" class="dropdown-item">Аналитика (месяц)</a>                        </li>                        <li>                            <a href="/profile/period" class="dropdown-item">Аналитика (период)</a>                        </li>                    </ul>                </li>                <li class="nav-item dropdown">                    <a                      class="nav-link dropdown-toggle nav-item"                      href="#"                      id="infrastructure"                      role="button"                      data-mdb-toggle="dropdown"                      aria-expanded="false"                    >                        Структура организации                    </a>                    <!-- Dropdown menu -->                    <ul class="dropdown-menu" aria-labelledby="infrastructure">                        <li>                            <a href="/profile/teachers" class="dropdown-item">Учителя</a>                        </li>                        <li>                            <a href="/profile/students" class="dropdown-item">Ученики</a>                        </li>                        <li>                            <a href="/profile/birthdays" class="dropdown-item">Дни рождения</a>                        </li>                        <li>                            <a href="/profile/groups" class="dropdown-item">Группы</a>                        </li>                    </ul>                </li>                <li class="nav-item dropdown">                    <a                      class="nav-link dropdown-toggle nav-item"                      href="#"                      id="others"                      role="button"                      data-mdb-toggle="dropdown"                      aria-expanded="false"                    >                        Дополнительно                    </a>                    <!-- Dropdown menu -->                    <ul class="dropdown-menu" aria-labelledby="others">                        <li>                            <a href="/profile/sending" class="dropdown-item">Рассылка</a>                        </li>                        <li>                            <a href="/profile/settings" class="dropdown-item">Персональные данные</a>                        </li>                        <li>                            <a href="/profile/logs" class="dropdown-item ">Логи</a>                        </li>                        <li>                            <a href="/panel" class="dropdown-item ">Админ панель</a>                        </li>                    </ul>                </li>                <a href="/logout" class="nav-item nav-link" tabindex="-1">Выйти из аккаунта</a>            </div>        </div>    </nav>    <div class="dashboard table-responsive" >        <div class="dashboard__amounts" style="border:1px solid #eee; padding:25px; border-radius:7px; margin-top:2px;">            <h4 class="text-center">Сводная таблица</h4>            <input type="hidden" value="{{count($weeks)}}" id="weeks_number">            <div class="dashboard__params mb-5" style="text-align: center">                <input type="hidden" id="month" value="{{ $month  }}">                <input type="hidden" id="year" value="{{$year}}">                <form method="POST" class="form">                    @csrf                    {{--month and year selecting--}}                    <select name="month" style="width:150px">                        <option value="0" id="#month">Месяц                        </option>                        <option value="01" id="#month">Январь</option>                        <option value="02" id="#month">Февраль</option>                        <option value="03" id="#month">Март</option>                        <option value="04" id="#month">Апрель</option>                        <option value="05" id="#month">Май</option>                        <option value="06" id="#month">Июнь</option>                        <option value="07" id="#month">Июль</option>                        <option value="08" id="#month">Август</option>                        <option value="09" id="#month">Сентябрь</option>                        <option value="10" id="#month">Октябрь</option>                        <option value="11" id="#month">Ноябрь</option>                        <option value="12" id="#month">Декабрь</option>                    </select>                    <select name="year" id="">                        <option value="">Год</option>                        <option value="2020" id="year">2020</option>                        <option value="2021" id="year">2021</option>                        <option value="2021" id="year">2022</option>                        <option value="2021" id="year">2023</option>                        <option value="2021" id="year">2024</option>                        <option value="2021" id="year">2025</option>                    </select>                    <div class="form__submit">                        <button type="submit" class="btn btn-data text-center mt-2">Получить данные                        </button>                        <a href="/profile/addauxil" class="btn btn-data text-center mt-2">Добавить доп.платёж                        </a>                    </div>                </form>                <script>                    const selectedMonth = document.querySelector("#month");                    if (!selectedMonth) {                        let month = new Date().getMonth() + 1;                        document.querySelector(`option[value="${month}"]`).setAttribute("selected", true);                        let year = new Date().getFullYear();                        document.querySelector(`option[value="${year}"]`).setAttribute("selected", true);                    } else {                        let month = selectedMonth.value;                        document.querySelector(`option[value="${month}"]`).setAttribute("selected", true);                        let year = document.querySelector("#year").value;                        document.querySelector(`option[value="${year}"]`).setAttribute("selected", true);                    }                </script>            </div>            <script src="{{ asset("public/js/date.plugin.js") }}"></script>            <div class="accordion table-responsive" id="accordionExample">                <div class="container-fluid">                    @foreach($auxils as $index => $info)                        <div class="card mt-3">                            <div class="card-header" id="acc{{ $index }}">                                <button                                  class="btn btn-link"                                  type="button"                                  data-mdb-toggle="collapse"                                  data-mdb-target="#accounting{{ $index }}"                                  aria-expanded="false"                                  aria-controls="collapseExample"                                >                                    {{ $index + 1 }} неделя                                                     ( {{ implode(".",array_reverse(explode("-",$weeks[$index]['start'])))}}                                                     - {{ implode(".",array_reverse(explode("-",$weeks[$index]['end']))) }}                                                     )                                </button>                            </div>                            <div id="accounting{{ $index }}" class="collapse" aria-labelledby="{{ $index }}"                                 data-parent="#accordionExample">                                <div class="card-body table-responsive">                                    <table class="table table-striped table-hover table-bordered text-center">                                        <thead class="table-dark">                                        <th>Дата</th>                                        <th>Назначение</th>                                        <th>Величина</th>                                        </thead>                                        <tbody>                                        @foreach ($info as $payment)                                            <tr>                                                <td>{{ date("d.m.Y",strtotime($payment->date)) }}</td>                                                <td>{{ $payment->comment }}</td>                                                <td id="WHM{{ $index + 1 }}">{{ $payment->price }}</td>                                            </tr>                                        @endforeach                                        <tr>                                            <td>Всего</td>                                            <td>-</td>                                            <td id="WfinHM{{ $index + 1 }}">0</td>                                        </tr>                                        </tbody>                                    </table>                                </div>                            </div>                        </div>                    @endforeach                    <div class="card mt-3">                        <div class="card-header" id="acc132">                            <div class="card-header" id="acc{{ $index }}">                                <button                                  class="btn btn-link"                                  type="button"                                  data-mdb-toggle="collapse"                                  data-mdb-target="#accounting132"                                  aria-expanded="false"                                  aria-controls="collapseExample"                                >                                    Месяц ( {{ implode(".",array_reverse(explode("-",$weeks[0]['start'])))}}                                    - {{ implode(".",array_reverse(explode("-",$weeks[count($weeks)-1]['end']))) }})                                </button>                            </div>                        </div>                        <div id="accounting132" class="collapse" aria-labelledby="{{ $index }}"                             data-parent="#accordionExample">                            <div class="card-body table-responsive">                                <table class="table table-striped table-hover table-bordered text-center">                                    <thead class="table-dark">                                    <th>Дата</th>                                    <th>Назначение</th>                                    <th>Величина</th>                                    </thead>                                    <tbody>                                    @foreach ($auxils_month as $payment)                                        <tr>                                            <td>{{ date("d.m.Y",strtotime($payment->date)) }}</td>                                            <td>{{ $payment->comment }}</td>                                            <td id="WFHM{{ $index + 1 }}">{{ $payment->price }}</td>                                        </tr>                                    @endforeach                                    <tr>                                        <td>Всего</td>                                        <td>-</td>                                        <td id="WfinFHM{{ $index + 1 }}">0</td>                                    </tr>                                    </tbody>                                </table>                            </div>                        </div>                    </div>                </div>            </div>        </div>        <script>          let j = document.querySelector("#weeks_number").value * 1;          for (let i = 0; i < j; i++) {            const amounts = {              HM: 0,              FHM: 0            };            document.querySelectorAll(`#WHM${i + 1}`).forEach((num) => amounts.HM +=              parseInt(num.textContent));            document.querySelector(`#WfinHM${i + 1}`).textContent = amounts.HM ? amounts              .HM : 0;          }          let fhm = 0;          document.querySelectorAll(`#WFHM${j}`).forEach((num) => fhm +=            parseInt(num.textContent));          document.querySelector(`#WfinFHM${j}`).textContent = fhm ? fhm : 0;        </script>@endsection