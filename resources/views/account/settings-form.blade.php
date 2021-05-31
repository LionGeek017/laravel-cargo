@extends('index')
@section('content')

    <section class="slice slice-lg">
        <div class="container">

            @include('account.navbar')

            <div class="actions-toolbar my-3">
                <h5 class="mb-1">Редактировать профиль</h5>
                <p class="text-sm text-muted mb-0">Здесь можно изменить ваши данные</p>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="actions-toolbar my-1">
                        <h6 class="mb-1">Изменить пароль</h6>
                    </div>
                    <form role="form" class="border mt-3 p-4" method="POST" action="{{ route('account.settings.update_pass', ['user' => $user->id]) }}">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label class="form-control-label">Текущий пароль</label>
                            <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" value="{{ old('password') }}">
                            @error('password')
                            <small class="text-danger">
                                <strong>{{ $message }}</strong>
                            </small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Новый пароль</label>
                            <input class="form-control @error('password_new') is-invalid @enderror" type="password" name="password_new" value="{{ old('password_new') }}">
                            @error('password_new')
                            <small class="text-danger">
                                <strong>{{ $message }}</strong>
                            </small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Новый пароль еще раз</label>
                            <input class="form-control @error('password_repeat') is-invalid @enderror" type="password" name="password_repeat" value="{{ old('password_repeat') }}">
                            @error('password_repeat')
                            <small class="text-danger">
                                <strong>{{ $message }}</strong>
                            </small>
                            @enderror
                        </div>
                        <button class="btn btn-sm btn-primary btn-icon rounded-pill">
                            <span class="btn-inner--text">Сохранить</span>
                            <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
                        </button>
                    </form>
                </div>
                <div class="col-12 col-md-6">
                    <div class="actions-toolbar my-1">
                        <h6 class="mb-1">Изменить другие данные</h6>
                    </div>
                    <form role="form" class="border mt-3 p-4" method="POST" action="{{ route('account.settings.update_data', ['user' => $user->id]) }}">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label class="form-control-label">Имя</label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" placeholder="Ваше имя" name="name" value="{{ old('name', $user->name ?? '') }}">
                            @error('name')
                            <small class="text-danger">
                                <strong>{{ $message }}</strong>
                            </small>
                            @enderror
                        </div>
                        <button class="btn btn-sm btn-primary btn-icon rounded-pill">
                            <span class="btn-inner--text">Сохранить</span>
                            <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
