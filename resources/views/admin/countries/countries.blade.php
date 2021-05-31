@extends('admin.countries.index')
@section('countries_content')

    <div class="table-responsive">
        <table class="table table-cards align-items-center">
            <thead>
            <tr>
                <th scope="col" class="sort">ID</th>
                <th scope="col" class="sort">Страна</th>
                <th scope="col" class="sort">Код</th>
                <th scope="col" class="sort">VK API</th>
                <th scope="col" class="sort">Регионы</th>
                <th scope="col" class="sort">Города</th>
                <th scope="col" class="sort">Статус</th>
                <th scope="col" class="sort">Даты</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody class="list">
            @foreach($countriesAdmin as $country)
                @include('admin.countries.country-tr')
            @endforeach
            </tbody>
        </table>
    </div>

    {{ $countriesAdmin->total() > 0 ? $countriesAdmin->links() : '' }}

    @if($countriesAdmin->count() == 0)
        @include('layouts.no-information')
    @endif

@endsection
