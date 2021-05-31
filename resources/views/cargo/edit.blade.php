@extends('index')
@section('content')

    <!-- Form add cargo -->
    <section class="slice slice-lg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-11">
                    <div>
                        <div class="mb-5 text-center">
                            <h6 class="h3">Редактировать груз</h6>
                            <p class="text-muted mb-0">Получите лучшее предложение от перевозчиков по своему грузу</p>
                        </div>

                        @cannot('update', $formData->cargo)
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Нет прав!</strong>
                            </div>
                        @endcannot

                        <span class="clearfix"></span>
                        <form role="form" class="border" method="POST" action="{{ route('cargo.update', ['id' => $formData->cargo->id]) }}">
                            @csrf
                            @method('PATCH')
                            @include('cargo.parts.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection






