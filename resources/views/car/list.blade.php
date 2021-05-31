@extends('car.index')
@section('car_content')
    <section class="slice">
        <div class="container">
            <!--filter-->
            <nav class="navbar navbar-horizontal navbar-expand-lg navbar-dark shadow">
                <div class="container">
                    <ul class="nav justify-content-start nav-pills nav-fill">
                        <li class="nav-item">
                            <a class="nav-link btn-outline-info {{ request('order') == 'date' ? 'active' : '' }}"
                               href="{{ route('car.search', ['order'=>'date', $urlSearchOrder]) }}">Дата</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn-outline-info {{ request('order') == 'weight' ? 'active' : '' }}"
                               href="{{ route('car.search', ['order'=>'weight', $urlSearchOrder]) }}">Тонаж</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn-outline-info {{ request('order') == 'status' ? 'active' : '' }}"
                               href="{{ route('car.search', ['order'=>'status', $urlSearchOrder]) }}">Статус</a>
                        </li>
                    </ul>
                    <ul class="nav justify-content-end nav-pills nav-fill">
                        <li class="nav-item">
                            <a class="nav-link btn-outline-info {{ request('direction') == 'asc' ? 'active' : '' }}"
                               href="{{ route('car.search', ['direction'=>'asc', $urlSearchDirection]) }}">
                                <i class="fas fa-sort-amount-up"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn-outline-info {{ request('direction') == 'desc' ? 'active' : '' }}"
                               href="{{ route('car.search', ['direction'=>'desc', $urlSearchDirection]) }}">
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
                @foreach($cars as $car)
                    <div class="col col-md-6">
                        @include('car.parts.card')
                    </div>
                @endforeach
            </div>
            {{ $cars->total() > 0 ? $cars->links() : '' }}
        </div>
    </section>
@endsection
