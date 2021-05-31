@extends('admin.index')
@section('content')

    <section class="slice slice-lg pb-4">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb py-2">
                    <li class="breadcrumb-item"><a class="text-dark text-underline text-sm" href="{{ route('adminchik.cargos.index') }}">Грузы</a></li>
                    <li class="breadcrumb-item active"><a class="text-dark text-underline text-sm" href="{{ route('adminchik.users.show', ['user' => request()->user_id]) }}">Пользователь ID: {{ request()->user_id }}</a></li>
                    <li class="breadcrumb-item active text-sm" aria-current="page">Список грузов</li>
                </ol>
            </nav>
        </div>
    </section>

    <section class="slice slice-lg p-0" data-offset-top="#header-main">
        <div class="container pb-5">

            <div class="actions-toolbar my-3">
                <h5 class="mb-1">Грузов у пользователя: {{ $cargos->total() }}</h5>
                <p class="text-sm text-muted mb-0">Список грузов пользователя {{ $userCargo->name }}</p>
            </div>

            @include('admin.layouts.cargos-table')
        </div>
    </section>
@endsection
