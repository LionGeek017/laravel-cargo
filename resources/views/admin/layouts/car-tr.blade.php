<tr>
    <th {!! ($car->available && $car->status) ? '' : 'class="bg-translucent-danger"' !!}>
        {{ $car->id }}
    </th>
    <td>
        <h6>{{ $car->carBody->name }}</h6>
        <small>{{ $car->carWeight->name }}</small>
    </td>
    <td>
        <div class="d-flex align-items-center">
            <div>
                <a class="avatar avatar-md" href="{{ route('adminchik.users.show', ['user' => $car->user->id]) }}" data-toggle="tooltip" data-title="Смотреть профиль">
                    @include('layouts.user-avatar', ['email' => $car->user->email])
                </a>
            </div>
            <div class="ml-3">
                <h6 class="mb-1 text-sm"><a href="">{{ $car->user->name }}</a></h6>
                <small>{{ $car->user->email }}</small>
                <br/>
                <small>ID: {{ $car->user->id }}</small>
            </div>
        </div>
    </td>
    <td>
        <h6 class="mb-1 text-sm">
            <img alt="Image placeholder" height="14" class="country-active-img" src="{{ URL::asset('img/icons/flags/'.Str::lower($car->country->code).'.svg') }}">
            {{ $car->city->name }}
        </h6>
        <small>{{ $car->region->name }}</small>
    </td>
    <td>
        <small>{{ $car->loc_lat }}, {{ $car->loc_lng }}</small>
    </td>
    <td>
        <span class="badge badge-pill badge-soft-{{ ($car->available && $car->status)  ? 'success' : 'danger' }} mx-2">{{ $car->status ? $availableType[$car->available] : 'Закрыт' }}</span>
    </td>
    <td>
        <h6 class="text-sm mb-0">{{ $car->contact_name }}</h6>
        <span class="d-block text-xs text-muted">{{ $car->contact_phone }}</span>
        <span class="badge badge-pill badge-soft-{{ $car->is_owner > 0 ? 'success' : 'warning' }}">{{ $ownerType[$car->is_owner] }}</span>
    </td>
    <td>
        <small>{{ \Carbon\Carbon::now()->subSeconds($dateUnix - strtotime($car->created_at))->diffForHumans() }}</small>
        <br/>
        <small>{{ \Carbon\Carbon::now()->subSeconds(($dateUnix - strtotime($car->updated_at)))->diffForHumans() }}</small>
    </td>
    <td class="text-right">
        <div class="dropdown action-item">
            <a class="nav-link px-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="0,10"><i class="fas fa-ellipsis-h"></i></a>
            <div class="dropdown-menu dropdown-menu-right py-2">
                <a href="{{ route('car.show', ['car' => $car->id . '-' . $car->car_code]) }}" class="dropdown-item px-3">Просмотреть на сайте</a>
                <a href="{{ route('adminchik.cars.index', ['user_id' => $car->user_id]) }}" class="dropdown-item px-3">Все машины пользователя</a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('car.edit', ['car' => $car->id]) }}" target="_blank" class="dropdown-item px-3">Редактировать</a>
                @can('destroy', $car)
                    @if($car->status > 0)
                        <a href="#" class="dropdown-item px-3" onclick="event.preventDefault(); document.getElementById('deactivate-form-{{ $car->id }}').submit();">Снять с публикации</a>
                        <form id="deactivate-form-{{ $car->id }}" action="{{ route('car.destroy_publish') }}" method="post">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="id" value="{{ $car->id }}">
                        </form>
                    @endif
                @endcan
            </div>
        </div>
    </td>
</tr>
<tr class="table-divider"></tr>
