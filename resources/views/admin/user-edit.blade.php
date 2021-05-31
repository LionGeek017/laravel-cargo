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
            <div class="actions-toolbar my-3">
                <h5 class="mb-1">Редактирование</h5>
                <p class="text-sm text-muted mb-0">Здесь можно изменить данные пользователя</p>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <form role="form" method="POST" action="{{ route('adminchik.users.update', ['user' => $user->id]) }}">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label class="form-control-label">Имя</label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" placeholder="Петро" value="{{ old('name', $user->name ?? '') }}">
                            @error('name')
                            <small class="text-danger">
                                <strong>{{ $message }}</strong>
                            </small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Email</label>
                            <input class="form-control @error('email') is-invalid @enderror" type="text" name="email" placeholder="mail@mail.com" value="{{ old('email', $user->email ?? '') }}">
                            @error('email')
                            <small class="text-danger">
                                <strong>{{ $message }}</strong>
                            </small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Роли</label>
                            @foreach($roles as $role)
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="role-{{ $role->id }}" name="role[]"
                                           value="{{ $role->id }}" {{ is_array(old('role')) ? (in_array($role->id, old('role')) ? 'checked' : '') : ($user->roles->find($role->id) ? 'checked' : '') }}>
                                    <label class="custom-control-label" for="role-{{ $role->id }}">{{ $role->name }}</label>
                                </div>
                            @endforeach
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Статус</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch1" name="status" {{ (old('status') || $user->status == 1) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="customSwitch1"></label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary btn-icon rounded-pill">
                            <span class="btn-inner--text">Сохранить</span>
                        </button>
                    </form>
                </div>
                <div class="col-12 col-md-6">
                </div>
            </div>
        </div>
    </section>
@endsection
