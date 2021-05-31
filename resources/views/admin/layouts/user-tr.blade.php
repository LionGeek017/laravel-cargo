<tr>
    <th>
        {{ $user->id }}
    </th>
    <td>
        <div class="d-flex align-items-center">
            <div>
                <a class="avatar avatar-md" href="{{ route('adminchik.users.show', ['user' => $user->id]) }}" data-toggle="tooltip" data-title="Смотреть профиль">
                    @include('layouts.user-avatar', ['email' => $user->email])
                    <span class="badge-user-online {{ $user->isOnline() ? 'bg-success' : 'bg-light' }}"></span>
                </a>
            </div>
            <div class="ml-3">
                <h6 class="m-0">{{ $user->name }}</h6>
                <small>{{ $user->email }}</small>
                <br/>
                @foreach($user->roles as $role)
                    <span class="badge badge-pill badge-soft-success text-small">{{ $role->name }}</span>
                @endforeach
            </div>
        </div>
    </td>
    <td>
        <a href="{{ route('adminchik.cargos.index', ['user_id' => $user->id]) }}">{{ $user->cargos->count() }} {{ RusEnding($user->cargos->count(), 'груз', 'груза', 'грузов') }}</a>
    </td>
    <td>
        <a href="{{ route('adminchik.cars.index', ['user_id' => $user->id]) }}">{{ $user->cars->count() }} {{ RusEnding($user->cars->count(), 'автомобиль', 'автомобиля', 'автомобилей') }}</a>
    </td>
    <td>
        <h6 class="p-0 m-0">{{ \App\Http\ViewComposers\CountriesComposer::userGeo($user->ip)['city'] }}</h6>
        <small>{{ $user->ip }}</small>
    </td>
    <td>
        {{ $user->device }}
    </td>
    <td>
        <span class="badge badge-pill {{ $user->status ? 'badge-soft-success' : 'badge-soft-danger' }} text-small">{{ $status[$user->status] }}</span>
    </td>
    <td>
        <small>{{ \Carbon\Carbon::now()->subSeconds($dateUnix - strtotime($user->created_at))->diffForHumans() }}</small>
        <br/>
        <small>{{ \Carbon\Carbon::now()->subSeconds(($dateUnix - strtotime($user->updated_at)))->diffForHumans() }}</small>
    </td>
    <td class="text-right">
        <div class="dropdown action-item p-0 m-0">
            <a class="nav-link px-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="0,10"><i class="fas fa-ellipsis-h"></i></a>
            <div class="dropdown-menu dropdown-menu-right p-2">
                @can('view', $user)
                    <a href="{{ route('adminchik.users.show', ['user' => $user->id]) }}" class="dropdown-item p-0">Просмотреть</a>
                @endcan
                <a href="{{ route('adminchik.history.create', ['user_id' => $user->id]) }}" class="dropdown-item p-0">Подарить подписку</a>
                <div class="dropdown-divider"></div>
                @can('edit', $user)
                    <a href="{{ route('adminchik.users.edit', ['user' => $user->id]) }}" class="dropdown-item p-0">Редактировать</a>
                @endcan
                @can('destroy', $user)
{{--                    <a href="/adminchik/users/{{ $user->id }}" onclick="event.preventDefault(); document.getElementById('deactivate-form-{{ $user->id }}').submit();" class="dropdown-item p-0">Удалить</a>--}}
                    <form id="deactivate-form-{{ $user->id }}" action="{{ route('adminchik.users.destroy', ['user' => $user->id]) }}" method="post" onsubmit="if(confirm('Точно удалить пользователя?')) { return true;} else { return false;}">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <input type="submit" class="btn btn-link nav-link p-0 m-0 text-sm" value="Удалить">
                    </form>
                @endcan
            </div>
        </div>
    </td>
</tr>
<tr class="table-divider"></tr>
