@extends('layouts.layout_index')
@section('main_content')
    <!-- Main navbar -->
    <section class="slice slice-lg pt-6 pb-3">
        <div class="container">
            <nav class="navbar navbar-main navbar-expand-lg navbar-transparent navbar-light bg-white border-bottom" id="navbar-main">
                <!-- Logo -->
                <a class="navbar-brand mr-lg-5" href="/">
                    ALGARIA
                </a>
                <!-- Navbar collapse trigger -->
                <button class="navbar-toggler pr-0" type="button" data-toggle="collapse" data-target="#navbar-main-collapse" aria-controls="navbar-main-collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Navbar nav -->
                <div class="collapse navbar-collapse" id="navbar-main-collapse">
                    <ul class="navbar-nav align-items-lg-center">
                        <!-- Home - Overview  -->

                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('cargo.search') ? 'active' : '' }}" href="{{ route('cargo.search') }}">Найти груз</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('car.search') ? 'active' : '' }}" href="{{ route('car.search') }}">Найти машину</a>
                        </li>
                        <!-- Cargo country -->
                        <li class="nav-item dropdown dropdown-animate" data-toggle="hover">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Блог</a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-arrow p-0">
                                <ul class="list-group list-group-flush">
                                    @foreach($blogCategories as $blogCategory)
                                        <li class="nav-item" data-toggle="hover">
                                            <a href="{{ route('category.index', ['category_slug' => $blogCategory->slug]) }}" class="list-group-item list-group-item-action" role="button">
                                                <div class="media d-flex align-items-center">
                                                    <img class="img-fluid rounded" width="90" src="{{ URL::asset($blogCategory->img ?? 'img/default.jpg') }}" />
                                                    <!-- Media body -->
                                                    <div class="media-body ml-3">
                                                        <h6 class="mb-1">{{ $blogCategory->name }}</h6>
                                                        <p class="mb-0">{{ $blogCategory->description }}</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item dropdown dropdown-animate" data-toggle="hover">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Помощь</a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-arrow p-0">
                                <ul class="list-group list-group-flush">
                                    <li class="nav-item" data-toggle="hover">
                                        <a href="viber://chat?number=..." class="list-group-item list-group-item-action" role="button">
                                            <div class="media d-flex align-items-center">
                                                <i class="fab fa-viber fa-3x" style="width: 50px"></i>
                                                <!-- Media body -->
                                                <div class="media-body ml-3">
                                                    <h6 class="mb-1">Viber</h6>
                                                    <p class="mb-0">Служба поддержки в Viber</p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="nav-item" data-toggle="hover">
                                        <a href="tg://resolve?domain=..." class="list-group-item list-group-item-action" role="button">
                                            <div class="media d-flex align-items-center">
                                                <i class="fab fa-telegram fa-3x" style="width: 50px"></i>
                                                <!-- Media body -->
                                                <div class="media-body ml-3">
                                                    <h6 class="mb-1">Telegram</h6>
                                                    <p class="mb-0">Служба поддержки в Telegram</p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="nav-item" data-toggle="hover">
                                        <a href="{{ route('faq.index') }}" class="list-group-item list-group-item-action" role="button">
                                            <div class="media d-flex align-items-center">
                                                <i class="fas fa-question fa-3x" style="width: 50px"></i>
                                                <!-- Media body -->
                                                <div class="media-body ml-3">
                                                    <h6 class="mb-1">FAQ</h6>
                                                    <p class="mb-0">Частозадаваемые вопросы и ответы на них</p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                    <ul class="navbar-nav align-items-lg-center ml-lg-auto">
                        <li class="nav-item mr-2">
                            <a href="{{ route('cargo.create') }}" class="nav-link d-lg-none">Разместить груз</a>
                            <a href="{{ route('cargo.create') }}" class="btn btn-sm btn-slack btn-icon rounded-pill d-none d-lg-inline-flex" data-toggle="tooltip" data-placement="left" title="">
                                <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
                                <span class="btn-inner--text">Разместить груз</span>
                            </a>
                        </li>
                        <li class="nav-item mr-0">
                            <a href="{{ route('car.create') }}" class="nav-link d-lg-none">Добавить машину</a>
                            <a href="{{ route('car.create') }}" class="btn btn-sm btn-slack btn-icon rounded-pill d-none d-lg-inline-flex" data-toggle="tooltip" data-placement="left" title="">
                                <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
                                <span class="btn-inner--text">Добавить машину</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </section>
    <section class="alert slice slice-lg p-0">
        <div class="container">
            @include('layouts.errors-die')
            @include('layouts.message-die')
        </div>
    </section>

    @yield('content')

@endsection
