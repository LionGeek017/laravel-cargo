@extends('admin.countries.index')
@section('countries_content')

    <div class="table-responsive">
        <table class="table table-cards align-items-center">
            <thead>
            <tr>
                <th scope="col" class="sort">ID</th>
                <th scope="col" class="sort">Город</th>
                <th scope="col" class="sort">Страна</th>
                <th scope="col" class="sort">VK API</th>
                <th scope="col" class="sort">GPS</th>
                <th scope="col" class="sort">Даты</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody class="list">
            @foreach($cities as $city)
                @include('admin.countries.city-tr')
            @endforeach
            </tbody>
        </table>
    </div>

    {{ $cities->total() > 0 ? $cities->links() : '' }}

    @if($cities->count() == 0)
        @include('layouts.no-information')
    @endif

@endsection
