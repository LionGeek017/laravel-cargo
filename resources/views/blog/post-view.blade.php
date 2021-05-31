@extends('index')
@section('content')

    @include('blog.categories-tabs')

    <section class="slice slice-lg pb-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div>
                        <h1>{{ $post->title }}</h1>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="badge badge-soft-success">{{ $post->category->name }}</span>
                                @if(!$post->status)
                                    <span class="badge badge-soft-danger">Пост неактивен</span>
                                @endif
                            </div>
                            <div>
                                <small>
                                    {{ \Carbon\Carbon::now()->subSeconds($dateUnix - strtotime($post->created_at))->diffForHumans() }}
                                    @can('optional', $post)
                                        <a class="text-muted ml-2" href="{{ route('adminchik.posts.edit', ['post' => $post->id]) }}" target="_blank"><i class="fas fa-edit"></i></a>
                                    @endcan
                                </small>
                            </div>
                        </div>
                    </div>
                    <article>
                        <figure class="figure text-center w-100">
                            <img alt="Image placeholder" src="{{ URL::asset($post->img ?? '/img/default.jpg') }}" class="img-fluid rounded">
                            <figcaption class="mt-3 text-muted text-left">{!! $post->text_short !!}</figcaption>
                        </figure>
                        {!! $post->text_full !!}
                    </article>
                </div>
            </div>
        </div>
    </section>

@endsection
