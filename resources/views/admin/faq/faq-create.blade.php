@extends('admin.faq.faqs')
@section('faq_content')
    <section class="slice slice-lg pt-3">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div>
                        <div class="mb-5 text-center">
                            <h6 class="h3">Новый вопрос и ответ</h6>
                            <p class="text-muted mb-0">Напишите вопрос и дайте ответ на него</p>
                        </div>
                        <span class="clearfix"></span>
                        <form enctype="multipart/form-data" role="form" class="border p-4" method="POST" action="{{ route('adminchik.faqs.store') }}">
                            @csrf
                            @include('admin.faq.faq-form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
