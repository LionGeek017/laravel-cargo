<div class="mb-5 mb-lg-0" data-animate-hover="1">
    <div class="animate-this">
        <a href="{{ route('post.show', ['category_slug' => $post->category->slug, 'id' => $post->id, 'post_slug' => $post->slug]) }}">
            <img alt="Image placeholder" class="img-fluid rounded shadow" src="{{ URL::asset($post->img ?? '/img/default.jpg') }}">
        </a>
    </div>
    <div class="pt-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <span class="badge badge-soft-success">{{ $post->category->name }}</span>
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

        <h5 class="pt-4"><a href="{{ route('post.show', ['category_slug' => $post->category->slug, 'id' => $post->id, 'post_slug' => $post->slug]) }}">{{ $post->title }}</a></h5>
        <div class="mt-2">{!! $post->text_short !!}</div>
    </div>
</div>
