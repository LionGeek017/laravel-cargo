@extends('admin.index')
@section('content')

    <section class="slice slice-lg pb-4">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb py-2">
                    <li class="breadcrumb-item"><a class="text-dark text-underline text-sm" href="{{ route('adminchik.index') }}">Админ</a></li>
                    <li class="breadcrumb-item active"><a class="text-dark text-underline text-sm" href="{{ route('adminchik.users.index') }}">Пользователи</a></li>
                    <li class="breadcrumb-item active text-sm" aria-current="page">Пользователь ID: {{ $user->id }}</li>
                </ol>
            </nav>
        </div>
    </section>

    <section class="slice slice-lg">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="text-left">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            @include('layouts.user-avatar', ['email' => $user->email])
                                        </div>
                                        <div class="ml-3">
                                            <h6 class="px-1 m-0 font-weight-bold text-dark">
                                                {{ $user->email }}
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    @can('edit', $user)
                                    <div class="dropdown action-item p-0 m-0">
                                        <a class="nav-link px-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="0,10"><i class="fas fa-ellipsis-h"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right p-2">
                                            <a href="{{ route('adminchik.users.edit', ['user'=>$user->id]) }}" class="dropdown-item p-0">Редактировать</a>
                                        </div>
                                    </div>
                                    @endcan
                                </div>
                            </div>
                        </div>
                        <div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-5">
                                            Имя
                                        </div>
                                        <div class="col-7">
                                            {{ $user->name }}
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-5">
                                            Email
                                        </div>
                                        <div class="col-7">
                                            {{ $user->email }}
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-5">
                                            Телефон
                                        </div>
                                        <div class="col-7">
                                            {{ $user->phone }}
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-5">
                                            Страна
                                        </div>
                                        <div class="col-7">
                                            {{ Str::upper($user->country) }}
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-5">
                                            Дата регистрации
                                        </div>
                                        <div class="col-7">
                                            {{ $user->created_at }}
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-5">
                                    Грузы
                                </div>
                                <div class="col-7">
                                    <a href="{{ route('adminchik.cargos.index', ['user_id' => $user->id]) }}">{{ $user->cargos->count() }} {{ RusEnding($user->cargos->count(), 'груз', 'груза', 'грузов') }}</a>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-5">
                                    Машины
                                </div>
                                <div class="col-7">
                                    <a href="{{ route('adminchik.cars.index', ['user_id' => $user->id]) }}">{{ $user->cars->count() }} {{ RusEnding($user->cars->count(), 'автомобиль', 'автомобиля', 'автомобилей') }}</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>












{{--    Просмотр юзера с ID: {{ $user->id }}--}}
{{--    <br/>--}}
{{--    Автомобилей: {{ $user->cars->count() }}--}}
{{--    <br/>--}}
{{--    Грузов: {{ $user->cargos->count() }}--}}
@endsection
