<div class="table-responsive">
    <table class="table table-cards align-items-center">
        <thead>
        <tr>
            <th scope="col" class="sort">ID</th>
            <th scope="col" class="sort">Название груза</th>
            <th scope="col" class="sort">Пользователь</th>
            <th scope="col" class="sort">Загрузка</th>
            <th scope="col" class="sort">Разгрузка</th>
            <th scope="col" class="sort">Оплата</th>
            <th scope="col" class="sort">Контакты</th>
            <th scope="col" class="sort">Даты</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody class="list">
        @foreach($cargos as $cargo)
            @include('admin.layouts.cargo-tr')
        @endforeach
        </tbody>
    </table>
</div>

{{ $cargos->total() > 0 ? $cargos->links() : '' }}

@if($cargos->total() == 0)
    @include('layouts.no-information')
@endif
