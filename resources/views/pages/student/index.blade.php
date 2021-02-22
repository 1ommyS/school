@extends('layouts.profile')@section('title')Профиль ученика @endsection@section('content')  <link rel="stylesheet" href="{{ asset('css/forms.css') }}">  <link rel="stylesheet" href="{{ asset('css/utils.css') }}">  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">    <div class="container-fluid">      <span class="navbar-brand">С возвращением, <br> {{ Auth::user()->login }} </span>      <button        class="navbar-toggler"        type="button"        data-mdb-toggle="collapse"        data-mdb-target="#navbarSupportedContent"        aria-controls="navbarSupportedContent"        aria-expanded="false"        aria-label="Toggle navigation"      >        <i class="fas fa-bars"></i>      </button>      <div class="collapse navbar-collapse" id="navbarSupportedContent">        <ul class="navbar-nav me-auto mb-2 mb-lg-0">          <li class="nav-item">            <a class="nav-link active" href="/profile/" aria-current="page">Мои группы</a>          </li>          <li class="nav-item">            <a class="nav-link" href="/profile/settings">Персональные данные</a>          </li>          <li class="nav-item">            <a class="nav-link"  href="https://vk.com/1ommy" tabindex="-1" target="_blank">Сообщить о проблеме разработчику</a>          </li>          <li class="nav-item">            <a class="nav-link" href="/logout" tabindex="-1">Выйти из аккаунта</a>          </li>        </ul>      </div>    </div>  </nav>  <div class="container mt-2 table-responsive" style="padding:10px">    <table id="selectedColumn" class="table table-hover table-striped table-bordered table-sm" cellspacing="0"           style="border:1px solid #ccc;border-radius:10px !important;padding: 7px">      <thead class="table-dark">      <tr>        <th scope="col" style="border-right: 2px solid #eee;font-weight:bold !important;">Название</th>        <th scope="col" style="border-right: 2px solid #eee;font-weight:bold !important;">Расписание</th>        <th scope="col" style="border-right: 2px solid #eee;font-weight:bold !important;">Год обучения</th>        <th scope="col" style="border-right: 2px solid #eee;font-weight:bold !important;">Количество Бонусных занятий        </th>        <th scope="col" style="border-right: 2px solid #eee;font-weight:bold !important;">Количество занятий</th>        <th scope="col" style="border-right: 2px solid #eee;font-weight:bold !important;">Баланс</th>        <th style="font-weight:bold !important">Пополнение баланса</th>        <th style="font-weight:bold !important">История посещений</th>        <th style="font-weight:bold !important">История оплат</th>        <th style="font-weight:bold !important" scope="col">Оценки</th>      </tr>      </thead>      <tbody>      @foreach($student_groups_information as $group)        <tr>          <td>{{ $group['group']->name_group }}</td>          <td>{{ $group['group']->schedule }}</td>          <td>{{ $group['group']->year }}</td>          <td>{{ $group['bonuses'] }}</td>          <td>{{ round($group['balance'] / 500) }}</td>          <td>{{ $group['balance']  }}</td>          <td>            <a style="color:black" href="{{ route('student.pay', ['id' => $group['group']->id]) }}">              <svg width="25" height="25" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">                <path fill-rule="evenodd" clip-rule="evenodd"                      d="M28.7835 8.34827L25.2451 2.28661C25.0768 1.99827 24.8001 1.78827 24.4768 1.70494C24.1551 1.62494 23.8101 1.67161 23.5235 1.84327L12.7068 8.33327L28.7835 8.34827ZM38.75 19.1665H32.5C29.7433 19.1665 27.5 21.4098 27.5 24.1665C27.5 26.9232 29.7433 29.1665 32.5 29.1665H38.75C39.44 29.1665 40 28.6065 40 27.9165V20.4165C40 19.7265 39.44 19.1665 38.75 19.1665ZM32.5 25.8332C31.58 25.8332 30.8333 25.0865 30.8333 24.1665C30.8333 23.2465 31.58 22.4998 32.5 22.4998C33.42 22.4998 34.1667 23.2465 34.1667 24.1665C34.1667 25.0865 33.42 25.8332 32.5 25.8332ZM3.33333 8.33325C3.33333 9.24992 4.08333 9.99992 5 9.99992H33.3333C35.1667 9.99992 36.6667 11.4999 36.6667 13.3333V16.6666H32.5C28.3667 16.6666 25 20.0333 25 24.1666C25 28.2999 28.3667 31.6666 32.5 31.6666H36.6667V34.9999C36.6667 36.8333 35.1667 38.3333 33.3333 38.3333H5C2.25 38.3333 0 36.0833 0 33.3333V7.91658C0 7.80164 0.0293618 7.69648 0.0580849 7.59361C0.066844 7.56224 0.0755438 7.53108 0.0833333 7.49992C0.483333 5.13325 2.53333 3.33325 5 3.33325H16.1833L10.6167 6.66658H5C4.08333 6.66658 3.33333 7.41658 3.33333 8.33325ZM28.7833 3.36659C30.4167 3.58325 31.6667 4.98325 31.6667 6.66658V8.33325L28.7833 3.36659ZM13 19C12.4477 19 12 19.4477 12 20V23H9C8.44771 23 8 23.4477 8 24C8 24.5523 8.44772 25 9 25H12V28C12 28.5523 12.4477 29 13 29C13.5523 29 14 28.5523 14 28V25H17C17.5523 25 18 24.5523 18 24C18 23.4477 17.5523 23 17 23H14V20C14 19.4477 13.5523 19 13 19Z"                      fill="#333333" />              </svg>            </a>          </td>          <td>            <a style="color:black" href="{{ route('student.history', ['id' => $group['group']->id]) }}">              <svg width="45" height="25" viewBox="0 0 78 38" fill="none" xmlns="http://www.w3.org/2000/svg">                <path fill-rule="evenodd" clip-rule="evenodd"                      d="M22.2771 0.401563C21.8882 0.0753911 21.375 -0.0623042 20.8752 0.0263189L1.41846 3.46187C0.598145 3.60664 0 4.31953 0 5.15254V32.6188C0 33.4519 0.598145 34.1647 1.41846 34.3095L20.8752 37.7431C20.9746 37.7604 21.0742 37.7692 21.1736 37.7692C21.574 37.7692 21.9656 37.6289 22.2771 37.3676C22.666 37.0412 22.8904 36.56 22.8904 36.0524V35.6965V34.3356V32.6188V30.9021V6.8686V5.15181V3.43501V1.71675C22.8904 1.20942 22.666 0.727735 22.2771 0.401563ZM15.5208 21.2434C15.2017 21.5627 14.7585 21.7458 14.3064 21.7458C13.8545 21.7458 13.4126 21.5627 13.092 21.2431C12.7727 20.923 12.5896 20.4812 12.5896 20.029C12.5896 19.5769 12.7727 19.135 13.092 18.8149C13.4126 18.4953 13.8545 18.3122 14.3064 18.3122C14.7585 18.3122 15.2017 18.4953 15.5208 18.8149C15.8401 19.1352 16.0232 19.5769 16.0232 20.029C16.0232 20.4814 15.8401 20.923 15.5208 21.2434ZM29.2544 3.93623C28.9324 3.61445 28.4958 3.43355 28.04 3.43355L26.3237 3.43403V5.15083V6.86763V30.9021V32.6188V34.3356H28.0405C28.9888 34.3356 29.7573 33.5668 29.7573 32.6188V5.15034C29.7573 4.69502 29.5764 4.25825 29.2544 3.93623ZM40.5 0.999952C39.1194 0.999952 38 2.11934 38 3.49995C38 4.88057 39.1194 5.99995 40.5 5.99995H75.5C76.8806 5.99995 78 4.88057 78 3.49995C78 2.11934 76.8806 0.999952 75.5 0.999952H40.5ZM48 19.5C48 18.1193 49.1194 17 50.5 17H75.5C76.8806 17 78 18.1193 78 19.5C78 20.8806 76.8806 22 75.5 22H50.5C49.1194 22 48 20.8806 48 19.5ZM40.5 33C39.1194 33 38 34.1193 38 35.5C38 36.8806 39.1194 38 40.5 38H75.5C76.8806 38 78 36.8806 78 35.5C78 34.1193 76.8806 33 75.5 33H40.5Z"                      fill="#333333" />              </svg>            </a>          </td>          <td>            <a style="color:black" href="{{ route('student.payments', ['id' => $group['group']->id]) }}">              <svg width="46" height="25" viewBox="0 0 83 37" fill="none" xmlns="http://www.w3.org/2000/svg">                <path fill-rule="evenodd" clip-rule="evenodd"                      d="M25.2451 0.619631L28.7834 6.6814L12.7068 6.66626L23.5234 0.176272C23.8101 0.00464091 24.155 -0.0419899 24.4768 0.037844C24.8 0.12134 25.0769 0.331301 25.2451 0.619631ZM3.33325 6.66626C3.33325 7.58301 4.08325 8.33301 5 8.33301H33.3333C35.1667 8.33301 36.6667 9.83301 36.6667 11.6663V14.9995H32.5C28.3667 14.9995 25 18.3662 25 22.4995C25 26.6328 28.3667 29.9995 32.5 29.9995H36.6667V33.333C36.6667 35.1663 35.1667 36.6663 33.3333 36.6663H5C2.25 36.6663 0 34.4163 0 31.6663V6.24951C0 6.13477 0.0292969 6.02954 0.0581055 5.92652L0.0759277 5.86157L0.083252 5.83301C0.483398 3.46631 2.53345 1.66626 5 1.66626H16.1833L10.6167 4.99951H5C4.08325 4.99951 3.33325 5.74951 3.33325 6.66626ZM28.7834 1.69971C30.4167 1.91626 31.6667 3.31616 31.6667 4.99951V6.66626L28.7834 1.69971ZM38.75 17.4995H32.5C29.7434 17.4995 27.5 19.7429 27.5 22.4995C27.5 25.2561 29.7434 27.4995 32.5 27.4995H38.75C39.4399 27.4995 40 26.9395 40 26.2495V18.7495C40 18.0596 39.4399 17.4995 38.75 17.4995ZM32.5 24.1663C31.5801 24.1663 30.8333 23.4194 30.8333 22.4995C30.8333 21.5796 31.5801 20.8328 32.5 20.8328C33.4199 20.8328 34.1667 21.5796 34.1667 22.4995C34.1667 23.4194 33.4199 24.1663 32.5 24.1663ZM45.5 2.24007e-06C44.1194 2.24007e-06 43 1.11939 43 2.5C43 3.88062 44.1194 5 45.5 5H80.5C81.8806 5 83 3.88062 83 2.5C83 1.11939 81.8806 2.24007e-06 80.5 2.24007e-06H45.5ZM53 18.5C53 17.1194 54.1194 16 55.5 16H80.5C81.8806 16 83 17.1194 83 18.5C83 19.8806 81.8806 21 80.5 21H55.5C54.1194 21 53 19.8806 53 18.5ZM45.5 32C44.1194 32 43 33.1194 43 34.5C43 35.8806 44.1194 37 45.5 37H80.5C81.8806 37 83 35.8806 83 34.5C83 33.1194 81.8806 32 80.5 32H45.5Z"                      fill="#333333" />              </svg>            </a>          </td>          <td>            <a href='/profile/marks/{{$group['group']->id}}'               id={{$group['group']->id}}>              <svg id="Capa_1" enable-background="new 0 0 512 512" height="35" viewBox="0 0 512 512" width="35" xmlns="http://www.w3.org/2000/svg"><g><path d="m512 482h-30v-302h-91v302h-30v-182h-90v182h-30v-242h-90v242h-30v-152h-91v152h-30v30h512z"/><path d="m512 120v-120h-121v30h69.789l-144.789 143.789-120-120-191.605 190.606 21.21 21.21 170.395-169.394 120 120 166-165v68.789z"/></g></svg>            </a>          </td>        </tr>      @endforeach      </tbody>    </table>  </div>@endsection