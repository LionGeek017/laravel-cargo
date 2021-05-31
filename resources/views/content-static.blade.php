@extends('index')
@section('content')

    <section class="slice slice-lg pb-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="mb-5 text-center">
                        <h3 class=" mt-4">{{ $content->name }}</h3>
                        <div class="fluid-paragraph mt-3">
                            <p class="lead lh-180">{{ $content->meta_description }}</p>
                        </div>
                    </div>
                    <article>
                        {!! $content->content !!}
                    </article>
                </div>
            </div>
        </div>
    </section>

@endsection
