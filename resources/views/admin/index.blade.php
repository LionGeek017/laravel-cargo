@extends('layouts.layout_index')
@section('main_content')

    <section class="slice slice-lg pt-6 pb-4">
        <div class="container">
            <!-- Main navbar -->
            <nav class="navbar navbar-main navbar-expand-lg navbar-transparent navbar-light bg-white border-bottom" id="navbar-main">
                    <!-- Logo -->
                    <a class="navbar-brand mr-lg-5" href="/adminchik">
                        Admin
                    </a>
                    <!-- Navbar collapse trigger -->
                    <button class="navbar-toggler pr-0" type="button" data-toggle="collapse" data-target="#navbar-main-collapse" aria-controls="navbar-main-collapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <!-- Navbar nav -->
                    <div class="collapse navbar-collapse" id="navbar-main-collapse">
                        <ul class="navbar-nav align-items-lg-center">
                            @can('view-users')
                            <li class="nav-item">

                                <a class="nav-link {{ Request::is('adminchik/users*') ? 'active' : null }}" href="{{ route('adminchik.users.index') }}">Пользователи</a>
                            </li>
                            @endcan
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('adminchik/cargos*') ? 'active' : null }}" href="{{ route('adminchik.cargos.index') }}">Грузы</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('adminchik/cars*') ? 'active' : null }}" href="{{ route('adminchik.cars.index') }}">Машины</a>
                            </li>
                            <li class="nav-item dropdown dropdown-animate" data-toggle="hover">
                                <a class="nav-link dropdown-toggle {{ Request::is('adminchik/blog*') ? 'active' : null }}" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Блог</a>
                                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-arrow p-0">
                                    <ul class="list-group list-group-flush">
                                        <li class="nav-item" data-toggle="hover">
                                            <a href="{{ route('adminchik.posts.index') }}" class="list-group-item list-group-item-action" role="button">
                                                <div class="media d-flex align-items-center">
                                                    <!-- SVG icon -->
                                                    <figure style="width: 50px;">
                                                        <img alt="Image placeholder" src="{{ URL::asset('img/icons/essential/detailed/Book.svg') }}" class="svg-inject img-fluid" style="height: 50px;">
                                                    </figure>
                                                    <!-- Media body -->
                                                    <div class="media-body ml-3">
                                                        <h6 class="mb-1">Посты</h6>
                                                        <p class="mb-0">Показать все посты</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="nav-item" data-toggle="hover">
                                            <a href="{{ route('adminchik.posts.create') }}" class="list-group-item list-group-item-action" role="button">
                                                <div class="media d-flex align-items-center">
                                                    <!-- SVG icon -->
                                                    <figure style="width: 50px;">
                                                        <img alt="Image placeholder" src="{{ URL::asset('img/icons/essential/detailed/Apps.svg') }}" class="svg-inject img-fluid" style="height: 50px;">
                                                    </figure>
                                                    <!-- Media body -->
                                                    <div class="media-body ml-3">
                                                        <h6 class="mb-1">Создать пост</h6>
                                                        <p class="mb-0">Создать новый пост</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="nav-item" data-toggle="hover">
                                            <a href="{{ route('adminchik.categories.index') }}" class="list-group-item list-group-item-action" role="button">
                                                <div class="media d-flex align-items-center">
                                                    <!-- SVG icon -->
                                                    <figure style="width: 50px;">
                                                        <img alt="Image placeholder" src="{{ URL::asset('img/icons/essential/detailed/Code.svg') }}" class="svg-inject img-fluid" style="height: 50px;">
                                                    </figure>
                                                    <!-- Media body -->
                                                    <div class="media-body ml-3">
                                                        <h6 class="mb-1">Категории</h6>
                                                        <p class="mb-0">Показать категории</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="nav-item" data-toggle="hover">
                                            <a href="{{ route('adminchik.categories.create') }}" class="list-group-item list-group-item-action" role="button">
                                                <div class="media d-flex align-items-center">
                                                    <!-- SVG icon -->
                                                    <figure style="width: 50px;">
                                                        <img alt="Image placeholder" src="{{ URL::asset('img/icons/essential/detailed/Apps.svg') }}" class="svg-inject img-fluid" style="height: 50px;">
                                                    </figure>
                                                    <!-- Media body -->
                                                    <div class="media-body ml-3">
                                                        <h6 class="mb-1">Создать категорию</h6>
                                                        <p class="mb-0">Добавить новую категорию</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item dropdown dropdown-animate" data-toggle="hover">
                                <a class="nav-link dropdown-toggle {{ Request::is('adminchik/subscriptions*') ? 'active' : null }}" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Подписки</a>
                                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-arrow p-0">
                                    <ul class="list-group list-group-flush">
                                        <li class="nav-item" data-toggle="hover">
                                            <a href="{{ route('adminchik.subscriptions.index') }}" class="list-group-item list-group-item-action" role="button">
                                                <div class="media d-flex align-items-center">
                                                    <!-- SVG icon -->
                                                    <i class="far fa-list-alt fa-3x" style="width: 50px"></i>
                                                    <!-- Media body -->
                                                    <div class="media-body ml-3">
                                                        <h6 class="mb-1">Все подписки</h6>
                                                        <p class="mb-0">Список и настройки подписок</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="nav-item" data-toggle="hover">
                                            <a href="{{ route('adminchik.history.index') }}" class="list-group-item list-group-item-action" role="button">
                                                <div class="media d-flex align-items-center">
                                                    <!-- SVG icon -->
                                                    <i class="fas fa-shopping-basket fa-3x" style="width: 50px"></i>
                                                    <!-- Media body -->
                                                    <div class="media-body ml-3">
                                                        <h6 class="mb-1">История подписок</h6>
                                                        <p class="mb-0">Список подписок пользователей</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item dropdown dropdown-animate" data-toggle="hover">
                                <a class="nav-link dropdown-toggle {{ Request::is('adminchik/countries*') ? 'active' : null }}" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Страны</a>
                                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-arrow p-0">
                                    <ul class="list-group list-group-flush">
                                        <li class="nav-item" data-toggle="hover">
                                            <a href="{{ route('adminchik.countries.index') }}" class="list-group-item list-group-item-action" role="button">
                                                <div class="media d-flex align-items-center">
                                                    <!-- SVG icon -->
                                                    <i class="fas fa-globe-americas fa-3x" style="width: 50px"></i>
                                                    <!-- Media body -->
                                                    <div class="media-body ml-3">
                                                        <h6 class="mb-1">Список стран</h6>
                                                        <p class="mb-0">Показать все страны, регионы и города</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="nav-item" data-toggle="hover">
                                            <a href="{{ route('adminchik.countries.create') }}" class="list-group-item list-group-item-action" role="button">
                                                <div class="media d-flex align-items-center">
                                                    <!-- SVG icon -->
                                                    <i class="fas fa-plus fa-3x" style="width: 50px"></i>
                                                    <!-- Media body -->
                                                    <div class="media-body ml-3">
                                                        <h6 class="mb-1">Добавить страну</h6>
                                                        <p class="mb-0">Добавить новую страну и регионы</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item dropdown dropdown-animate" data-toggle="hover">
                                <a class="nav-link dropdown-toggle {{
                                    (Request::is('adminchik/metatags*') || Request::is('adminchik/contents*') || Request::is('adminchik/faqs*')) ? 'active' : null
                                    }}" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Контент</a>
                                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-arrow p-0">
                                    <ul class="list-group list-group-flush">
                                        <li class="nav-item" data-toggle="hover">
                                            <a href="{{ route('adminchik.metatags.edit', ['metatag' => 1]) }}" class="list-group-item list-group-item-action" role="button">
                                                <div class="media d-flex align-items-center">
                                                    <!-- SVG icon -->
                                                    <i class="fas fa-code fa-3x" style="width: 50px"></i>
                                                    <!-- Media body -->
                                                    <div class="media-body ml-3">
                                                        <h6 class="mb-1">Мета теги и СЕО тексты</h6>
                                                        <p class="mb-0">Редактировать title, description, keywords</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="nav-item" data-toggle="hover">
                                            <a href="{{ route('adminchik.faqs.index') }}" class="list-group-item list-group-item-action" role="button">
                                                <div class="media d-flex align-items-center">
                                                    <!-- SVG icon -->
                                                    <i class="fas fa-question fa-3x" style="width: 50px"></i>
                                                    <!-- Media body -->
                                                    <div class="media-body ml-3">
                                                        <h6 class="mb-1">FAQ</h6>
                                                        <p class="mb-0">Часто задаваемые вопросы и ответы на них</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        @foreach($pagesStatic as $page)
                                            <li class="nav-item" data-toggle="hover">
                                                <a href="{{ route('adminchik.contents.index', ['slug' => $page->slug]) }}" class="list-group-item list-group-item-action" role="button">
                                                    <div class="media d-flex align-items-center">
                                                        <!-- SVG icon -->
                                                        <i class="fas fa-link fa-3x"></i>
                                                        <!-- Media body -->
                                                        <div class="media-body ml-3">
                                                            <h6 class="mb-1">{{ $page->name }}</h6>
                                                            <p class="mb-0">{{ $page->meta_title ?? 'Статическая станица' }}</p>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                        @endforeach
{{--                                        <li class="nav-item" data-toggle="hover">--}}
{{--                                            <a href="" class="list-group-item list-group-item-action" role="button">--}}
{{--                                                <div class="media d-flex align-items-center">--}}
{{--                                                    <!-- SVG icon -->--}}
{{--                                                    <i class="fas fa-plus fa-3x" style="width: 50px"></i>--}}
{{--                                                    <!-- Media body -->--}}
{{--                                                    <div class="media-body ml-3">--}}
{{--                                                        <h6 class="mb-1">Добавить страницу</h6>--}}
{{--                                                        <p class="mb-0">Добавить новую статическую страницу</p>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
                                    </ul>
                                </div>
                            </li>
                        </ul>
                        <ul class="navbar-nav align-items-lg-center ml-lg-auto">
                            <li class="nav-item">
                                <a class="nav-link" target="_blank" href="{{ route('index') }}">На сайт</a>
                            </li>
                        </ul>
                    </div>
            </nav>
        </div>
    </section>
    <section class="alert slice slice-lg p-0 m-0">
        <div class="container">
            @include('layouts.errors-die')
            @include('layouts.message-die')
        </div>
    </section>

    @yield('content')

@endsection
