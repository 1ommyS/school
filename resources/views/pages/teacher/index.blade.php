@extends('layouts.profile')@section('title') Мои группы@endsection<link rel="stylesheet" href="{{ asset("css/forms.css") }}">@section('content')    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">        <div class="container-fluid">            <span class="navbar-brand">С возвращением, <br> {{ Auth::user()->login }} </span>            <button                    class="navbar-toggler"                    type="button"                    data-mdb-toggle="collapse"                    data-mdb-target="#navbarSupportedContent"                    aria-controls="navbarSupportedContent"                    aria-expanded="false"                    aria-label="Toggle navigation"            >                <i class="fas fa-bars"></i>            </button>            <div class="collapse navbar-collapse" id="navbarSupportedContent">                <ul class="navbar-nav me-auto mb-2 mb-lg-0">                    <li class="nav-item">                        <a class="nav-link active" href="/profile/" aria-current="page">Мои группы</a>                    </li>                    <li class="nav-item">                        <a class="nav-link " href="/profile/wages/">Зарплата</a>                    </li>                    <li class="nav-item">                        <a class="nav-link" href="/profile/settings" tabindex="-1">Персональные данные</a>                    </li>                    <li class="nav-item">                        <a class="nav-link" href="https://vk.com/1ommy" tabindex="-1" target="_blank">Сообщить о                                                                                                      проблеме                                                                                                      разработчику</a>                    </li>                    <li class="nav-item">                        <a class="nav-link" href="/logout" tabindex="-1">Выйти из аккаунта</a>                    </li>                </ul>            </div>        </div>    </nav>    <script>      const sendData = (id) => {        const confirmation = confirm("Вы уверены, что хотите выпустить группу ? ");        const path = `/profile/archive/${id}`;        if (confirmation) window.location.href = path;      }    </script>    <div class="container mt-3 table-responsive">        <h1 class="text-center mb-2 ">Активные группы</h1>        <a class="btn btn-orange float-left mb-2" style="color:white" href="/profile/addgroup">Создать группу</a>    </div>    <div class="container mt-3 table-responsive">        @include('layouts.alerts')        <table class="table table-hover mb-2 table-striped table-bordered text-center">            <thead class="table-dark">            <tr>                <th>Название группы</th>                <th>Технология</th>                <th>Расписание</th>                <th>Возраст учеников</th>                <th>Год обучения</th>                <th>Занятия и оплаты</th>                <th>Добавление учеников</th>                <th>Редактировать группу</th>                <th>Выпустить группу</th>                <th>Просмотреть оценки группы</th>            </tr>            </thead>            <tbody>            @foreach ( $groups as $group )                <tr>                    <td>                        <a style='color: black !important;font-weight:bold !important; text-decoration:underline; font-size:16px;'                           href='profile/mystudents/{{$group->id}}'>{{$group -> name_group}}</a>                    </td>                    <td style='font-size:16px;'>                        {{$group -> technology}}                    </td>                    <td style='font-size:16px;'>                        {{$group -> schedule}}                    </td>                    <td style='font-size:16px;'>                        {{$ages[$group -> age]}}                    </td>                    <td style='font-size:16px;'>                        {{$group -> year}}                    </td>                    <td>                        <a href='/group/{{$group->id}}'>                            <svg width='35' height='35' viewBox='0 0 40 40' fill='none'                                 xmlns='http://www.w3.org/2000/svg'>                                <g clip-path='url(#clip0)'>                                    <path                                            d='M28.7835 8.34827L25.2451 2.28661C25.0768 1.99827 24.8001 1.78827 24.4768 1.70494C24.1551 1.62494 23.8101 1.67161 23.5235 1.84327L12.7068 8.33327L28.7835 8.34827Z'                                            fill='#333333' />                                    <path                                            d='M5 10C4.08333 10 3.33333 9.25004 3.33333 8.33337C3.33333 7.41671 4.08333 6.66671 5 6.66671H10.6167L16.1833 3.33337H5C2.53333 3.33337 0.483333 5.13337 0.0833333 7.50004C0.05 7.63337 0 7.76671 0 7.91671V33.3334C0 36.0834 2.25 38.3334 5 38.3334H33.3333C35.1667 38.3334 36.6667 36.8334 36.6667 35V31.6667H32.5C28.3667 31.6667 25 28.3 25 24.1667C25 20.0334 28.3667 16.6667 32.5 16.6667H36.6667V13.3334C36.6667 11.5 35.1667 10 33.3333 10H5ZM31.6667 6.66671C31.6667 4.98337 30.4167 3.58337 28.7833 3.36671L31.6667 8.33337V6.66671Z'                                            fill='#333333' />                                    <path                                            d='M38.75 19.1666H32.5C29.7433 19.1666 27.5 21.41 27.5 24.1666C27.5 26.9233 29.7433 29.1666 32.5 29.1666H38.75C39.44 29.1666 40 28.6066 40 27.9166V20.4166C40 19.7266 39.44 19.1666 38.75 19.1666ZM32.5 25.8333C31.58 25.8333 30.8333 25.0866 30.8333 24.1666C30.8333 23.2466 31.58 22.5 32.5 22.5C33.42 22.5 34.1667 23.2466 34.1667 24.1666C34.1667 25.0866 33.42 25.8333 32.5 25.8333Z'                                            fill='#333333' />                                </g>                                <defs>                                    <clipPath id='clip0'>                                        <rect width='40' height='40' fill='white' />                                    </clipPath>                                </defs>                            </svg>                        </a>                    </td>                    <td>                        <a href='/profile/addstudent/{{$group->id}}' style='color:white'>                            <svg width='35' height='35' viewBox='0 0 40 40' fill='none'                                 xmlns='http://www.w3.org/2000/svg'>                                <g clip-path='url(#clip0)'>                                    <path                                            d='M22.8771 26.0214L21.5857 25.3167C21.0191 25.0081 20.6678 24.4154 20.6678 23.7701V21.5648C21.1138 20.9801 22.3918 19.1574 23.0025 16.7394C23.6325 16.2341 24.0011 15.4781 24.0011 14.6668V12C24.0011 11.358 23.7611 10.7354 23.3345 10.25V6.70339C23.3718 6.33737 23.5179 4.15408 21.9392 2.35337C20.5704 0.791331 18.3478 0 15.3344 0C12.3204 0 10.0984 0.791331 8.72906 2.35337C7.15038 4.15408 7.2964 6.33737 7.33436 6.70339V10.25C6.90702 10.7354 6.66772 11.358 6.66772 12V14.6667C6.66772 15.478 7.03569 16.234 7.66569 16.7394C8.2764 19.1573 9.55437 20.9801 10.001 21.5647V23.77C10.001 24.4153 9.64898 25.008 9.08234 25.3167L3.13497 28.5614C1.20161 29.6161 0.000976562 31.6387 0.000976562 33.8408V36.6668C0.000976562 37.0348 0.298946 37.3334 0.66762 37.3334H23.353C22.0917 35.6594 21.3343 33.5861 21.3343 31.3334C21.3344 29.3808 21.905 27.5628 22.8771 26.0214Z'                                            fill='#333333' />                                    <path                                            d='M31.3333 22.6666C26.5546 22.6666 22.6666 26.5546 22.6666 31.3333C22.6666 36.112 26.5546 40 31.3333 40C36.112 40 40 36.112 40 31.3333C40 26.5546 36.112 22.6666 31.3333 22.6666ZM35.3333 31.9999H31.9999V35.3333C31.9999 35.7013 31.7013 36 31.3333 36C30.9653 36 30.6667 35.7013 30.6667 35.3333V31.9999H27.3333C26.9653 31.9999 26.6666 31.7013 26.6666 31.3333C26.6666 30.9653 26.9653 30.6667 27.3333 30.6667H30.6667V27.3333C30.6667 26.9653 30.9653 26.6666 31.3333 26.6666C31.7013 26.6666 31.9999 26.9653 31.9999 27.3333V30.6667H35.3333C35.7013 30.6667 36 30.9653 36 31.3333C36 31.7013 35.7013 31.9999 35.3333 31.9999Z'                                            fill='#333333' />                                </g>                                <defs>                                    <clipPath id='clip0'>                                        <rect width='40' height='40' fill='white' />                                    </clipPath>                                </defs>                            </svg>                        </a>                    </td>                    <td>                        <a href='/profile/editgroup/{{$group->id}}' style='color:white'>                            <svg width='35' height='35' viewBox='0 0 40 40' fill='none'                                 xmlns='http://www.w3.org/2000/svg'>                                <path fill-rule='evenodd' clip-rule='evenodd'                                      d='M25.3193 4.68179L24.4874 4.54067C24.4007 4.2609 24.2893 3.99103 24.1532 3.73355L24.6434 3.04774C24.8513 2.75559 24.8192 2.35699 24.5641 2.10445L23.8263 1.36666C23.6877 1.22801 23.5045 1.15126 23.3089 1.15126C23.1554 1.15126 23.0093 1.1983 22.8855 1.28743L22.1973 1.77764C21.9299 1.63652 21.6501 1.52016 21.3604 1.4335L21.2218 0.611529C21.1624 0.257486 20.8578 0 20.4988 0H19.4565C19.0975 0 18.793 0.257486 18.7336 0.611529L18.59 1.45331C18.3127 1.53996 18.0428 1.65385 17.7853 1.7925L17.1045 1.30228C16.9807 1.21315 16.8321 1.16611 16.6786 1.16611C16.483 1.16611 16.2974 1.24286 16.1612 1.38151L15.4209 2.11931C15.1684 2.37184 15.1337 2.77045 15.3417 3.0626L15.8369 3.7583C15.7007 4.01827 15.5918 4.28813 15.5076 4.5679L14.6856 4.70655C14.3316 4.76597 14.0741 5.07049 14.0741 5.42949V6.47181C14.0741 6.8308 14.3316 7.13533 14.6856 7.19475L15.5274 7.33835C15.614 7.61564 15.7279 7.88551 15.8666 8.14299L15.3788 8.82137C15.1709 9.11352 15.203 9.51212 15.4581 9.76466L16.1959 10.5025C16.3345 10.6411 16.5177 10.7179 16.7133 10.7179C16.8668 10.7179 17.0129 10.6708 17.1367 10.5817L17.8324 10.0865C18.0824 10.2177 18.3449 10.3242 18.6147 10.4084L18.7534 11.2403C18.8128 11.5943 19.1173 11.8518 19.4763 11.8518H20.5211C20.8801 11.8518 21.1846 11.5943 21.2441 11.2403L21.3852 10.4084C21.665 10.3217 21.9348 10.2103 22.1923 10.0741L22.8781 10.5644C23.0019 10.6535 23.1504 10.7005 23.3039 10.7005C23.4995 10.7005 23.6828 10.6238 23.8214 10.4851L24.5592 9.74733C24.8117 9.49479 24.8464 9.09619 24.6384 8.80404L24.1482 8.11576C24.2844 7.8558 24.3983 7.58593 24.4824 7.30864L25.3143 7.16999C25.6684 7.11057 25.9258 6.80605 25.9258 6.44705V5.40473C25.9308 5.04573 25.6733 4.74121 25.3193 4.68179ZM20.0011 3.36588C18.5899 3.36588 17.4436 4.51219 17.4436 5.92341C17.4436 7.33463 18.5899 8.48094 20.0011 8.48094C21.4124 8.48094 22.5587 7.33463 22.5587 5.92341C22.5587 4.51219 21.4124 3.36588 20.0011 3.36588ZM20.0011 7.81247C18.9588 7.81247 18.1121 6.96573 18.1121 5.92341C18.1121 4.88109 18.9588 4.03435 20.0011 4.03435C21.0435 4.03435 21.8902 4.88109 21.8902 5.92341C21.8902 6.96573 21.0435 7.81247 20.0011 7.81247ZM19.9999 27.132C22.8002 27.132 25.0705 24.3746 25.0705 20.9733C25.0705 17.5719 24.325 14.8145 19.9999 14.8145C15.6747 14.8145 14.9293 17.5719 14.9293 20.9733C14.9294 24.3746 17.1997 27.132 19.9999 27.132ZM29.5661 36.2869C29.4723 30.3616 28.6984 28.6732 22.7767 27.6044C22.7767 27.6044 21.943 28.6666 20.0001 28.6666C18.0572 28.6666 17.2237 27.6044 17.2237 27.6044C11.3665 28.6615 10.5455 30.3249 10.4375 36.0943C10.4288 36.5654 10.4247 36.5902 10.4231 36.5354C10.4234 36.6379 10.4239 36.8274 10.4239 37.158C10.4239 37.158 11.8338 40.0001 20.0002 40.0001C28.1666 40.0001 29.5766 37.158 29.5766 37.158C29.5766 36.9457 29.5768 36.7979 29.577 36.6976C29.5753 36.7314 29.5721 36.6658 29.5661 36.2869ZM31.1549 21.0304C31.1549 23.7928 29.3111 26.0323 27.0367 26.0323C26.3596 26.0323 25.7212 25.8326 25.1578 25.4807C25.9775 24.1828 26.4226 22.6151 26.4226 20.9732C26.4226 19.523 26.3114 17.7063 25.5 16.2106C25.9374 16.0919 26.4458 16.0283 27.0367 16.0283C30.5495 16.0283 31.1549 18.2678 31.1549 21.0304ZM34.806 33.4678C34.7297 28.6554 34.1012 27.2842 29.2917 26.4161C29.2917 26.4161 28.6146 27.2788 27.0366 27.2788C26.9714 27.2788 26.9081 27.2768 26.8458 27.274C27.8485 27.726 28.7606 28.3555 29.4323 29.2765C30.5935 30.8688 30.8604 33.0077 30.9155 36.1501C34.1513 35.5107 34.8144 34.1754 34.8144 34.1754C34.8144 34.0014 34.8144 33.882 34.8148 33.8005C34.8135 33.8292 34.8108 33.7777 34.806 33.4678ZM14.8422 25.4808C14.2786 25.8326 13.6403 26.0323 12.9631 26.0323C10.6888 26.0323 8.84509 23.7929 8.84509 21.0304C8.84509 18.2679 9.45031 16.0284 12.9631 16.0284C13.5541 16.0284 14.0625 16.092 14.4998 16.2107C13.6886 17.7063 13.5774 19.523 13.5774 20.9733C13.5774 22.6152 14.0225 24.1829 14.8422 25.4808ZM13.1539 27.2739C13.0918 27.2767 13.0285 27.2787 12.9631 27.2787C11.3851 27.2787 10.7081 26.416 10.7081 26.416C5.8987 27.2841 5.27013 28.6552 5.19396 33.4677C5.189 33.7777 5.18648 33.8291 5.18518 33.8003C5.18533 33.8819 5.18549 34.0012 5.18549 34.1752C5.18549 34.1752 5.84871 35.5105 9.08424 36.1499C9.13957 33.0076 9.40638 30.8687 10.5678 29.2763C11.2394 28.3554 12.1513 27.7259 13.1539 27.2739Z'                                      fill='#333333' />                            </svg>                        </a>                    </td>                    <td>                        <a href='/profile/{{$group->id}}' onclick='sendData(this.id); return false' style='color:white'                           id={{$group->id}}>                            <svg width='35' height='35' viewBox='0 0 40 40' fill='none'                                 xmlns='http://www.w3.org/2000/svg'>                                <path fill-rule='evenodd' clip-rule='evenodd'                                      d='M11.4338 3.57732L19.8347 5.97757C19.9429 6.00846 20.0571 6.00821 20.1644 5.97757L28.5653 3.57732C29.1442 3.4119 29.1432 2.58845 28.5653 2.42336L20.1644 0.0231024C20.0566 -0.00770082 19.9424 -0.00770082 19.8347 0.0231024L11.4338 2.42336C10.8549 2.58877 10.8559 3.41222 11.4338 3.57732ZM26.6003 5.38704V9.00103C26.6003 9.33226 26.3314 9.60109 26.0002 9.60109C25.669 9.60109 25.4001 9.33226 25.4001 9.00103V5.72988L26.6003 5.38704ZM24.2 7.80087V6.07268L20.494 7.1316C20.1657 7.22553 19.8219 7.22221 19.5051 7.1316L15.7991 6.07268V7.80087C15.7991 8.02809 15.9275 8.23611 16.1307 8.33773L18.7846 9.66427C19.0786 9.81148 19.3479 10.0011 19.5847 10.2275C19.8167 10.4491 20.1823 10.4491 20.4144 10.2275C20.6512 10.0011 20.9204 9.81148 21.2145 9.66427L23.8683 8.33773C24.0716 8.23611 24.2 8.02809 24.2 7.80087ZM19.9999 27.132C22.8002 27.132 25.0705 24.3746 25.0705 20.9733C25.0705 17.572 24.325 14.8146 19.9999 14.8146C15.6747 14.8146 14.9293 17.572 14.9293 20.9733C14.9294 24.3746 17.1997 27.132 19.9999 27.132ZM29.5661 36.2869C29.4723 30.3616 28.6984 28.6733 22.7767 27.6045C22.7767 27.6045 21.943 28.6666 20.0001 28.6666C18.0572 28.6666 17.2237 27.6045 17.2237 27.6045C11.3665 28.6615 10.5455 30.3249 10.4375 36.0944C10.4288 36.5655 10.4247 36.5902 10.4231 36.5355C10.4234 36.638 10.4239 36.8275 10.4239 37.158C10.4239 37.158 11.8338 40.0001 20.0002 40.0001C28.1666 40.0001 29.5766 37.158 29.5766 37.158C29.5766 36.9457 29.5768 36.798 29.577 36.6976C29.5753 36.7314 29.5721 36.6659 29.5661 36.2869ZM31.1549 21.0304C31.1549 23.7929 29.3111 26.0324 27.0367 26.0324C26.3596 26.0324 25.7212 25.8326 25.1578 25.4808C25.9775 24.1828 26.4226 22.6152 26.4226 20.9732C26.4226 19.5231 26.3114 17.7063 25.5 16.2106C25.9374 16.0919 26.4458 16.0284 27.0367 16.0284C30.5495 16.0284 31.1549 18.2678 31.1549 21.0304ZM34.806 33.4678C34.7297 28.6554 34.1012 27.2842 29.2917 26.4161C29.2917 26.4161 28.6146 27.2789 27.0366 27.2789C26.9714 27.2789 26.9081 27.2769 26.8458 27.274C27.8485 27.7261 28.7606 28.3555 29.4323 29.2765C30.5935 30.8688 30.8604 33.0078 30.9155 36.1501C34.1513 35.5107 34.8144 34.1755 34.8144 34.1755C34.8144 34.0015 34.8144 33.8821 34.8148 33.8005C34.8135 33.8292 34.8108 33.7778 34.806 33.4678ZM14.8422 25.4809C14.2786 25.8327 13.6403 26.0324 12.9631 26.0324C10.6888 26.0324 8.84509 23.7929 8.84509 21.0305C8.84509 18.2679 9.45031 16.0285 12.9631 16.0285C13.5541 16.0285 14.0625 16.092 14.4998 16.2107C13.6886 17.7064 13.5774 19.5231 13.5774 20.9733C13.5774 22.6153 14.0225 24.1829 14.8422 25.4809ZM13.1539 27.274C13.0918 27.2768 13.0285 27.2788 12.9631 27.2788C11.3851 27.2788 10.7081 26.416 10.7081 26.416C5.8987 27.2841 5.27013 28.6553 5.19396 33.4677C5.189 33.7777 5.18648 33.8291 5.18518 33.8003C5.18533 33.8819 5.18549 34.0013 5.18549 34.1753C5.18549 34.1753 5.84871 35.5105 9.08424 36.1499C9.13957 33.0077 9.40638 30.8687 10.5678 29.2764C11.2394 28.3555 12.1513 27.726 13.1539 27.274Z'                                      fill='#333333' />                            </svg>                        </a>                    </td>                    <td>                        <a href='/profile/marks/{{$group->id}}'                           id={{$group->id}}>                          <svg id="Capa_1" enable-background="new 0 0 512 512" height="35" viewBox="0 0 512 512" width="35" xmlns="http://www.w3.org/2000/svg"><g><path d="m512 482h-30v-302h-91v302h-30v-182h-90v182h-30v-242h-90v242h-30v-152h-91v152h-30v30h512z"/><path d="m512 120v-120h-121v30h69.789l-144.789 143.789-120-120-191.605 190.606 21.21 21.21 170.395-169.394 120 120 166-165v68.789z"/></g></svg>                        </a>                    </td>                </tr>            @endforeach            </tbody>        </table>        <style>            .table>:not(caption)>*>* {                padding: 1rem 1rem !important;            }        </style>        <br />        @empty($archived_groups)            <h1 class='text-center font-weight-bolder mt-2 mb-3' style='margin-top:10px !important'>Выпустившиеся                                                                                                    группы</h1>            <table class="table table-hover table-striped table-bordered text-center">                <thead class="table-dark">                <tr>                    <th scope="col" style="font-weight:bold !important">Название группы</th>                    <th scope="col" style="font-weight:bold !important">Технология</th>                    <th scope="col" style="font-weight:bold !important">Расписание</th>                    <th scope="col" style="font-weight:bold !important">Возраст учеников</th>                    <th scope="col" style="font-weight:bold !important">Год обучения</th>                    <th scope="col" style="font-weight:bold !important">Оплаты и занятия</th>                </tr>                </thead>                <tbody>                @foreach($archived_groups as $group)                    <tr>                        <td>{{$group->name_group}}</td>                        <td>{{$group->technology}}</td>                        <td>{{$group->schedule}}</td>                        <td>{{$ages[$group->age]}}</td>                        <td><a href='/group/{{$group->id}}'>                                <svg width='35' height='35' viewBox='0 0 40 40' fill='none'                                     xmlns='http://www.w3.org/2000/svg'>                                    <g clip-path='url(#clip0)'>                                        <path                                                d='M28.7835 8.34827L25.2451 2.28661C25.0768 1.99827 24.8001 1.78827 24.4768 1.70494C24.1551 1.62494 23.8101 1.67161 23.5235 1.84327L12.7068 8.33327L28.7835 8.34827Z'                                                fill='#333333' />                                        <path                                                d='M5 10C4.08333 10 3.33333 9.25004 3.33333 8.33337C3.33333 7.41671 4.08333 6.66671 5 6.66671H10.6167L16.1833 3.33337H5C2.53333 3.33337 0.483333 5.13337 0.0833333 7.50004C0.05 7.63337 0 7.76671 0 7.91671V33.3334C0 36.0834 2.25 38.3334 5 38.3334H33.3333C35.1667 38.3334 36.6667 36.8334 36.6667 35V31.6667H32.5C28.3667 31.6667 25 28.3 25 24.1667C25 20.0334 28.3667 16.6667 32.5 16.6667H36.6667V13.3334C36.6667 11.5 35.1667 10 33.3333 10H5ZM31.6667 6.66671C31.6667 4.98337 30.4167 3.58337 28.7833 3.36671L31.6667 8.33337V6.66671Z'                                                fill='#333333' />                                        <path                                                d='M38.75 19.1666H32.5C29.7433 19.1666 27.5 21.41 27.5 24.1666C27.5 26.9233 29.7433 29.1666 32.5 29.1666H38.75C39.44 29.1666 40 28.6066 40 27.9166V20.4166C40 19.7266 39.44 19.1666 38.75 19.1666ZM32.5 25.8333C31.58 25.8333 30.8333 25.0866 30.8333 24.1666C30.8333 23.2466 31.58 22.5 32.5 22.5C33.42 22.5 34.1667 23.2466 34.1667 24.1666C34.1667 25.0866 33.42 25.8333 32.5 25.8333Z'                                                fill='#333333' />                                    </g>                                    <defs>                                        <clipPath id='clip0'>                                            <rect width='40' height='40' fill='white' />                                        </clipPath>                                    </defs>                                </svg>                            </a></td>                    </tr>                @endforeach                </tbody>            </table>        @endempty        @if (empty($groups) && empty($archived_groups))            <h1>У вас ещё нет групп</h1>        @endif    </div>    <script>      document.querySelectorAll('button[data-id]').forEach(element => {        element.addEventListener('click', event => {          $.ajax({            method: "POST",            url: "/profile/addstudent",            data: {              "login": document.querySelector(`input[data-value="${element.dataset.id}"]`)                .value,              "group_id": element.dataset.id,              "price": document.querySelector(                `input[data-value="${element.dataset.id}price"]`).value            }          }).done(msg => console.log(msg))        })      })    </script>@endsection