@extends('admin.index')
@section('content')

    <section class="slice slice-lg pb-4">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb py-2">
                    <li class="breadcrumb-item"><a class="text-dark text-underline text-sm" href="#">Блог</a></li>
                    <li class="breadcrumb-item active"><a class="text-dark text-underline text-sm" href="{{ route('adminchik.posts.index') }}">Посты</a></li>
                    <li class="breadcrumb-item active text-sm" aria-current="page">Категории</li>
                </ol>
            </nav>
        </div>
    </section>

    <section class="slice slice-lg p-0" data-offset-top="#header-main">
        <div class="container pb-5">

            <div class="actions-toolbar my-3">
                <h5 class="mb-1">{{ Route::is('adminchik.categories.edit') ? 'Категория ID:' . $category->id . ' / ' . $category->name : 'Категории' }}</h5>
                <p class="text-sm text-muted mb-0">Раздел для управления категориями блога</p>
            </div>

            <div>
                <ul class="nav nav-tabs mb-4">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('adminchik.categories.index') ? 'active' : '' }}" href="{{ route('adminchik.categories.index') }}">Категории</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('adminchik.categories.create') ? 'active' : '' }}" href="{{ route('adminchik.categories.create') }}">Добавить категорию</a>
                    </li>
                </ul>
            </div>
            @yield('category_content')
        </div>
    </section>
@endsection
