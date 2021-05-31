@extends('admin.index')
@section('content')

    <section class="slice slice-lg p-0" data-offset-top="#header-main">
        <div class="container pb-5">

            <div class="actions-toolbar my-3">
                <h5 class="mb-1">{{ Route::is('adminchik.subscriptions.edit') ? 'Подписка ID:' . $post->id . ' / ' . $post->title : 'Подписки' }}</h5>
                <p class="text-sm text-muted mb-0">Раздел для управления подписками</p>
            </div>

            <div class="actions-toolbar my-3">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('adminchik.subscriptions.index') ? 'active' : '' }}" href="{{ route('adminchik.subscriptions.index') }}">Подписки</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('adminchik.history.index') ? 'active' : '' }}" href="{{ route('adminchik.history.index') }}">История подписок</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('adminchik.subscriptions.create') ? 'active' : '' }}" href="{{ route('adminchik.subscriptions.create') }}">Создать подписку</a>
                    </li>
                    <li class="nav-item ml-auto">
                        <a class="nav-link {{ Route::is('adminchik.history.create') ? 'active' : '' }}" href="{{ route('adminchik.history.create') }}">Подарить подписку</a>
                    </li>
                </ul>
            </div>
            @yield('subscription_content')
        </div>
    </section>
@endsection
