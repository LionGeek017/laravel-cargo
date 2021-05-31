@extends('admin.countries.index')
@section('countries_content')

    <!-- Form add cargo -->
    <section class="slice slice-lg pt-3">
        <div class="container px-0">
            <div class="row">
                <div class="col-12">
                    <div class="mb-2">
                        <h6 class="h5">Город</h6>
                        <p class="text-muted mb-0">Добавьте новый город</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <form role="form" class="border p-4" method="POST" action="{{ route('adminchik.cities.store') }}">
                        @csrf
                        @include('admin.countries.city-form')
                    </form>
                </div>
                <div class="col-md-6">
                    <div>
                        <p>Выберите страну и регион, в который хотите добавить город и заполните остальные обязательные поля формы.</p>
                        <p>Координаты "Долгота" и "Широта" можно узнать на <a class="text-underline" target="_blank" href="https://www.google.com/maps">Google Maps</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
