@extends('admin.subscription.index')
@section('subscription_content')

    <div class="table-responsive">
        <table class="table table-cards align-items-center">
            <thead>
            <tr>
                <th scope="col" class="sort">ID</th>
                <th scope="col" class="sort">Пользователь</th>
                <th scope="col" class="sort">Подписка</th>
                <th scope="col" class="sort">Admin</th>
                <th scope="col" class="sort">Цена</th>
                <th scope="col" class="sort">Начало</th>
                <th scope="col" class="sort">Конец</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody class="list">
            @foreach($posts as $post)
                @include('admin.subscription.history-tr')
            @endforeach
            </tbody>
        </table>
    </div>

    {{ $posts->total() > 0 ? $posts->links() : '' }}

    @if($posts->count() == 0)
        @include('layouts.no-information')
    @endif

@endsection
