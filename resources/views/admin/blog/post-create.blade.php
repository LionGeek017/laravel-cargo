@extends('admin.blog.posts')
@section('post_content')

    <!-- Form add cargo -->
    <section class="slice slice-lg pt-3">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div>
                        <div class="mb-5 text-center">
                            <h6 class="h3">Новый пост</h6>
                            <p class="text-muted mb-0">Добавьте интересную статью в блог</p>
                        </div>
                        <span class="clearfix"></span>
                        <form enctype="multipart/form-data" role="form" class="border p-4" method="POST" action="{{ route('adminchik.posts.store') }}">
                            @csrf
                            @include('admin.blog.post-form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
