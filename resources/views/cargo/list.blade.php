@extends('cargo.index')
@section('cargo_content')
    <section class="slice">
        <div class="container">
            <!--filter-->
            <nav class="navbar navbar-horizontal navbar-expand-lg navbar-dark shadow">
                <div class="container">
                    <ul class="nav justify-content-start nav-pills nav-fill">
                        <li class="nav-item">
                            <a class="nav-link btn-outline-info {{ request('order') == 'date' ? 'active' : '' }}"
                               href="{{ route('cargo.search', ['order'=>'date', $urlSearchOrder]) }}">Дата</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn-outline-info {{ request('order') == 'distance' ? 'active' : '' }}"
                               href="{{ route('cargo.search', ['order'=>'distance', $urlSearchOrder]) }}">Расстояние</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn-outline-info {{ request('order') == 'price' ? 'active' : '' }}"
                               href="{{ route('cargo.search', ['order'=>'price', $urlSearchOrder]) }}">Оплата</a>
                        </li>
                    </ul>
                    <ul class="nav justify-content-end nav-pills nav-fill">
                        <li class="nav-item">
                            <a class="nav-link btn-outline-info {{ request('direction') == 'asc' ? 'active' : '' }}"
                               href="{{ route('cargo.search', ['direction'=>'asc', $urlSearchDirection]) }}">
                                <i class="fas fa-sort-amount-up"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn-outline-info {{ request('direction') == 'desc' ? 'active' : '' }}"
                               href="{{ route('cargo.search', ['direction'=>'desc', $urlSearchDirection]) }}">
                                <i class="fas fa-sort-amount-down"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </section>

    <section class="slice slice-lg">
        <div class="container">
            <div class="row">
                @foreach($cargos as $cargo)
                    <div class="col-12 col-lg-6">
                        @include('cargo.parts.card')
                    </div>
                @endforeach
            </div>
            {{ $cargos->total() > 0 ? $cargos->links() : '' }}
        </div>
    </section>
@endsection
