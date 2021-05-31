@extends('index')
@section('content')

    <section class="slice slice-lg">
        <div class="container">
            <div class="mb-5 text-center">
                <h3 class=" mt-4">FAQ</h3>
                <div class="fluid-paragraph mt-3">
                    <p class="lead lh-180">Здесь вы найдете ответы на частозадаваемые вопросы</p>
                </div>
            </div>
            @if($faqs->count() > 0)
                <div class="row">
                    @foreach($faqs as $faq)
                        <div class="col-lg-6">
                            <div class="card hover-shadow-lg hover-scale-110">
                                <div class="card-body py-4">
                                    <div class="d-flex align-items-start">
                                        <div class="icon text-primary rounded-circle">
                                            <i class="fas {{ $faq->ico }}"></i>
                                        </div>
                                        <div class="icon-text pl-4">
                                            <h5 class="ma-0 ">{{ $faq->question }}</h5>
                                            <p class="mb-0">{{ $faq->answer }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                @include('layouts.no-information')
            @endif
        </div>
    </section>

@endsection
