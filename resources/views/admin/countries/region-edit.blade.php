@extends('admin.countries.index')
@section('countries_content')

    <!-- Form add cargo -->
    <section class="slice slice-lg pt-3">
        <div class="container px-0">
            <div class="row">
                <div class="col-12">
                    <div class="mb-2">
                        <h6 class="h5">Регион</h6>
                        <p class="text-muted mb-0">Отредактируйте данные региона</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <form enctype="multipart/form-data" role="form" class="border p-4" method="POST" action="{{ route('adminchik.regions.update', ['region' => $region->id]) }}">
                        @csrf
                        @method('PATCH')
                        @include('admin.countries.region-form')
                    </form>
                </div>
                <div class="col-md-6">
                    <div>
                        Если вы заметили, что загрузились не все города в данный регион, нажмите кнопку ниже для повторной загрузки.
                        Система добавит в базу города, которых сейчас нету. Если проблема повториться, воспользуйтесь ручным добавлением:
                        <p>
                            <a href="{{ route('adminchik.cities.create', ['country_id' => $region->country_id, 'region_id' => $region->id]) }}">Добавить город</a>
                        </p>
                        <form enctype="multipart/form-data" role="form" method="POST" action="{{ route('adminchik.regions.update', ['region' => $region->id]) }}">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="renew" value="1">
                            <button type="submit" class="btn btn-sm btn-primary mt-2">Обновить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
