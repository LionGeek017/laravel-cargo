@extends('admin.subscription.index')
@section('subscription_content')

    <!-- Form add cargo -->
    <section class="slice slice-lg pt-3">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div>
                        <div class="mb-5 text-center">
                            <h6 class="h3">Новая подписка</h6>
                            <p class="text-muted mb-0">Добавьте новую подписку для пользователей</p>
                        </div>
                        <span class="clearfix"></span>
                        <form role="form" class="border p-4" method="POST" action="{{ route('adminchik.subscriptions.store') }}">
                            @csrf
                            @include('admin.subscription.subscription-form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
