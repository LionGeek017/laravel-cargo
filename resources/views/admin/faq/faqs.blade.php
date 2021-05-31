@extends('admin.index')
@section('content')
    <section class="slice slice-lg p-0" data-offset-top="#header-main">
        <div class="container pb-5">

            <div class="actions-toolbar my-3">
                <h5 class="mb-1">Вопросы и ответы на них</h5>
                <p class="text-sm text-muted mb-0">Раздел для ответов на популярные вопросы</p>
            </div>

            <div class="actions-toolbar my-3">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('adminchik.faqs.index') ? 'active' : '' }}" href="{{ route('adminchik.faqs.index') }}">Список</a>
                    </li>
                    <li class="nav-item ml-auto">
                        <a class="nav-link {{ Route::is('adminchik.faqs.create') ? 'active' : '' }}" href="{{ route('adminchik.faqs.create') }}">Добавить новый вопрос/ответ</a>
                    </li>
                </ul>
            </div>
            @yield('faq_content')
        </div>
    </section>
@endsection
