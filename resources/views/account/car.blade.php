@extends('index')
@section('content')

    <section class="slice slice-lg">
        <div class="container">

            @include('account.navbar')

            <div class="actions-toolbar my-3">
                <h5 class="mb-1">Мои автомобили: {{ $cars->total() }}</h5>
                <p class="text-sm text-muted mb-0">Список вашего транспорта</p>
            </div>

            <div class="row">
                @foreach($cars as $car)
                    <div class="col col-md-6">
                        @include('car.parts.card')
                    </div>
                @endforeach
            </div>

            {{ $cars->links() }}

        </div>
    </section>

@endsection
