@extends('index')
@section('content')

    <section class="slice slice-lg">
        <div class="container text-center mt-5">
            <h2>Выберите свою подписку</h2>
            <div>
                Не ограничивай себя, оформи подписку и наслаждайся результатом
            </div>
        </div>
    </section>
    <section class="slice slice-lg">
        <div class="container">
            <div class="row">
                @foreach($subscriptions as $subscription)
                    <div class="col-lg-4 col-sm-6">
                        <div class="card px-3 hover-shadow-lg hover-translate-y-n10">
                            <span class="h6 w-60 mx-auto px-4 py-1 rounded-bottom bg-{{ $type[$subscription->type]['bg'] }} text-white">${{ $subscription->price }} / {{ $subscription->period }} месяц</span>
                            <div class="card-body py-5">
                                <div class="d-flex align-items-center">
                                    <div class="icon bg-gradient-{{ $type[$subscription->type]['bg'] }} text-white rounded-circle icon-shape shadow-primary">
                                        {!! $type[$subscription->type]['ico'] !!}
                                    </div>
                                    <div class="icon-text pl-4">
                                        <h5 class="mb-0">{{ $subscription->title }}</h5>
                                    </div>
                                </div>
                                <div class="mt-4 mb-0">
                                    {!! $subscription->description !!}
                                </div>
                                <div class="divider-fade my-3"></div>
                                <div class="text-center pt-3">
                                    <a href="" class="btn btn-{{ $type[$subscription->type]['bg'] }} rounded-pill">
                                        Оплатить подписку
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection
