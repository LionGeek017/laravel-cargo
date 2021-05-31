@extends('admin.blog.categories')
@section('category_content')

    <!-- Form add cargo -->
    <section class="slice slice-lg pt-3">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8">
                    <div>
                        <div class="mb-5 text-center">
                            <h6 class="h3">Новая категория</h6>
                            <p class="text-muted mb-0">Добавьте категорию в блог</p>
                        </div>
                        <span class="clearfix"></span>
                        <form enctype="multipart/form-data" role="form" class="border p-4" method="POST" action="{{ route('adminchik.categories.store') }}">
                            @csrf
                            @include('admin.blog.category-form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
