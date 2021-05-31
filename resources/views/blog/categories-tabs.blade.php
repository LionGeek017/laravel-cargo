<section class="slice slice-lg pb-4">
    <div class="container">
        <ul class="nav nav-tabs mb-4">
            <li class="nav-item">
                <a class="nav-link {{ Route::is('post.index') ? 'active' : '' }}" href="{{ route('post.index') }}">Все посты</a>
            </li>
            @foreach($blogCategories as $blogCategory)
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('blog/' . $blogCategory->slug . '*') ? 'active' : '' }}" href="{{ route('category.index', ['category_slug' => $blogCategory->slug]) }}">{{ $blogCategory->name }}</a>
                </li>
            @endforeach
        </ul>
    </div>
</section>
