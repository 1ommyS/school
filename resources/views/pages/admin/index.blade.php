@extends("layouts.profile")@section("title") Выручка @endsection@section('content')  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">    <span class="navbar-brand ">С возвращением, <br> {{ Auth::user() ->login}}</span>    <button      class="navbar-toggler"      type="button"      data-mdb-toggle="collapse"      data-mdb-target="#navbarSupportedContent"      aria-controls="navbarSupportedContent"      aria-expanded="false"      aria-label="Toggle navigation"    >      <i class="fas fa-bars"></i>    </button>    <div class="collapse navbar-collapse" id="navbarSupportedContent">      <div class="navbar-nav">        <li class="nav-item dropdown">          <a            class="nav-link active dropdown-toggle nav-item"            href="#"            id="analytic"            role="button"            data-mdb-toggle="dropdown"            aria-expanded="false"          >            Аналитика          </a>          <!-- Dropdown menu -->          <ul class="dropdown-menu" aria-labelledby="analytic">            <li>              <a href="/profile/auxil" class="dropdown-item">Дополнительные расходы</a>            </li>            <li>              <a href="/profile" class="dropdown-item">Аналитика (преподаватели)</a>            </li>            <li>              <a href="/profile/all" class="dropdown-item">Аналитика (месяц)</a>            </li>            <li>              <a href="/profile/period" class="dropdown-item">Аналитика (период)</a>            </li>          </ul>        </li>        <li class="nav-item dropdown">          <a            class="nav-link dropdown-toggle nav-item"            href="#"            id="infrastructure"            role="button"            data-mdb-toggle="dropdown"            aria-expanded="false"          >            Структура организации          </a>          <!-- Dropdown menu -->          <ul class="dropdown-menu" aria-labelledby="infrastructure">            <li>              <a href="/profile/teachers" class="dropdown-item">Учителя</a>            </li>            <li>              <a href="/profile/students" class="dropdown-item">Ученики</a>            </li>            <li>              <a href="/profile/birthdays" class="dropdown-item">Дни рождения</a>            </li>            <li>              <a href="/profile/groups" class="dropdown-item">Группы</a>            </li>          </ul>        </li>        <li class="nav-item dropdown">          <a            class="nav-link dropdown-toggle nav-item"            href="#"            id="others"            role="button"            data-mdb-toggle="dropdown"            aria-expanded="false"          >            Дополнительно          </a>          <!-- Dropdown menu -->          <ul class="dropdown-menu" aria-labelledby="others">            <li>              <a href="/profile/sending" class="dropdown-item">Рассылка</a>            </li>            <li>              <a href="/profile/settings" class="dropdown-item">Персональные данные</a>            </li>            <li>              <a href="/profile/logs" class="dropdown-item ">Логи</a>            </li>            <li>              <a href="/panel" class="dropdown-item ">Админ панель</a>            </li>          </ul>        </li>        <a href="/logout" class="nav-item nav-link" tabindex="-1">Выйти из аккаунта</a>      </div>    </div>  </nav>  <div class="dashboard table-responsive">    <div class="dashboard__amounts" style="border:1px solid #eee; padding:25px; border-radius:7px; margin-top:2px;">      <h4 class="text-center">Сводная таблица</h4>      <div class="dashboard__params mb-5" style="text-align: center">       <input type="hidden" id="month" value="{{ $month  }}">        <input type="hidden" id="year" value="{{$year}}">        <input type="hidden" id="weeks" value="{{count($weeks)-1}}">        <form method="POST" class="form">          @csrf        {{--month and year selecting--}}          <select name="month" style="width:150px">            <option value="0" id="#month">Месяц            </option>            <option value="01" id="#month">Январь</option>            <option value="02" id="#month">Февраль</option>            <option value="03" id="#month">Март</option>            <option value="04" id="#month">Апрель</option>            <option value="05" id="#month">Май</option>            <option value="06" id="#month">Июнь</option>            <option value="07" id="#month">Июль</option>            <option value="08" id="#month">Август</option>            <option value="09" id="#month">Сентябрь</option>            <option value="10" id="#month">Октябрь</option>            <option value="11" id="#month">Ноябрь</option>            <option value="12" id="#month">Декабрь</option>          </select>          <select name="year" id="">            <option value="">Год</option>            <option value="2020" id="year">2020</option>            <option value="2021" id="year">2021</option>            <option value="2021" id="year">2022</option>            <option value="2021" id="year">2023</option>            <option value="2021" id="year">2024</option>            <option value="2021" id="year">2025</option>          </select>          <div class="form__submit">            <button type="submit" class="btn btn-data text-center mt-2">Получить данные</button>          </div>        </form>      </div>      <script>        const selectedMonth = document.querySelector("#month");        if (!selectedMonth) {          let month = new Date().getMonth() + 1;          document.querySelector(`option[value="${month}"]`).setAttribute("selected", true);          let year = new Date().getFullYear();          document.querySelector(`option[value="${year}"]`).setAttribute("selected", true);        } else {          let month = selectedMonth.value;          document.querySelector(`option[value="${month}"]`).setAttribute("selected", true);          let year = document.querySelector("#year").value;          document.querySelector(`option[value="${year}"]`).setAttribute("selected", true);        }      </script>      {{--аналитика--}}      <div class="accordion" id="accordionExample">        <div class="container-fluid">          @foreach($information as $index => $info)            <div class="card mt-3">              <div class="card-header border" id="acc{{ $index }}">                <button                  class="btn btn-link"                  type="button"                  data-mdb-toggle="collapse"                  data-mdb-target="#accounting{{ $index }}"                  aria-expanded="false"                  aria-controls="collapseExample"                >                  {{ $index + 1 }} неделя ( {{ implode(".",array_reverse(explode("-",$weeks[$index]['start']))) }}                                   - {{ implode(".",array_reverse(explode("-",$weeks[$index]['end']))) }})                </button>              </div>              <div id="accounting{{ $index }}" class="collapse" aria-labelledby="{{ $index }}"                   data-parent="#accordionExample">                <div class="card-body table-responsive">                  <table class="table table-striped table-hover table-bordered text-center">                    <thead class="table-dark">                    <th>Имя преподавателя / название поля</th>                    <th>Учеников выполняло ДЗ</th>                    <th>Учеников не выполняло ДЗ</th>                    <th>Учеников смотрело видео</th>                    <th>Всего учеников (по факту)</th>                    <th>Выручка</th>                    <th>Зарплата</th>                    <th>Премия</th>                    <th>ЗП + премия</th>                    <th>Прибыль</th>                    </thead>                    <tbody>                    @foreach($info as $teacher_row)                      <tr>                        <td>{{ $teacher_row['name'] }}</td>                        <td id="accHM{{ $index + 1 }}">{{ $teacher_row['home'] ?? 0  }}</td>                        <td id="accWHM{{ $index + 1 }}">{{ $teacher_row['without_home'] ?? 0  }}</td>                        <td id="accVD{{ $index + 1 }}">{{ $teacher_row['video'] ?? 0  }}</td>                        <td id="accAL{{ $index + 1 }}">{{ $teacher_row['all'] ?? 0  }}</td>                        <td id="accRV{{ $index + 1 }}">{{ $teacher_row['revenue'] ?? 0 }}</td>                        <td id="accWG{{ $index + 1 }}">{{ $teacher_row['wages'] ?? 0  }}</td>                        <td id="accPrem{{ $index + 1 }}">{{ $teacher_row['premiums'] ?? 0 }}</td>                        <td id="accFinals{{ $index + 1 }}">{{ $teacher_row['premiums_with_wages'] ?? 0  }}</td>                        <td id="accPribil{{ $index + 1 }}">{{ $teacher_row['pribil'] ?? 0  }}</td>                      </tr>                    @endforeach                    <tr>                      <td>Всего</td>                      <td id="allHM{{ $index + 1 }}">0</td>                      <td id="allWHM{{ $index + 1 }}">0</td>                      <td id="allVD{{ $index + 1 }}">0</td>                      <td id="allAL{{ $index + 1 }}">0</td>                      <td id="allRV{{ $index + 1 }}">0</td>                      <td id="allWG{{ $index + 1 }}">0</td>                      <td id="allPrem{{ $index + 1 }}">0</td>                      <td id="allFinals{{ $index + 1 }}">0</td>                      <td id="allPribil{{ $index + 1 }}">0</td>                    </tr>                    </tbody>                  </table>                </div>              </div>            </div>          @endforeach          <script src="{{ asset("public/js/analytic/indexPage/general.plugin.js") }}"></script>          {{--месяц--}}          <div class="card mt-3">            <div class="card-header" id="acc{{ count($weeks) }}">              <button                class="btn btn-link"                type="button"                data-mdb-toggle="collapse"                data-mdb-target="#accounting{{ count($weeks) }}"                aria-expanded="false"                aria-controls="collapseExample"              >                Месяц ({{ implode(".",array_reverse(explode("-",$weeks[0]['start']))) }}                - {{ implode(".",array_reverse(explode("-",$weeks[count($weeks)-1]['end']))) }})              </button>            </div>            <div id="accounting{{ count($weeks) }}" class="collapse" aria-labelledby="{{ count($weeks) }}"                 data-parent="#accordionExample">              <div class="card-body table-responsive"  >                <table class="table table-striped table-hover table-bordered text-center">                  <thead class="table-dark">                 <th>Имя преподавателя / название поля</th>                  <th>Учеников выполняло ДЗ</th>                  <th>Учеников не выполняло ДЗ</th>                  <th>Учеников смотрело видео</th>                  <th>Всего учеников (по факту)</th>                  <th>Выручка</th>                  <th>Зарплата</th>                  <th>Премия</th>                  <th>ЗП + премия</th>                  <th>Прибыль</th>                  </thead>                  <tbody>                  @foreach($information_on_the_month as $month_info)                    <tr>                      <td >{{ $month_info['name'] }}</td>                      <td id="hw{{ $index + 1 }}">{{ $month_info['home'] ?? 0  }}</td>                      <td id="whw{{ $index + 1 }}">{{ $month_info['without_home'] ?? 0  }}</td>                      <td id="vd{{ $index + 1 }}">{{ $month_info['video'] ?? 0  }}</td>                      <td id="al{{ $index + 1 }}">{{ $month_info['all'] ?? 0  }}</td>                      <td id="rv{{ $index + 1 }}">{{ $month_info['revenue'] ?? 0  }}</td>                      <td id="wg{{ $index + 1 }}">{{ $month_info['wages'] ?? 0  }}</td>                      <td id="prem{{ $index + 1 }}">{{ $month_info['premiums'] ?? 0  }}</td>                      <td id="fin{{ $index + 1 }}">{{ $month_info ['premiums_with_wages'] ?? 0  }}</td>                      <td id="prib{{ $index + 1 }}">{{ $month_info['pribil'] ?? 0  }}</td>                    </tr>                  @endforeach                  <tr>                    <td>Итого</td>                    <td id="HW{{ $index + 1 }}">0</td>                    <td id="WHW{{ $index + 1 }}">0</td>                    <td id="VD{{ $index + 1 }}">0</td>                    <td id="AL{{ $index + 1 }}">0</td>                    <td id="RV{{ $index + 1 }}">0</td>                    <td id="WG{{ $index + 1 }}">0</td>                    <td id="PREM{{ $index + 1 }}">0</td>                    <td id="FIN{{ $index + 1 }}">0</td>                    <td id="PRIB{{ $index + 1 }}">0</td>                  </tr>                  </tbody>                  <script src="{{ asset("public/js/analytic/indexPage/month.plugin.js") }}"></script>                </table>              </div>            </div>          </div>          {{--групповая--}}          <div class="dashboard__information">            <h1 class="text-center m-4">Аналитика по Преподавателям</h1>            @empty($groups)              <h6 class="text-center">Занятий ещё не было</h6>            @endempty            @foreach ( $groups  as $teacher_name => $group )              <div class="information__teacher mb-5">                <h2 class="text-center m-3"> {{ $teacher_name }}| {{ count($group) }} группа(ы)</h2>                <div class="container">                  <div class="accordion " id="accordionExample">                    @foreach($group as $i => $group_info)                      <div class="card mb-5">                        <div class="card-header" id="heading:_fatw{{ $i}}sa{{$i*3}}>">                          <button                            class="btn btn-link"                            type="button"                            data-mdb-toggle="collapse"                            data-mdb-target="#{{ $group_info["age"] }}{{ $group_info["year"]+$group_info["amount"] }}"                            aria-expanded="false"                            aria-controls="collapseExample"                          >                            {{$group_info['name_group']}} | {{$group_info['year']}} год обучения                          </button>                        </div>                        <div                          id="{{ $group_info["age"] }}{{ $group_info["year"]+$group_info["amount"] }}"                          class="collapse mb-5"                          aria-labelledby="heading:_fatw{{$i }}sa{{$i*3 }}>"                          data-parent="#accordionExample">                          <div class="card-body table-responsive">                            <table class="table table-hover table-striped  table-bordered table-hover">                              <thead class="table-dark">                              <th>Название графы</th>                              <th>Значение</th>                              </thead>                              <tbody>                              <tr>                                <td>Количество учеников в группе</td>                                <td>{{$group_info['amount'] }}</td>                              </tr>                              <tr>                                <td>Возраст учеников</td>                                <td>{{$group_info['age'] }}</td>                              </tr>                              </tbody>                            </table>                            @foreach ( $group_info['weeks'] as $index => $info )                              <div class="accordion" id="accordionExample">                                <div id="accounting{{$index}}" class="collapse show" aria-labelledby="acc{{$index}}"                                     data-parent="#accordionExample">                                  <div class="card mt-2">                                    <div class="card-header" id="age:{{$index}}/dafc::{{$index}}">                                      <button                                        class="btn btn-link"                                        type="button"                                        data-mdb-toggle="collapse"                                        data-mdb-target="#{{ strtolower(str_replace(" ", "_c", str_replace("#", "cs", $group_info['name_group']))) }}fsa{{ $index }}_{{$i}}"                                        aria-expanded="false"                                        aria-controls="collapseExample"                                      >                                        {{$index+1}} неделя                                                     ( {{ implode(".",array_reverse(explode("-",$weeks[$index]['start'])))}}                                                     - {{ implode(".",array_reverse(explode("-",$weeks[$index]['end']))) }}                                                     )                                      </button>                                    </div>                                    <div                                      id="{{ strtolower(str_replace(" ", "_c", str_replace("#", "cs", $group_info['name_group']))) }}fsa{{ $index }}_{{$i}}"                                      class="collapse"                                      aria-labelledby="age:{{$index}}/dafc::{{$index}}"                                      data-parent="#accordionExample">                                      <div class="card-body table-responsive">                                        <table class="table table-striped table-hover table-bordered text-center">                                          <thead class="table-dark">                                          <th>Название графы                                          </th>                                          <th>Значение</th>                                          </thead>                                          <tbody>                                          <tr>                                            <td>Количество учеников, смотревших видео:</td>                                            <td>{{ $info['video'] }}</td>                                          </tr>                                          <tr>                                            <td>Количество учеников, выполняющих ДЗ:</td>                                            <td>{{ $info['home'] }}</td>                                          </tr>                                          <tr>                                            <td>Количество учеников, не выполняющих ДЗ:</td>                                            <td>{{ $info['no_home'] }}</td>                                          </tr>                                          <tr>                                            <td>Выручка:</td>                                            <td>{{ $info['revenue'] }}</td>                                          </tr>                                          <tr>                                            <td>Зарплата:</td>                                            <td>{{ $info['wages'] }}</td>                                          </tr>                                          </tbody>                                        </table>                                      </div>                                    </div>                                  </div>                                </div>                              </div>                            @endforeach                          </div>                        </div>                      </div>                    @endforeach                  </div>                </div>              </div>            @endforeach            </div>        </div>@endsection