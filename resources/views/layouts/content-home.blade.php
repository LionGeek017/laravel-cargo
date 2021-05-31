@extends('index')
@section('content')

    <section class="slice slice-lg pt-0" data-offset-top="#header-main">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-9">
                    {!! $metaTags->slogan_top !!}
                </div>
            </div>
        </div>
    </section>

    <section class="slice slice-lg">
        <div class="container">
            <ul class="nav nav-tabs mb-4">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('index') }}">
                        <span class="mr-2"><i class="fas fa-boxes"></i></span>
                        Новые грузы
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cargo.search') }}">
                        <span class="mr-2"><i class="fas fa-search"></i></span>
                        Поиск
                    </a>
                </li>
            </ul>
            <div class="row">
                @foreach($cargos as $cargo)
                    <div class="col-12 col-lg-6">
                        @include('cargo.parts.card')
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="slice slice-lg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    {!! $metaTags->seo_text !!}
                </div>
            </div>
        </div>
    </section>

@endsection
