@extends('layouts.layout')

@section('title')
  События
@endsection

@section('content')
  <header>
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 header-navbar">
          <nav class="navbar navbar-expand-xl">
            <img src=" {{asset('public/img/landing/logo.png')}}" class="logo">
            <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                    aria-label="Toggle navigation">
              <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
              <div class="navbar-nav">
                <a class="nav-item nav-link " href="/">ОБУЧЕНИЕ</a>
                <a class="nav-item nav-link" href="development">РАЗРАБОТКА</a>
                <a class="nav-item nav-link active" href="events">СОБЫТИЯ</a>
                <a class="nav-item nav-link " href="about">О НАС</a>
              </div>
            </div>
            <div class="right-block">
              <button class="nav-item nav-link button-call" href="#" data-toggle="modal"
                      data-target="#myModal111"><i class="fas fa-phone"></i> Связаться
              </button>
              <div class="modal fade" id="myModal111" tabindex="-1" role="dialog"
                   aria-labelledby="myModalLabel111" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="myModalLabel111">Связаться</h4>
                      <button type="button" class="close" data-dismiss="modal">
                        <svg width="49"
                             height="49" viewBox="0 0 49 49" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                          <rect x="35.5018" y="10.9601" width="3" height="34" rx="1.5"
                                transform="rotate(45 35.5018 10.9601)" fill="#FD9207" />
                          <rect x="37.6231" y="35.0018" width="3" height="34" rx="1.5"
                                transform="rotate(135 37.6231 35.0018)" fill="#FD9207" />
                        </svg>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form class="p-4 call-popup">
                        <b>Вконтакте: </b><br><a
                          href="http://vk.com/itpark32">http://vk.com/itpark32</a><br>
                        <b>Instagram: </b><br><a
                          href="http://instagram.com/itpark32">http://instagram.com/itpark32</a><br>
                        <b>YouTube: </b><br><a
                          href="http://youtube.com/channel/UC7I0U-xaj3ZRdmXHxfJHHKw">http://youtube.com/channel/UC7I0U-xaj3ZRdmXHxfJHHKw</a><br>
                        <b>Телефон: </b> <a href="tel:89532819045" class="tel">+7 953 281 90 45</a>

                        <button type="button" class="btn btn-close" data-dismiss="modal"
                                style="color:#fff; font-size: 130%">Закрыть
                        </button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              @guest
                <a href="/login" class="home"><img src="{{asset('public/img/landing/user.svg')}}" width="40"
                                                   style="color:#fff;"></a>
              @endguest
              @auth
                <a href="/profile" class="home"><img src="{{asset('public/img/landing/user.svg')}}" width="40"
                                                     style="color:#fff;"></a>
              @endauth
            </div>
          </nav>
        </div>
      </div>
    </div>
  </header>
  <section class="events-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 header-main">
          <h1 class="mt-4">Поможем вам провести свой хакатон, IT- чемпионат, олимпиаду, конференцию, митап
          </h1>
          <p class="mt-4">За плечами нашей команды более 3-х лет опыта организации подобных мероприятий, и вот
                          некоторые цифры:</p>
          <ul>
            <li>Более 1000 человек в качестве участников прошло через наши мероприятия (свыше 1500 человек в
                качестве зрителей)</li>
            <li>Организовано и проведено более 7 крупных IT мероприятий, на которых люди не просто
                поучаствовали но и обзавелись полезными связями, получили предложения о работе</li>
            <li>70% - участников наших мероприятий возвращаются к нам вновь</li>
          </ul>
          <p>Свежий взгляд, понятная система организации, теперь мы можем провести ваше мероприятие и в онлайн
             формате.</p>
          <div class="cont">
            <button class="btn btn-reg mt-4" href="#" role="button" data-toggle="modal"
                    data-target="#myModal10">Организовать мероприятие</button>
          </div>
          <div class="modal fade" id="myModal10" tabindex="-1" role="dialog" aria-labelledby="myModalLabel10"
               aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" id="myModalLabel10">Организовать мероприятие</h4>
                  <button type="button" class="close" data-dismiss="modal"><svg width="49" height="49"
                                                                                viewBox="0 0 49 49" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <rect x="35.5018" y="10.9601" width="3" height="34" rx="1.5"
                            transform="rotate(45 35.5018 10.9601)" fill="#FD9207" />
                      <rect x="37.6231" y="35.0018" width="3" height="34" rx="1.5"
                            transform="rotate(135 37.6231 35.0018)" fill="#FD9207" />
                    </svg></button>
                </div>
                <div class="modal-body">
                  <form class="text-left " action="/mail">
                    <div class="form-group">
                      <input type="" name="event" hidden>
                      <label for="exampleDropdownFormEmail4">Ваше имя</label>
                      <input type="text" class="form-control" id="exampleDropdownFormEmail4"
                             name="name">
                    </div>
                    <div class="form-group">
                      <label for="exampleDropdownFormPassword4">Ваш телефон</label>
                      <input type="tel" class="form-control" id="exampleDropdownFormPassword4"
                             name="phoneNumber">
                    </div>
                    <div class="form-group">
                      <label for="exampleDropdownFormPassword4 ">Поле для дополнительной
                                                                 информации</label>
                      <textarea placeholder="" class="form-control"
                                style="resize:none; height: 100px;" name="information"></textarea>
                    </div>
                    <div class="modal-footer">
                      <input type="submit" class="btn btn-default"
                             value="Организовать мероприятие">
                      <button type="button" class="btn btn-close" data-dismiss="modal"
                              style="color:#fff; font-size: 130%">Закрыть</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="events-main mb-5">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 text-center mt-4 mb-4">
          <h1>Мы помогли организовать</h1>
        </div>
      </div>
      <div class="row  row-flex">
        <div class="col-lg-6 col-12 cards">
          <div class="card-body text-center">
            <h3 class="card-title">Открытый IT чемпионат им. П.Г. Кузнецова</h3>
            <div class="card-stroke text-left">
              <p>Это короткое пятидневное, динамичное мероприятие, призванное стимулировать появление
                 новых идей в выбранной предметной области и доведение их до реализации непосредственно
                 на площадке мероприятия.</p>

              <p>Секции чемпионата: Программирование (Хакатон), Робототехника (Робокон), 3D моделирование
                 и прототипирование (3D-кон), Графический дизайн (Графикон)</p>

              <p>Формат мероприятия: хакатон</p>

              <p>Результат: успешно проведённый чемпионат, «прокачивание» знаний участников, умение
                 объединятся в команды, отличные продукты «на выходе», социальные связи и предложение о
                 сотрудничестве.</p>

              <p><a href="https://vk.com/open_it_2019" target="_blank">Ссылка на мероприятие</a></p>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-12 cards">
          <div class="card-body text-center">
            <h3 class="card-title">КОДИШЬ</h3>
            <div class="card-stroke text-left">
              <p>Первая большая открытая IT конференция в Брянске для школьников, студентов и состоящих IT
                 специалистов.</p>

              <p>Секции конференции: Front-end разработка, Дизайн, Back-end разработка и для новичков мира
                 IT</p>

              <p>Формат мероприятия: конференция</p>

              <p>Результат: успешно проведённая конференция, социальные связи, предложения о
                 сотрудничестве и работе, создание среды для диалога <br> IT компаний в городе Брянске
              </p>
              <p><a href="https://vk.com/kodishconf" target="_blank">Ссылка на мероприятие</a></p>

            </div>
          </div>
        </div>
      </div>
      <div class="row  row-flex">
        <div class="col-lg-6 col-12 cards">
          <div class="card-body text-center">
            <h3 class="card-title">Региональный этап WorldSkills, компетенция – «Программные решения для
                                   бизнеса Юниоры 14-16</h3>
            <div class="card-stroke text-left">
              <p>Открытый чемпионат рабочих профессий по стандартам WorldSkills для школьников 14-16 лет.
              </p>

              <p>Формат мероприятия: олимпиада по программированию</p>

              <p>Результат: неоднократно успешно проведённый региональный этап, выстраивания диалога с
                 государственными структурами, опыт подготовки участников к соревнованиям и экспертам к
                 судейству, участник прошёл на финал России и в 2018 году выиграл его (2019 год – 4-е
                 место после Москвы и Санкт-Петербурга)</p>

              <p><a href="http://www.bryanskobl.ru/news/2020/03/02/11741" target="_blank">Ссылка на
                                                                                          мероприятие</a></p>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-12 cards">
          <div class="card-body text-center">
            <h3 class="card-title">Ваше мероприятие</h3>
            <div class="card-stroke text-left">
              <p>Хотите вы провести крупное IT событие или небольшую внутришкольную олимпиаду – пишите
                 нам, мы поможем вам советом, поделимся опытом</p>

              <p>Если у вас мало времени, но вы хотите провести мероприятие, вы можете нанять нас как
                 команду организаторов или консультантов по организации подобных мероприятий.</p>

              <p>Работаем как с частными так и с государственными структурами.</p>

              <p>По срокам подготовки и проведения, а так же стоимости и способу оплаты с каждым
                 заказчиком обговариваем индивидуально.</p>

              <p><a href="http://vk.com/itpark32" target="_blank" data-toggle="modal"
                    data-target="#myModal1">Связаться с нами</a></p>

            </div>
          </div>
        </div>
        <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
             aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel1">Связаться с нами</h4>
                <button type="button" class="times-close" data-dismiss="modal"><svg width="45"
                                                                                    height="45" viewBox="0 0 49 49" fill="none" xmlns="">
                    <rect x="35.5018" y="10.9601" width="3" height="34" rx="1.5"
                          transform="rotate(45 35.5018 10.9601)" fill="rgb(248,157,38)" />
                    <rect x="37.6231" y="35.0018" width="3" height="34" rx="1.5"
                          transform="rotate(135 37.6231 35.0018)" fill="rgb(248,157,38)" />
                  </svg></button>
              </div>
              <div class="modal-body">
                <form class="text-left " action="/mail">
                  <div class="form-group">
                    <input type="" name="feedback" hidden>
                    <label for="exampleDropdownFormEmail4">Ваше имя</label>
                    <input type="text" class="form-control" id="exampleDropdownFormEmail4"
                           name="name">
                  </div>
                  <div class="form-group">
                    <label for="exampleDropdownFormPassword4">Ваш телефон</label>
                    <input type="tel" class="form-control" id="exampleDropdownFormPassword4"
                           name="phoneNumber">
                  </div>
                  <div class="form-group">
                    <label for="exampleDropdownFormPassword4 ">Поле для дополнительной
                                                               информации</label>
                    <textarea placeholder="" class="form-control"
                              style="resize:none; height: 100px;" name="information"></textarea>
                  </div>
                  <div class="modal-footer">
                    <input type="submit" class="btn btn-default" value="Связаться с нами">
                    <button type="button" class="btn btn-close" data-dismiss="modal"
                            style="color:#fff; font-size: 130%">Закрыть</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>


    </div>
    </div>
  </section>
@endsection