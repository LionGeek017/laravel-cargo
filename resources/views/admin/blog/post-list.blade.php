@extends('admin.blog.posts')
@section('post_content')

    <div class="table-responsive">
        <table class="table table-cards align-items-center">
            <thead>
            <tr>
                <th scope="col" class="sort">ID</th>
                <th scope="col" class="sort">Название</th>
                <th scope="col" class="sort">Картинка</th>
                <th scope="col" class="sort">Категория</th>
                <th scope="col" class="sort">Мета теги</th>
                <th scope="col" class="sort">Статус</th>
                <th scope="col" class="sort">Даты</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody class="list">
            @foreach($posts as $post)
                @include('admin.blog.post-tr')
            @endforeach
            </tbody>
        </table>
    </div>

    {{ $posts->total() > 0 ? $posts->links() : '' }}

    @if($posts->total() == 0)
        @include('layouts.no-information')
    @endif

@endsection
