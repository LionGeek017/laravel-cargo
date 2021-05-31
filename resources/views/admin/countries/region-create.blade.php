@extends('admin.countries.index')
@section('countries_content')

    <!-- Form add cargo -->
    <section class="slice slice-lg pt-3">
        <div class="container px-0">
            <div class="row">
                <div class="col-12">
                    <div class="mb-2">
                        <h6 class="h5">Регион</h6>
                        <p class="text-muted mb-0">Добавьте новый регион</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <form role="form" class="border p-4" method="POST" action="{{ route('adminchik.regions.store') }}">
                        @csrf
                        @include('admin.countries.region-form')
                    </form>
                </div>
                <div class="col-md-6">
                    <div>
                        Для загрузки городов указанного вами региона потребуется несколько минут или больше. Вам не обязательно ждать это время, можете заниматься своими делами, а система сама все сделает.
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
