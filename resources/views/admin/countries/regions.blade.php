@extends('admin.countries.index')
@section('countries_content')

    <div class="table-responsive">
        <table class="table table-cards align-items-center">
            <thead>
            <tr>
                <th scope="col" class="sort">ID</th>
                <th scope="col" class="sort">Регион</th>
                <th scope="col" class="sort">Страна</th>
                <th scope="col" class="sort">VK API</th>
                <th scope="col" class="sort">Города</th>
                <th scope="col" class="sort">Даты</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody class="list">
            @foreach($regions as $region)
                @include('admin.countries.region-tr')
            @endforeach
            </tbody>
        </table>
    </div>

    {{ $regions->total() > 0 ? $regions->links() : '' }}

    @if($regions->count() == 0)
        @include('layouts.no-information')
    @endif

@endsection
