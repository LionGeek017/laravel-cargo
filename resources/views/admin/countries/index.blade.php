@extends('admin.index')
@section('content')
    <section class="slice slice-lg p-0" data-offset-top="#header-main">
        <div class="container pb-5">

            <div class="actions-toolbar my-3">
                <h5 class="mb-1">Страны</h5>
                <p class="text-sm text-muted mb-0">Раздел для управления странами и регионами</p>
            </div>

            <div class="actions-toolbar my-3">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('adminchik/countries*') ? 'active' : '' }}" href="{{ route('adminchik.countries.index') }}">Все страны</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('adminchik/regions*') ? 'active' : '' }}" href="{{ route('adminchik.regions.index') }}">Регионы</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('adminchik/cities*') ? 'active' : '' }}" href="{{ route('adminchik.cities.index') }}">Города</a>
                    </li>
                    @if(Request::is('adminchik/countries*'))
                        <li class="nav-item ml-auto">
                            <a class="nav-link {{ Route::is('adminchik.countries.create') ? 'active' : '' }}" href="{{ route('adminchik.countries.create') }}">Добавить страну</a>
                        </li>
                    @elseif(Request::is('adminchik/regions*'))
                        <li class="nav-item ml-auto">
                            <a class="nav-link {{ Route::is('adminchik.regions.create') ? 'active' : '' }}" href="{{ route('adminchik.regions.create') }}">Добавить регион</a>
                        </li>
                    @elseif(Request::is('adminchik/cities*'))
                        <li class="nav-item ml-auto">
                            <a class="nav-link {{ Route::is('adminchik.cities.create') ? 'active' : '' }}" href="{{ route('adminchik.cities.create') }}">Добавить город</a>
                        </li>
                    @endif
                </ul>
            </div>

            @yield('countries_content')
        </div>
    </section>
@endsection
