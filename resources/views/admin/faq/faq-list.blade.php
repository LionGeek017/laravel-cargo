@extends('admin.faq.faqs')
@section('faq_content')
    <div class="table-responsive">
        <table class="table table-cards align-items-center">
            <thead>
            <tr>
                <th scope="col" class="sort">ID</th>
                <th scope="col" class="sort">ICO</th>
                <th scope="col" class="sort">Вопрос/Ответ</th>
                <th scope="col" class="sort">Даты</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody class="list">
            @foreach($faqs as $faq)
                @include('admin.faq.faq-tr')
            @endforeach
            </tbody>
        </table>
    </div>

    @if($faqs->count() == 0)
        @include('layouts.no-information')
    @endif
@endsection
