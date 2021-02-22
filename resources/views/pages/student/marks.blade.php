@extends('layouts.profile')

@section('title')Профиль ученика @endsection

@section('content')
    <link rel="stylesheet" href="{{ asset('css/forms.css') }}">
    <link rel="stylesheet" href="{{ asset('css/utils.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
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
            <input type="hidden" id="e_id" value="{{$id}}">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="/profile/" aria-current="page">Мои группы</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/profile/settings">Персональные данные</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://vk.com/1ommy" tabindex="-1" target="_blank">Сообщить о
                                                                                                      проблеме
                                                                                                      разработчику</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/logout" tabindex="-1">Выйти из аккаунта</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-2 table-responsive" style="padding:10px">
        <div class="dashboard text-center">
            <div class="m-2">
                <a onclick="history.back()" class="btn-sm btn-warning"
                   style="color:white;border:1px solid #eee;padding-left:20px;padding-right:20px"> <i
                            style="cursor: pointer" class="fa fa-arrow-left"
                            aria-hidden="true"></i>Назад</a></div>
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
                    <input type="date" id="finish" value="{{ isset($finish) ? $finish : date("Y-m-d") }}"
                           name="day_finish"
                           style="width:150px">
                </div>
                <div class="form__submit">
                    <button type="submit" class="btn btn-data text-center mt-2">Получить данные</button>
                </div>
                @if(session("message"))
                    <h1>{{session("message")}}</h1>
                @endif
                @if(Auth::user()->role_id != 1)
                    <div class="mt-2">
                        <a id="clear" href="{{$id}}/clear" class="text-center btn btn-data">Удалить все оценки</a>
                    </div>
                @endif
            </form>
        </div>
        <script>
          const element = document.querySelector("#clear");
          element.addEventListener("click", (e) => {
            e.preventDefault();
            if (confirm("Вы точно хотите удалить оценки?")) {
              fetch("/profile/marks/{{$id}}/clear");
              window.location.reload();
            }
          })
        </script>
        <canvas id="canvas" style="display:block;width: 400px; height: 400px"></canvas>
        <canvas id="canvas2" style="display:block;width: 400px; height: 400px"></canvas>
        <script>

          async function createChart(url = "api/{{$id}}", options = {}) {
            const response = await fetch(url, options);
            const result = await response.json();

            document.querySelector("#start").value = result["start"];
            document.querySelector("#finish").value = result["finish"];
            const marks = result["marks"];
            const sumMarks = result["summary_marks"];
            const chart2options = [];
            const marksInfo = [];
            const studentsInfo = [];

            function generateColor() {
              return `rgba(${Math.round(Math.random() * (255))},${Math.round(Math.random() * (255))},${Math.round(Math.random() * (255))},1)`
            }

            function generateColorForBar() {
              return `rgb(${Math.round(Math.random() * (255))},${Math.round(Math.random() * (255))},${Math.round(Math.random() * (255))})`
            }

            for (const key in marks) {
              marksInfo.push({
                data: marks[key].marks,
                label: marks[key].name,
                type: "line",
                borderColor: generateColor(),
                borderWidth: 4,
                fill: false,

              });
            }

            const canvas = document.getElementById("canvas").getContext("2d");
            const canvas2 = document.getElementById("canvas2").getContext("2d");
            const chart = new Chart(canvas, {
              type: 'line',
              data: {
                labels: result.dates,
                datasets: [...marksInfo]
              },
              options: {
                scales: {
                  yAxes: [{
                    ticks: {
                      beginAtZero: true
                    }
                  }]
                },
                hover: true
              }
            })
            const labels = sumMarks.map(el => `${el.name}: ${el.sum}`);

            let d2 = [];
            for (const key in sumMarks) {

              let data = Array(labels.length).fill(0);
              data[labels.indexOf(`${sumMarks[key].name}: ${sumMarks[key].sum}`)] = sumMarks[key].sum;
              d2.push({
                label: `Оценка: ${sumMarks[key].name}`,
                data: data,
                backgroundColor: sumMarks.map(el => generateColorForBar()),
              })
            }
            /*sumMarks.map((el) => {
              d2.push( {
                label: `Оценка: ${el.name}`,
                data: [el.sum],
                backgroundColor: sumMarks.map(el => generateColorForBar()),
              })
            })*/
            console.log(d2);
            const chart2 = new Chart(canvas2, {
              type: 'bar',
              data: {
                labels: labels,
                datasets: d2
              },
              options: {
                scales: {
                  yAxes: [{
                    ticks: {
                      beginAtZero: true
                    }
                  }]
                },
                hover: true
              }
            })

          }

          createChart();

          document.querySelector("form").addEventListener("submit", e => {
            e.preventDefault();
            createChart("api/{{$id}}", {
              method: "POST",
              body: JSON.stringify({
                start: document.querySelector("#start").value,
                finish: document.querySelector("#finish").value,
              })
            })
          })
        </script>
    </div>
@endsection

