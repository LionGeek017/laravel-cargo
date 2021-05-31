@extends('admin.subscription.index')
@section('subscription_content')

    <div class="table-responsive">
        <table class="table table-cards align-items-center">
            <thead>
            <tr>
                <th scope="col" class="sort">ID</th>
                <th scope="col" class="sort">Название</th>
                <th scope="col" class="sort">Описание</th>
                <th scope="col" class="sort">Период</th>
                <th scope="col" class="sort">Цена</th>
                <th scope="col" class="sort">Покупки</th>
                <th scope="col" class="sort">Статус</th>
                <th scope="col" class="sort">Даты</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody class="list">
            @foreach($posts as $post)
                @include('admin.subscription.subscription-tr')
            @endforeach
            </tbody>
        </table>
    </div>

    @if($posts->count() == 0)
        @include('layouts.no-information')
    @endif

@endsection
