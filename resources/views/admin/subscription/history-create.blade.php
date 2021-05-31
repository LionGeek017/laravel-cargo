@extends('admin.subscription.index')
@section('subscription_content')

    <section class="slice slice-lg pt-3">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div>
                        <div class="mb-5 text-center">
                            <h6 class="h3">Подарить подписку</h6>
                            <p class="text-muted mb-0">Подарить подписку пользователю</p>
                        </div>
                        <span class="clearfix"></span>
                        <form role="form" class="border p-4" method="POST" action="{{ route('adminchik.history.store') }}">
                            @csrf
                            @include('admin.subscription.history-form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
