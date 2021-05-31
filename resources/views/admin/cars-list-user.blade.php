@extends('admin.index')
@section('content')

    <section class="slice slice-lg pb-4">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb py-2">
                    <li class="breadcrumb-item"><a class="text-dark text-underline text-sm" href="{{ route('adminchik.cars.index') }}">Машины</a></li>
                    <li class="breadcrumb-item active"><a class="text-dark text-underline text-sm" href="{{ route('adminchik.users.show', ['user' => request()->user_id]) }}">Пользователь ID: {{ request()->user_id }}</a></li>
                    <li class="breadcrumb-item active text-sm" aria-current="page">Список машин</li>
                </ol>
            </nav>
        </div>
    </section>

    <section class="slice slice-lg p-0" data-offset-top="#header-main">
        <div class="container">

            <div class="actions-toolbar my-3">
                <h5 class="mb-1">Машин у пользователя: {{ $cars->total() }}</h5>
                <p class="text-sm text-muted mb-0">Список машин пользователя {{ $userCar->name }}</p>
            </div>

            @include('admin.layouts.cars-table')
        </div>
    </section>
@endsection
