@extends('index')
@section('content')

    <!-- Form add cargo -->
    <section class="slice slice-lg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8">
                    <div>
                        <div class="mb-5 text-center">
                            <h6 class="h3">Редактировать транспорт</h6>
                            <p class="text-muted mb-0">Добавьте свой автомобиль и зарабатывайте на перевозках</p>
                        </div>
                        @cannot('update', $formData->car)
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Нет прав!</strong>
                            </div>
                        @endcannot
                        <span class="clearfix"></span>
                        <form role="form" class="border" method="POST" action="{{ route('car.update', ['car' => $formData->car->id]) }}">
                            @csrf
                            @method('PATCH')
                            @include('car.parts.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
