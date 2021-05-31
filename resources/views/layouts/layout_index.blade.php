<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{ $metaTags->description ?? '' }}">
    <meta name="keywords" content="{{ $metaTags->keywords ?? '' }}">
    <meta name="author" content="Max">
    <title>{{ $metaTags->title ?? '' }}</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ URL::asset($ogImage ?? 'img/brand/favicon.png') }}" type="image/png">
    <!-- Font Awesome 5 -->
    <link rel="stylesheet" href="{{ URL::asset('libs/@fortawesome/fontawesome-free/css/all.min.css') }}"><!-- Purpose CSS -->
    <link rel="stylesheet" href="{{ URL::asset('libs/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('libs/flatpickr/dist/flatpickr.min.css') }}">

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="{{ URL::asset('css/app.css') }}" rel="stylesheet" type="text/css">
{{--    <link rel="shortcut icon" href="">--}}

</head>

<body>
<header class="header header-transparent" id="header-main">
    <!-- Topbar -->
    <div id="navbar-top-main" class="navbar-top  navbar-light bg-white border-bottom">
        <div class="container">
            <div class="navbar-nav align-items-center">
                <div>
                    @include('layouts.countries-top')
                </div>
                <div class="ml-auto">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fab fa-android"></i>
                            </a>
                        </li>
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('register'))
                                <li class="nav-item mx-1">
                                    <a href="{{ route('register') }}" class="btn btn-warning text-white nav-link">
                                        Создать аккаунт
                                    </a>
                                </li>
                            @endif
                            @if (Route::has('login'))
                                <li class="nav-item ml-1">
                                    <a href="{{ route('login') }}" class="btn btn-warning text-white nav-link">
                                        Войти
                                    </a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item align-self-center">
                                <a class="" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    @include('layouts.user-avatar', ['nexClass' => 'avatar-sm'])
                                </a>
                            </li>
                            <li class="nav-item dropdown mx-2">
                                <a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Привет, {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right shadow">
                                    <h6 class="dropdown-header">Ваш ID: {{ Auth::id() }}</h6>
                                    @can('view-admin')
                                        <a class="dropdown-item" href="{{ route('adminchik.index') }}">
                                            <i class="fas fa-user-shield"></i>Админ панель
                                        </a>
                                        <div class="dropdown-divider" role="presentation"></div>
                                    @endcan
                                    <a class="dropdown-item" href="{{ route('account.cargo') }}">
                                        <i class="fas fa-boxes"></i>Мои грузы
                                    </a>
                                    <a class="dropdown-item" href="{{ route('account.car') }}">
                                        <i class="fas fa-truck"></i>Мои автомобили
                                    </a>
                                    <a class="dropdown-item" href="{{ route('account.settings') }}">
                                        <i class="fas fa-cog"></i>Настройки
                                    </a>
                                    <div class="dropdown-divider" role="presentation"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i>Выход
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="main-content">
    @yield('main_content')
</div>

<!-- Modal Contacts -->
<div class="modal fade" id="modal-contacts" tabindex="-1" role="dialog" aria-labelledby="modal-contacts" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title d-flex align-items-center">
                    <div class="icon icon-sm icon-shape icon-info rounded-circle shadow mr-3">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div>
                        <h6 class="mb-0">Контакты <span id="cargo_name"></span></h6>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item pl-0">
                            <div class="row">
                                <div class="col-7"><small class="h6 text-sm mb-3 mb-sm-0">Имя/Компания</small></div>
                                <div class="col-5">
                                    <span class="text-sm h6"><span id="modal_contact_name">загрузка...</span></span>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item pl-0">
                            <div class="row">
                                <div class="col-7"><small class="h6 text-sm mb-3 mb-sm-0">Телефон</small></div>
                                <div class="col-5">
                                    <span class="text-sm"><span id="modal_contact_phone">загрузка...</span></span>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item pl-0">
                            <div class="row">
                                <div class="col-7"><small class="h6 text-sm mb-3 mb-sm-0">Действия</small></div>
                                <div class="col-5">
                                    <a class="btn btn-sm btn-success rounded-pill" id="modal_contact_phone_button" href="" role="button" style="display: none;">позвонить <i class="fas fa-phone ml-2"></i> </a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Contacts End -->
<!-- Modal Subscribe -->
<div class="modal fade" id="modal-subscribe" tabindex="-1" role="dialog" aria-labelledby="modal-contacts" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title d-flex align-items-center">
                    <div class="icon icon-sm icon-shape icon-info rounded-circle shadow mr-3">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div>
                        <h6 class="mb-0">Подписка</h6>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Subscription Alert -->
                <div class="alert alert-group alert-warning alert-icon" role="alert">
                    <div class="alert-group-prepend">
                        <span class="alert-group-icon text-">
                            <i class="fas fa-thumbs-up"></i>
                        </span>
                    </div>
                    <div class="alert-content">
                        Просмотр контактов доступен по <a href="{{ route('subscription.index')}}" class="alert-link">подписке</a>
                    </div>
                </div>
                <!-- Subscription Alert end -->
                <div class="text-md">
                    Подписка позволит вам смотреть контакты без ограничений
                </div>
                <div class="mt-4">
                    <a href="{{ route('subscription.index')}}" class="btn btn-sm btn-success rounded-pill">Оформить подписку</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Subscribe end -->
<!-- Modal Map -->
<div class="modal fade" id="modal-map" tabindex="-1" role="dialog" aria-labelledby="modal-contacts" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title d-flex align-items-center">
                    <div class="icon icon-sm icon-shape icon-info rounded-circle shadow mr-3">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div>
                        <h6 class="mb-0">Карта</h6>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-md iframe-map">

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Map end -->

<footer class="footer footer-dark bg-dark" id="footer-main">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-5 mb-lg-0">
                <a class="navbar-brand mr-lg-5 text-white" href="/">
                    ALGARIA
                </a>
                <p class="text-sm">
                    Сервис поиска попутного груза
                </p>
                <p class="text-sm">
                    В частности, глубокий уровень погружения влечет за собой процесс внедрения и модернизации дальнейших направлений развития.
                </p>
            </div>
            <div class="col-lg-2 col-6 col-sm-4 ml-lg-auto mb-5 mb-lg-0">
                <h6 class="heading mb-3">Навигация</h6>
                <ul class="list-unstyled">
                    <li><a href="{{ route('login') }}">Вход в кабинет</a></li>
                    <li><a href="{{ route('register') }}">Создать аккаунт</a></li>
                    <li><a href="{{ route('cargo.create') }}">Разместить груз</a></li>
                    <li><a href="{{ route('car.create') }}">Добавить машину</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-6 col-sm-4 mb-5 mb-lg-0">
                <h6 class="heading mb-3">Информация</h6>
                <ul class="list-unstyled text-small">
                    <li><a href="{{ route('post.index') }}">Блог</a></li>
                    <li><a href="{{ route('content.index', ['slug' => 'rules']) }}">Правила</a></li>
                    <li><a href="{{ route('faq.index') }}">FAQ</a></li>
                    <li><a href="{{ route('content.index', ['slug' => 'privacy']) }}">Приватность</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-sm-4 mb-5 mb-lg-0">
                <h6 class="heading mb-3">Поиск</h6>
                <ul class="list-unstyled">
                    <li><a href="{{ route('cargo.search') }}">Найти груз</a></li>
                    <li><a href="{{ route('car.search') }}">Найти машину</a></li>
                </ul>
            </div>
        </div>
        <div class="row align-items-center justify-content-md-between py-4 mt-4 delimiter-top">
            <div class="col-md-4">
                <div class="copyright text-sm font-weight-bold text-center text-md-left">
                    &copy; {{ $date->year }} Algaria
                </div>
            </div>
            <div class="col-md-4">
                <ul class="nav justify-content-center mt-3 mt-md-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#" target="_blank">
                            <i class="fab fa-dribbble"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#" target="_blank">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" target="_blank">
                            <i class="fab fa-github"></i>
                        </a>
                    </li>
                    <li class="nav-item ali">
                        <a class="nav-link" href="#" target="_blank">
                            <i class="fab fa-facebook"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-md-4 text-right">
                <a href="#" target="_blank" type="button" class="btn btn-app-store btn-sm">
                    <i class="fab fa-google-play"></i>
                    <span class="btn-inner--text">Скачать приложение</span>
                    <span class="btn-inner--brand">Google Play</span>
                </a>
            </div>
        </div>
    </div>
</footer>
<!-- Core JS -->
<script src="{{ asset('js/purpose.core.js') }}"></script>
{{--<script src="{{ URL::asset('js/app.js') }}"></script>--}}
{{--<!-- Page JS -->--}}
<script src="{{ asset('libs/select2/dist/js/select2.min.js') }}"></script>
{{--<!-- Purpose JS -->--}}

<script src="{{ asset('js/purpose.js') }}"></script>
<script src="{{ asset('js/functions.js') }}"></script>
<script src="{{ asset('js/map.js?v=' . rand(1,1000)) }}"></script>
<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
    $(document).ready(function() {
        $('textarea').summernote();
    });
</script>
</body>

</html>











{{--<!DOCTYPE html>--}}
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}

{{--<head>--}}
{{--    <meta charset="utf-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">--}}
{{--    <meta name="description" content="Purpose is a unique and beautiful collection of UI elements that are all flexible and modular. A complete and customizable solution to building the website of your dreams.">--}}
{{--    <meta name="author" content="Webpixels">--}}
{{--    <title>Purpose Website UI Kit - Purpose is a unique and beautiful collection of UI elements that are all flexible and modular. A complete and customizable solution to building the website of your dreams.</title>--}}
{{--    <!-- Favicon -->--}}
{{--    <link rel="icon" href="{{ URL::asset('img/brand/favicon.png') }}" type="image/png">--}}
{{--    <!-- Font Awesome 5 -->--}}
{{--    <link rel="stylesheet" href="{{ URL::asset('libs/@fortawesome/fontawesome-free/css/all.min.css') }}"><!-- Purpose CSS -->--}}
{{--    <link rel="stylesheet" href="{{ URL::asset('libs/select2/dist/css/select2.min.css') }}">--}}
{{--    <link rel="stylesheet" href="{{ URL::asset('libs/flatpickr/dist/flatpickr.min.css') }}">--}}

{{--    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">--}}
{{--    <link href="{{ URL::asset('css/app.css') }}" rel="stylesheet" type="text/css">--}}
{{--</head>--}}

{{--<body>--}}
{{--<header class="header header-transparent" id="header-main">--}}
{{--    <!-- Topbar -->--}}
{{--    <div id="navbar-top-main" class="navbar-top  navbar-light bg-white border-bottom">--}}
{{--        <div class="container px-0">--}}
{{--            <div class="navbar-nav align-items-center">--}}
{{--                <div>--}}
{{--                    @include('layouts.countries_top')--}}
{{--                </div>--}}
{{--                <div class="ml-auto">--}}
{{--                    <ul class="nav">--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                                <i class="fas fa-bell"></i>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                                <i class="fab fa-android"></i>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <!-- Authentication Links -->--}}
{{--                        @guest--}}
{{--                            @if (Route::has('register'))--}}
{{--                                <li class="nav-item mx-1">--}}
{{--                                    <a href="{{ route('register') }}" class="btn btn-warning text-white nav-link">--}}
{{--                                        Создать аккаунт--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                            @endif--}}
{{--                            @if (Route::has('login'))--}}
{{--                                <li class="nav-item ml-1">--}}
{{--                                    <a href="{{ route('login') }}" class="btn btn-warning text-white nav-link">--}}
{{--                                        Войти--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                            @endif--}}
{{--                        @else--}}
{{--                            <li class="nav-item align-self-center">--}}
{{--                                <a class="" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                                    <img alt="Image placeholder" src="{{ URL::asset('img/theme/light/team-1-800x800.jpg') }}" class="avatar  rounded-circle avatar-sm">--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item dropdown mx-2">--}}
{{--                                <a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                                    Привет, {{ Auth::user()->name }}--}}
{{--                                </a>--}}
{{--                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">--}}
{{--                                    <h6 class="dropdown-header">User menu</h6>--}}
{{--                                    <a class="dropdown-item" href="{{ route('cargo.cargo_my') }}">--}}
{{--                                        <i class="fas fa-user"></i>Мои грузы--}}
{{--                                    </a>--}}
{{--                                    <a class="dropdown-item" href="{{ route('car.car_my') }}">--}}
{{--                                        <i class="fas fa-user"></i>Мои авто--}}
{{--                                    </a>--}}
{{--                                    <a class="dropdown-item" href="#">--}}
{{--                                        <span class="float-right badge badge-primary">4</span>--}}
{{--                                        <i class="fas fa-envelope"></i>Messages--}}
{{--                                    </a>--}}
{{--                                    <a class="dropdown-item" href="#">--}}
{{--                                        <i class="fas fa-cog"></i>Settings--}}
{{--                                    </a>--}}
{{--                                    <div class="dropdown-divider" role="presentation"></div>--}}
{{--                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">--}}
{{--                                        <i class="fas fa-sign-out-alt"></i>{{ __('Logout') }}--}}
{{--                                    </a>--}}
{{--                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">--}}
{{--                                        @csrf--}}
{{--                                    </form>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                        @endguest--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <!-- Main navbar -->--}}
{{--    <nav class="navbar navbar-main navbar-expand-lg navbar-transparent navbar-light bg-white border-bottom" id="navbar-main">--}}
{{--        <div class="container px-lg-0">--}}
{{--            <!-- Logo -->--}}
{{--            <a class="navbar-brand mr-lg-5" href="../../index.html">--}}
{{--                ALGARIA--}}
{{--            </a>--}}
{{--            <!-- Navbar collapse trigger -->--}}
{{--            <button class="navbar-toggler pr-0" type="button" data-toggle="collapse" data-target="#navbar-main-collapse" aria-controls="navbar-main-collapse" aria-expanded="false" aria-label="Toggle navigation">--}}
{{--                <span class="navbar-toggler-icon"></span>--}}
{{--            </button>--}}
{{--            <!-- Navbar nav -->--}}
{{--            <div class="collapse navbar-collapse" id="navbar-main-collapse">--}}
{{--                <ul class="navbar-nav align-items-lg-center">--}}
{{--                    <!-- Home - Overview  -->--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" href="{{ route('cargo.search') }}">Найти груз</a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" href="{{ route('car.search') }}">Найти машину</a>--}}
{{--                    </li>--}}
{{--                    <!-- Cargo country -->--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" href="#">Блог</a>--}}
{{--                    </li>--}}
{{--                    <!-- International cargo -->--}}
{{--                    <li class="nav-item ">--}}
{{--                        <a class="nav-link" href="#">Карта</a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--                <ul class="navbar-nav align-items-lg-center ml-lg-auto">--}}
{{--                    <li class="nav-item mr-2">--}}
{{--                        <a href="{{ route('cargo.create') }}" class="nav-link d-lg-none">Разместить груз</a>--}}
{{--                        <a href="{{ route('cargo.create') }}" class="btn btn-sm btn-slack btn-icon rounded-pill d-none d-lg-inline-flex" data-toggle="tooltip" data-placement="left" title="Go to Bootstrap Themes">--}}
{{--                            <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>--}}
{{--                            <span class="btn-inner--text">Разместить груз</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item mr-0">--}}
{{--                        <a href="{{ route('car.create') }}" class="nav-link d-lg-none">Добавить машину</a>--}}
{{--                        <a href="{{ route('car.create') }}" class="btn btn-sm btn-slack btn-icon rounded-pill d-none d-lg-inline-flex" data-toggle="tooltip" data-placement="left" title="Go to Bootstrap Themes">--}}
{{--                            <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>--}}
{{--                            <span class="btn-inner--text">Добавить машину</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </nav>--}}
{{--</header>--}}

{{--<div class="main-content">--}}
{{--    @if($errors->any())--}}
{{--        <section class="slice slice-lg pb-0">--}}
{{--            <div class="container mt-5">--}}
{{--                @foreach($errors->all() as $error)--}}
{{--                    <div class="alert alert-danger alert-dismissible fade show" role="alert">--}}
{{--                        <strong>{{ $error }}</strong>--}}
{{--                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
{{--                            <span aria-hidden="true">&times;</span>--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        </section>--}}
{{--    @endif--}}
{{--    @yield('content')--}}
{{--</div>--}}

{{--<footer class="footer footer-dark bg-dark" id="footer-main">--}}
{{--    <div class="container">--}}
{{--        <div class="row">--}}
{{--            <div class="col-lg-4 mb-5 mb-lg-0">--}}
{{--                <a href="../../index.html">--}}
{{--                    <img src="{{ URL::asset('img/brand/white.png') }}" alt="Footer logo" style="height: 70px;">--}}
{{--                </a>--}}
{{--                <p class="text-sm">A unique and beautiful collection of UI elements that are all flexible and modular. A complete and customizable solution to building the website of your dreams.</p>--}}
{{--            </div>--}}
{{--            <div class="col-lg-2 col-6 col-sm-4 ml-lg-auto mb-5 mb-lg-0">--}}
{{--                <h6 class="heading mb-3">Аккаунт</h6>--}}
{{--                <ul class="list-unstyled">--}}
{{--                    <li><a href="#">Вход</a></li>--}}
{{--                    <li><a href="#">Создать аккаунт</a></li>--}}
{{--                    <li><a href="#">Добавить машину</a></li>--}}
{{--                    <li><a href="#">Разместить груз</a></li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--            <div class="col-lg-2 col-6 col-sm-4 mb-5 mb-lg-0">--}}
{{--                <h6 class="heading mb-3">Информация</h6>--}}
{{--                <ul class="list-unstyled text-small">--}}
{{--                    <li><a href="#">Блог</a></li>--}}
{{--                    <li><a href="#">FAQ</a></li>--}}
{{--                    <li><a href="#">FAQ</a></li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--            <div class="col-lg-2 col-sm-4 mb-5 mb-lg-0">--}}
{{--                <h6 class="heading mb-3">Поиск</h6>--}}
{{--                <ul class="list-unstyled">--}}
{{--                    <li><a href="#">Найти груз</a></li>--}}
{{--                    <li><a href="#">Найти машину</a></li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="row align-items-center justify-content-md-between py-4 mt-4 delimiter-top">--}}
{{--            <div class="col-md-4">--}}
{{--                <div class="copyright text-sm font-weight-bold text-center text-md-left">--}}
{{--                    &copy; 2021 <a href="" class="font-weight-bold" target="_blank">Webpixels</a>. All rights reserved.--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-md-4">--}}
{{--                <ul class="nav justify-content-center mt-3 mt-md-0">--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" href="https://dribbble.com/" target="_blank">--}}
{{--                            <i class="fab fa-dribbble"></i>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link active" href="https://instagram.com/" target="_blank">--}}
{{--                            <i class="fab fa-instagram"></i>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" href="https://github.com/" target="_blank">--}}
{{--                            <i class="fab fa-github"></i>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item ali">--}}
{{--                        <a class="nav-link" href="https://facebook.com/" target="_blank">--}}
{{--                            <i class="fab fa-facebook"></i>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--            <div class="col-md-4 text-right">--}}
{{--                <button type="button" class="btn btn-app-store btn-sm">--}}
{{--                    <i class="fab fa-google-play"></i>--}}
{{--                    <span class="btn-inner--text">Download on the</span>--}}
{{--                    <span class="btn-inner--brand">Play Store</span>--}}
{{--                </button>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</footer>--}}
{{--<!-- Core JS -->--}}
{{--<script src="{{ URL::asset('js/app.js') }}"></script>--}}

{{--<!-- Core JS - includes jquery, bootstrap, popper, in-view and sticky-kit -->--}}
{{--<script src="{{ asset('js/purpose.core.js') }}"></script>--}}
{{--<!-- Page JS -->--}}
{{--<script src="{{ asset('libs/autosize/dist/autosize.min.js') }}"></script>--}}

{{--<!-- Page JS -->--}}
{{--<script src="{{ asset('libs/select2/dist/js/select2.min.js') }}"></script>--}}
{{--<script src="{{ asset('libs/flatpickr/dist/flatpickr.min.js') }}"></script>--}}

{{--<!-- Purpose JS -->--}}
{{--<script src="{{ asset('js/purpose.js') }}"></script>--}}
{{--</body>--}}

{{--</html>--}}
