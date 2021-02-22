@extends('layouts.layout')

@section('title')
  Разработка
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
                <a class="nav-item nav-link active" href="development">РАЗРАБОТКА</a>
                <a class="nav-item nav-link" href="events">СОБЫТИЯ</a>
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
  <section class="header-development">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 header-main">
          <h1 class="mt-4 mb-4">Программируем на заказ</h1>
          <p>Мы Разрабатываем сайты, мобильные приложения, чат-боты и комплексные решения для малого и
             среднего бизнеса качественно и точно в срок</p>
          <p>IT-ПАРК – это команда не просто преподавателей, а профессиональных программистов, дизайнеров и
             бизнес аналитиков с суммарным опытом свыше 50 лет</p>
          <p></p>
          <p>В своей работе мы придерживаемся следующих принципов:<br>
          <ul>
            <li>Честность и прозрачность сделок (никаких скрытых, трансакций и платежей, оплата только за
                результат)
            </li>
            <li>Помощь заказчику в формулировке идеи и разработке ТЗ</li>
            <li>Соблюдение сроков и качества работы</li>
          </ul>
          </p>
          <p>Также поможем проанализировать конкурентов, разработать стратегию, сделать прототипы,
             протестировать существующие сервисы, реализовать продвижение в сети интернет</p>
          <div class="cont">
            <button class="btn btn-reg" href="#" role="button" data-toggle="modal"
                    data-target="#myModal10">Заказать разработку
            </button>
          </div>
          <div class="modal fade" id="myModal10" tabindex="-1" role="dialog" aria-labelledby="myModalLabel10"
               aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" id="myModalLabel10">Заказать разработку</h4>
                  <button type="button" class="close" data-dismiss="modal">
                    <svg width="49" height="49"
                         viewBox="0 0 49 49" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <rect x="35.5018" y="10.9601" width="3" height="34" rx="1.5"
                            transform="rotate(45 35.5018 10.9601)" fill="#FD9207" />
                      <rect x="37.6231" y="35.0018" width="3" height="34" rx="1.5"
                            transform="rotate(135 37.6231 35.0018)" fill="#FD9207" />
                    </svg>
                  </button>
                </div>
                <div class="modal-body">
                  <form class="text-left" action="/mail" method="POST">
                    @csrf
                    <div class="form-group">
                      <input type="" name="development" hidden>
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
                      <input type="submit" class="btn btn-default" value="Заказать разработку">
                      <button type="button" class="btn btn-close" data-dismiss="modal"
                              style="color:#fff; font-size: 130%">Закрыть
                      </button>
                    </div>
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </section>
  <section class="development-kind">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3"><img src="{{ asset('public/img/landing/dev1.png') }}"></div>
        <div class="col-lg-9 pl-5 pr-5">
          <h1 class="mt-4 text-center mb-4">Веб-сайты</h1>
          <p class="kind-header">Веб-сайт – это пространство в интернете, где можно опубликовать подробную
                                 информацию о компании, услугах, условиях заказа и выполнении услуг, контактах и
                                 реквизитах.
            <br>
                                 Иметь свой интернет-ресурс сейчас – это, необходимость для успешного бизнеса или
                                 государственной
                                 структуры. <br>

                                 Сегодня большинство компаний уже имеют свои сайты или веб-сервисы! А у Вас уже есть
                                 свой сайт
                                 или веб-сервис?
          </p>
          <div class="texts-kind row">
            <div class="text-kind col-lg-6 col-12 ">
              <h3>Зачем?</h3>
              <ul>
                <li>Сайт информирует ваших клиентов круглый год и ночью и днем.</li>
                <li>Ссылку на сайт можно указать в визитках, в разговоре, в рекламных материалах, в
                    различных справочниках, каталогах и поисковых системах.
                </li>
                <li>На сайте легко публиковать информацию, которую невозможно разместить ни в одном
                    другом виде традиционной рекламы.
                </li>
                <li>Изменять информацию на сайте очень просто. И при этом не нужно макетировать новый
                    буклет, отдавать его в типографию и рассылать клиентам.
                </li>
              </ul>
            </div>

            <div class="text-kind col-lg-6 col-12">
              <h3>Кому необходимо</h3>
              <ul>
                <li>Малому и среднему бизнесу с целью продвижения своих товаров и услуг в интернете</li>
                <li>Артистам и ведущим мероприятий с целью построения личного бренда</li>
                <li>Государственным структурам с целью соответствия ФЗ</li>
              </ul>
            </div>
            <div class="text-kind col-lg-6 col-12">
              <h3>Почему мы?</h3>
              <ul>
                <li>За 8 лет существования нашей компании, мы реализовали свыше 1000 крупных и мелких
                    проектов: компьютерных программ, мобильных приложений, чат-ботов, сайтов и веб
                    сервисов, так что мы имеем определённый опыт в этой сфере.
                </li>
                <li>Кроме того у нас есть онлайн-школа программирования, в которой преподают специалисты
                    своего направления, что позволяет не искать исполнителей «на стороне», а привлекать
                    лучших выпускников к разработке проектов и быть уверенными в качестве продукта.
                </li>
              </ul>
            </div>
            <div class="text-kind col-lg-6 col-12">
              <h3>Расчет стоимости и сроков</h3>
              <ul>
                <li>Сайт-визитка - от 15 000 рублей;</li>
                <li>Веб-сервис - от 50 000 рублей</li>
                <li>Комплексное решение - от 125 000 рублей</li>
                <li>Сроки разработки - от 3 недель</li>
              </ul>
            </div>
          </div>

        </div>
        <div class="col-12">
          <div class="text-center">
            <button href="" class="btn-reg" data-toggle="modal" data-target="#myModal1">Заказать
                                                                                        веб-сайт
            </button>
            <div class="modal fade" id="myModal1" tabindex="-1" role="dialog"
                 aria-labelledby="myModalLabel1" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel1">Заказать веб-сайт</h4>
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
                    <form class="text-left " action="/mail" method="post">
                      @csrf
                      <div class="form-group">
                        <input type="" name="development" hidden>
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
                               value="Заказать разработку">
                        <button type="button" class="btn btn-close" data-dismiss="modal"
                                style="color:#fff; font-size: 130%">Закрыть
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="development-kind">
    <div class="container-fluid">
      <div class="row ">
        <div class="col-lg-3"><img src="{{asset('public/img/landing/dev2.png')}}"></div>
        <div class="col-lg-9 pl-5 pr-5">
          <h1 class="mt-4 text-center mb-4">Мобильные приложения</h1>
          <p class="kind-header">Сегодня бизнес без собственного мобильного приложения немыслим. <br>

                                 Мобильная реальность стала для пользователей насущной необходимостью. У компаний
                                 появилась
                                 возможность стать так близко к своим клиентам, как никогда раньше – быть в сумочке, в
                                 кармане
                                 брюк, на расстоянии вытянутой руки.
            <br>
                                 И те компании, которые позаботятся об этом инструменте, заберут себе львиную долю
                                 клиентов.
          </p>
          <div class="texts-kind row">
            <div class="text-kind col-lg-6 col-12">
              <h3>Зачем?</h3>
              <ul>
                <li>Выделиться на фоне конкурентов – вместо привычных листовок и СМСок использовать push
                    уведомления и 3D модели товаров
                </li>
                <li>Оптимизировать бизнес процессы – теперь можно контролировать и измерять каждое
                    действие с товаром или услугой как со стороны клиента так и со стороны сотрудника,
                    что позволит повысить продажи и эффективность вашей работы.
                </li>
                <li>Новый уровень сервиса – замена пластиковым и бумажным карточкам, свежие скидки и
                    акции – всё собрано внутри одного приложения
                </li>
              </ul>
            </div>

            <div class="text-kind col-lg-6 col-12">
              <h3>Кому необходимо</h3>
              <ul>
                <li>Малому и среднему бизнесу с целью продвижения своих товаров и услуг, а так же
                    проведения промоакций
                </li>
                <li>Бизнесу и государственным структурам с целью цифровизации и автоматизации бизнес
                    процессов
                </li>
                <li>Публичным личностям с целью построения личного бренда</li>
              </ul>
            </div>
            <div class="text-kind col-lg-6 col-12">
              <h3>Почему мы?</h3>
              <ul>
                <li>За 8 лет существования нашей компании, мы реализовали свыше 1000 крупных и мелких
                    проектов: компьютерных программ, мобильных приложений, чат-ботов, сайтов и веб
                    сервисов, так что мы имеем определённый опыт в этой сфере.
                </li>
                <li>Кроме того у нас есть онлайн-школа программирования, в которой преподают специалисты
                    своего направления, что позволяет не искать исполнителей «на стороне», а привлекать
                    лучших выпускников к разработке проектов и быть уверенными в качестве продукта.
                </li>
              </ul>
            </div>
            <div class="text-kind col-lg-6 col-12">
              <h3>Расчет стоимости</h3>
              <ul>
                <li>Промо-приложение от 50 000 рублей (iOS + Android)</li>
                <li>Комплексное решение от 150 000 рублей (iOS + Android)</li>
                <li>Сроки разработки - от 4 недель</li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-12">
          <div class="text-center">
            <button href="" class="btn-reg" data-toggle="modal" data-target="#myModal2">Заказать
                                                                                        приложение
            </button>
            <div class="modal fade" id="myModal2" tabindex="-1" role="dialog"
                 aria-labelledby="myModalLabel2" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel2">Заказать приложение</h4>
                    <button type="button" class="times-close" data-dismiss="modal">
                      <svg width="45"
                           height="45" viewBox="0 0 49 49" fill="none" xmlns="">
                        <rect x="35.5018" y="10.9601" width="3" height="34" rx="1.5"
                              transform="rotate(45 35.5018 10.9601)" fill="rgb(248,157,38)" />
                        <rect x="37.6231" y="35.0018" width="3" height="34" rx="1.5"
                              transform="rotate(135 37.6231 35.0018)" fill="rgb(248,157,38)" />
                      </svg>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form class="text-left " action="/mail" method="post">
                      @csrf
                      <div class="form-group">
                        <input type="" name="development" hidden>
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
                               value="Заказать разработку">
                        <button type="button" class="btn btn-close" data-dismiss="modal"
                                style="color:#fff; font-size: 130%">Закрыть
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="development-kind">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3"><img src="{{asset('public/img/landing/dev3.png')}}"></div>
        <div class="col-lg-9 pl-5 pr-5">
          <h1 class="mt-4 text-center mb-4">Чат-боты</h1>
          <p class="kind-header">Компании и банки охотно используют чат-ботов - специально обученные
                                 программы, которые имитируют поведение человека.
            <br>
                                 Чат-бот позволяет ответить на простые вопросы, а также связаться со специалистом
                                 компании.

                                 Их можно встретить на сайтах частных клиник, зоомагазинов, турагентств.
            <br>
                                 Чат-боты работают через привычные нам мессенджеры: Вконтакте, Telegram, WhatsApp,
                                 Viber,
                                 Facebook
          </p>
          <div class="texts-kind row">
            <div class="text-kind col-lg-6 col-12">
              <h3>Зачем?</h3>
              <ul>
                <li>Чат боты экономят время и деньги - в среднем пользователь ждет начала разговора с
                    ботом две секунды, с оператором кол-центра - минуту. Длительность разговора, в
                    результате которого проблема успешно решается, составляет две минуты с ботом и
                    восемь минут с оператором.
                </li>

                <li>Повышают лояльность аудитории - 80% клиентов компании устраивают ответы, полученные
                    от ботов. 69% клиентов предпочитают использовать чат-бот для связи с компанией и
                    решения возникающих вопросов.
                </li>

                <li>Позволяют не только автоматизировать бизнес процессы крупных компаний, но и провести
                    интерактивы на мероприятиях (выставках, форумах) такие: нетворкинг, знакомство со
                    спикерами, квесты, онлайн расписание мероприятия
                </li>
              </ul>
            </div>

            <div class="text-kind col-lg-6 col-12">
              <h3>Кому необходимо</h3>
              <ul>
                <li>Малому и среднему бизнесу с целью продвижения своих товаров и услуг, а так же
                    проведения промоакций через мессенджеры
                </li>
                <li>Бизнесу и государственным структурам с целью цифровизации и автоматизации бизнес
                    процессов
                </li>
                <li>Самозанятым людям с целью автоматизации записи клиентов или ответов на часто
                    задаваемые вопросы
                </li>
              </ul>
            </div>
            <div class="text-kind col-lg-6 col-12">
              <h3>Почему мы?</h3>
              <ul>
                <li>За 8 лет существования нашей компании, мы реализовали свыше 1000 крупных и мелких
                    проектов: компьютерных программ, мобильных приложений, чат-ботов, сайтов и веб
                    сервисов, так что мы имеем определённый опыт в этой сфере.
                </li>
                <li>Кроме того у нас есть онлайн-школа программирования, в которой преподают специалисты
                    своего направления, что позволяет не искать исполнителей «на стороне», а привлекать
                    лучших выпускников к разработке проектов и быть уверенными в качестве продукта.
                </li>
              </ul>
            </div>
            <div class="text-kind col-lg-6 col-12">
              <h3>Расчет стоимости</h3>
              <ul>
                <li>Чат-боты от 15 000 рублей. Платформы: WhatsApp, Telegram, Viber, Facebook</li>
                <li>Сроки разработки - от 2 недель</li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-12">
          <div class="text-center">
            <button href="" class="btn-reg" data-toggle="modal" data-target="#myModal3">Заказать
                                                                                        чат-бота
            </button>
            <div class="modal fade" id="myModal3" tabindex="-1" role="dialog"
                 aria-labelledby="myModalLabel3" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel3">Заказать чат-бота</h4>
                    <button type="button" class="times-close" data-dismiss="modal">
                      <svg width="45"
                           height="45" viewBox="0 0 49 49" fill="none" xmlns="">
                        <rect x="35.5018" y="10.9601" width="3" height="34" rx="1.5"
                              transform="rotate(45 35.5018 10.9601)" fill="rgb(248,157,38)" />
                        <rect x="37.6231" y="35.0018" width="3" height="34" rx="1.5"
                              transform="rotate(135 37.6231 35.0018)" fill="rgb(248,157,38)" />
                      </svg>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form class="text-left " action="/mail">
                      <div class="form-group">
                        <input type="" name="development" hidden>
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
                               value="Заказать разработку">
                        <button type="button" class="btn btn-close" data-dismiss="modal"
                                style="color:#fff; font-size: 130%">Закрыть
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
  <section class="development-kind">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3"><img src="{{asset('public/img/landing/dev4.png')}}"></div>
        <div class="col-lg-9 pl-5 pr-5">
          <h1 class="mt-4 text-center mb-4">Комплексные решения</h1>
          <p class="kind-header">Всё большей популярностью сейчас пользуется комплексные решения - сервисы
                                 "под ключ", потому что иметь только сайт или только мобильное приложение не выгодно.
                                 Бизнес, с целью извлечения прибыли старается общаться с клиентами через все доступные
                                 каналы
                                 связи – сайт, мобильное приложение, чат-боты и чем больше «точек» касания, тем выше
                                 лояльность
                                 клиентов и больше продаж</p>
          <div class="texts-kind row">
            <div class="text-kind col-lg-6 col-12">
              <h3>Зачем?</h3>
              <ul>
                <li>Комплексное решение - сервис "под ключ" включает в себя сайт, мобильное приложение,
                    чат-бот, компьютерную программу, которые объединяются в одну систему, что позволит
                    Вам полноценно оцифровать Ваш бизнес, следить за ключевыми показателями в реальном
                    времени, управлять компанией из любой точки мира.
                </li>
              </ul>
            </div>

            <div class="text-kind col-lg-6 col-12">
              <h3>Кому необходимо</h3>
              <ul>
                <li>Среднему и крупному бизнесу,а так же государственным структурам с целью цифровизации
                    и автоматизации бизнес процессов
                </li>
              </ul>
            </div>
            <div class="text-kind col-lg-6 col-12">
              <h3>Почему мы?</h3>
              <ul>
                <li>За 8 лет существования нашей компании, мы реализовали свыше 1000 крупных и мелких
                    проектов: компьютерных программ, мобильных приложений, чат-ботов, сайтов и веб
                    сервисов, так что мы имеем определённый опыт в этой сфере.
                </li>
                <li>Кроме того у нас есть онлайн-школа программирования, в которой преподают специалисты
                    своего направления, что позволяет не искать исполнителей «на стороне», а привлекать
                    лучших выпускников к разработке проектов и быть уверенными в качестве продукта.
                </li>
              </ul>
            </div>
            <div class="text-kind col-lg-6 col-12">
              <h3>Расчет стоимости</h3>
              <ul>
                <li>Сроки разработки - индивидуальный</li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-12">
          <div class="text-center">
            <button href="" class="btn-reg" data-toggle="modal" data-target="#myModal4">Заказать
                                                                                        сервис
            </button>
            <div class="modal fade" id="myModal4" tabindex="-1" role="dialog"
                 aria-labelledby="myModalLabel4" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel4">Заказать сервис</h4>
                    <button type="button" class="times-close" data-dismiss="modal">
                      <svg width="45"
                           height="45" viewBox="0 0 49 49" fill="none" xmlns="">
                        <rect x="35.5018" y="10.9601" width="3" height="34" rx="1.5"
                              transform="rotate(45 35.5018 10.9601)" fill="rgb(248,157,38)" />
                        <rect x="37.6231" y="35.0018" width="3" height="34" rx="1.5"
                              transform="rotate(135 37.6231 35.0018)" fill="rgb(248,157,38)" />
                      </svg>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form class="text-left " action="/mail">
                      <div class="form-group">
                        <input type="" name="development" hidden>
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
                               value="Заказать разработку">
                        <button type="button" class="btn btn-close" data-dismiss="modal"
                                style="color:#fff; font-size: 130%">Закрыть
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
