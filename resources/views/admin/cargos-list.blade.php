@extends('admin.index')
@section('content')
    <section class="slice slice-lg p-0" data-offset-top="#header-main">
        <div class="container pb-5">

            <div class="actions-toolbar my-3">
                <h5 class="mb-1">Грузы: {{ $cargos->total() }}</h5>
                <p class="text-sm text-muted mb-0">Раздел для управления грузами</p>
            </div>

            @include('admin.layouts.cargos-table')
        </div>
    </section>
@endsection
