@extends('admin.index')
@section('content')

    <section class="slice slice-lg pb-4">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb py-2">
                    <li class="breadcrumb-item"><a class="text-dark text-underline text-sm" href="#">Блог</a></li>
                    <li class="breadcrumb-item active"><a class="text-dark text-underline text-sm" href="{{ route('adminchik.categories.index') }}">Категории</a></li>
                    <li class="breadcrumb-item active text-sm" aria-current="page">Посты</li>
                </ol>
            </nav>
        </div>
    </section>

    <section class="slice slice-lg p-0" data-offset-top="#header-main">
        <div class="container pb-5">

            <div class="actions-toolbar my-3">
                <h5 class="mb-1">{{ Route::is('adminchik.posts.edit') ? 'Пост ID:' . $post->id . ' / ' . $post->title : 'Посты' }}</h5>
                <p class="text-sm text-muted mb-0">Раздел для управления статьями в блоге</p>
            </div>

            <div class="actions-toolbar my-3">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link {{ (Route::is('adminchik.posts.index') && !request()->category_id) ? 'active' : '' }}" href="{{ route('adminchik.posts.index') }}">Все: {{ $postsCount }}</a>
                    </li>
                    @foreach($categories as $category)
                        <li class="nav-item">
                            <a class="nav-link {{ (request()->category_id == $category->id || (Route::is('adminchik.posts.edit') && $post->category->id == $category->id)) ? 'active' : '' }}" href="{{ route('adminchik.posts.index', ['category_id' => $category->id]) }}">{{ $category->name }}: {{ $category->posts->count() }}</a>
                        </li>
                    @endforeach
                    <li class="nav-item ml-auto">
                        <a class="nav-link {{ Route::is('adminchik.posts.create') ? 'active' : '' }}" href="{{ route('adminchik.posts.create') }}">Создать пост</a>
                    </li>
                </ul>
            </div>
            @yield('post_content')
        </div>
    </section>
@endsection
