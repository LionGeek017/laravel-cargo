<div class="table-responsive">
    <table class="table table-cards align-items-center">
        <thead>
        <tr>
            <th scope="col" class="sort">ID</th>
            <th scope="col" class="sort">Кузов</th>
            <th scope="col" class="sort">Пользователь</th>
            <th scope="col" class="sort">Регистрация</th>
            <th scope="col" class="sort">GPS</th>
            <th scope="col" class="sort">Статус</th>
            <th scope="col" class="sort">Контакты</th>
            <th scope="col" class="sort">Даты</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody class="list">
        @foreach($cars as $car)
            @include('admin.layouts.car-tr')
        @endforeach
        </tbody>
    </table>
</div>

{{ $cars->total() > 0 ? $cars->links() : '' }}

@if($cars->total() == 0)
    @include('layouts.no-information')
@endif
