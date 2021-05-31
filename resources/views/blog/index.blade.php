@extends('index')
@section('content')

    @include('blog.categories-tabs')

    <section class="slice slice-lg pb-4">
        <div class="container">
            <div class="row">
                @foreach($posts as $post)
                    <div class="col-lg-4">
                        @include('blog.post-card')
                    </div>
                @endforeach
            </div>

            {{ $posts->total() > 0 ? $posts->links() : '' }}

            @if($posts->total() == 0)
                @include('layouts.no-information')
            @endif
        </div>
    </section>

@endsection
