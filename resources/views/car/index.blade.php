@extends('index')
@section('content')

    @include('car.parts.form-search')

    <section class="slice pb-3">
        <div class="container">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link {{ (!request()->mode || request()->mode == 'list') ? 'active' : '' }}" href="{{ route('car.search', ['mode' => 'list']) }}"><i class="fas fa-list-ul mr-2"></i> Список</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->mode == 'map' ? 'active' : '' }}" href="{{ route('car.search', ['mode' => 'map']) }}"><i class="fas fa-map-marker-alt mr-2"></i>Карта</a>
                </li>
            </ul>
        </div>
    </section>

    @yield('car_content')

    @if(!request()->has('page'))
        <section class="slice slice-lg">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        {!! $metaTags->seo_text !!}
                    </div>
                </div>
            </div>
        </section>
    @endif

@endsection
