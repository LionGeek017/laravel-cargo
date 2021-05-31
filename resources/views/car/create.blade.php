@extends('index')
@section('content')

    <!-- Form add cargo -->
    <section class="slice slice-lg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8">
                    <div>
                        <div class="mb-5 text-center">
                            <h6 class="h3">Разместить транспорт</h6>
                            <p class="text-muted mb-0">Добавьте свой автомобиль и зарабатывайте на перевозках</p>
                        </div>
                        <span class="clearfix"></span>
                        <form role="form" class="border" method="POST" action="{{ route('car.store') }}">
                            @csrf
                            @include('car.parts.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
