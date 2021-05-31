@extends('index')
@section('content')

<div class="container mb-6">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow zindex-100 mb-0">
                <div class="card-body px-md-5 py-5">
                    <div class="mb-5">
                        <h6 class="h3">Авторизация</h6>
                        <p class="text-muted mb-0">Войдите в свою учетную запись</p>
                    </div>
                    <span class="clearfix"></span>
                    <form role="form" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label class="form-control-label">Email</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
{{--                                @error('email')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <label class="form-control-label">Пароль</label>
                                </div>
                                <div class="mb-2">
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="small text-muted text-underline--dashed border-primary">Забыли пароль?</a>
                                    @endif
                                </div>
                            </div>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                </div>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
{{--                                @error('password')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <input class="form-check-input" type="hidden" name="remember" id="remember" value="1">
                            <button type="submit" class="btn btn-block btn-primary">
                                <span class="btn-inner--text">Войти</span>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer px-md-5">
                    <small>Еще не зарегистрированы?</small>
                    <a href="{{ route('register') }}" class="small font-weight-bold">Создать аккаунт</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
