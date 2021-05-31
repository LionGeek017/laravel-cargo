@extends('admin.index')
@section('content')
    <section class="slice slice-lg pt-0 pb-5" data-offset-top="#header-main">
        <div class="container pb-5">
            <div class="table-responsive">
                <table class="table table-cards align-items-center">
                    <thead>
                    <tr>
                        <th scope="col" class="sort">ID</th>
                        <th scope="col" class="sort">Пользователь</th>
                        <th scope="col" class="sort">Груз</th>
                        <th scope="col" class="sort">Авто</th>
                        <th scope="col" class="sort">IP</th>
                        <th scope="col" class="sort">Устройство</th>
                        <th scope="col" class="sort">Статус</th>
                        <th scope="col" class="sort">Даты</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody class="list">
                        @foreach($users as $user)
                            @include('admin.layouts.user-tr')
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $users->total() > 0 ? $users->links() : '' }}
        </div>
    </section>
@endsection
