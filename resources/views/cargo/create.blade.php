@extends('index')
@section('content')

    <!-- Form add cargo -->
    <section class="slice slice-lg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-11">
                    <div>
                        <div class="mb-5 text-center">
                            <h6 class="h3">Разместить груз</h6>
                            <p class="text-muted mb-0">Получите лучшее предложение от перевозчиков по своему грузу</p>
                        </div>
                        <span class="clearfix"></span>
                        <form role="form" class="border" method="POST" action="{{ route('cargo.store') }}">
                            @csrf
                            @include('cargo.parts.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection






