@extends('admin.index')
@section('content')

    <section class="slice slice-lg" data-offset-top="#header-main">
        <div class="container mt-5 pt-5">
            <div class="row justify-content-center">
                <div class="col-md-10 text-center">
                    <h1 class="lh-150 mb-3">Приветствуем в панели администратора проекта</h1>
                    <p class="lead text-muted mb-0">Ваши права доступа: <span class="font-weight-bold">@foreach(Auth::user()->roles as $role) {{ $loop->last ? $role->name : $role->name.', ' }} @endforeach</span></p>
                    <p class="lead text-muted mb-0">Творите... <i class="far fa-grin-wink"></i></p>
                </div>
            </div>
        </div>
    </section>

    <section class="slice slice-lg">
        <div class="container mt-5 pt-5">
            <div class="row">
                {{--                @foreach($cargos as $cargo)--}}
                {{--                    @include('cargo.parts.card')--}}
                {{--                @endforeach--}}
            </div>
        </div>
    </section>

@endsection
