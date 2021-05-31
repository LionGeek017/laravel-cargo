@extends('index')
@section('content')

    <section class="slice slice-lg pb-4">
        <div class="container">

            @include('account.navbar')

            <div class="actions-toolbar my-3">
                <h5 class="mb-1">Мои грузы: {{ $cargos->total() }}</h5>
                <p class="text-sm text-muted mb-0">Список ваших грузов</p>
            </div>

            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link {{ (!request()->has('filter') || request()->filter == 'all') ? 'active' : '' }}" href="{{ route('account.cargo', ['filter' => 'all']) }}">Все грузы</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->filter == 'actual' ? 'active' : '' }}" href="{{ route('account.cargo', ['filter' => 'actual']) }}">Актуальные</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->filter == 'archive' ? 'active' : '' }}" href="{{ route('account.cargo', ['filter' => 'archive']) }}">Архив</a>
                </li>
            </ul>
        </div>
    </section>

    <section class="slice slice-lg">
        <div class="container">
            <div class="row">
                @foreach($cargos as $cargo)
                    <div class="col col-md-6">
                        @include('cargo.parts.card')
                    </div>
                @endforeach
            </div>

            {{ $cargos->links() }}

        </div>
    </section>

@endsection
