@extends('admin.countries.index')
@section('countries_content')

    <!-- Form add cargo -->
    <section class="slice slice-lg pt-3">
        <div class="container px-0">
            <div class="row">
                <div class="col-12">
                    <div class="mb-2">
                        <h6 class="h5">Город</h6>
                        <p class="text-muted mb-0">Отредактируйте данные города</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <form enctype="multipart/form-data" role="form" class="border p-4" method="POST" action="{{ route('adminchik.cities.update', ['city' => $city->id]) }}">
                        @csrf
                        @method('PATCH')
                        @include('admin.countries.city-form')
                    </form>
                </div>
                <div class="col-md-6">
                    <div>
                        Здесь можно изменить название города, регион и даже страну
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
