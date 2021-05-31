@extends('admin.index')
@section('content')
    <section class="slice slice-lg p-0" data-offset-top="#header-main">
        <div class="container">

            <div class="actions-toolbar my-3">
                <h5 class="mb-1">Машины: {{ $cars->total() }}</h5>
                <p class="text-sm text-muted mb-0">Раздел для управления машинами</p>
            </div>

            @include('admin.layouts.cars-table')
        </div>
    </section>
@endsection
