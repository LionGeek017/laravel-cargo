@extends('admin.blog.categories')
@section('category_content')

    <div class="table-responsive">
        <table class="table table-cards align-items-center">
            <thead>
            <tr>
                <th scope="col" class="sort">ID</th>
                <th scope="col" class="sort">Название</th>
                <th scope="col" class="sort">Картинка</th>
                <th scope="col" class="sort">URL</th>
                <th scope="col" class="sort">Посты</th>
                <th scope="col" class="sort">Мета теги</th>
                <th scope="col" class="sort">Даты</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody class="list">
            @foreach($categories as $category)
                @include('admin.blog.category-tr')
            @endforeach
            </tbody>
        </table>
    </div>

    {{ $categories->total() > 0 ? $categories->links() : '' }}

    @if($categories->total() == 0)
        @include('layouts.no-information')
    @endif

@endsection
