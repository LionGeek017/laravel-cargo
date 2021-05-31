<tr>
    <th {!! $cargo->status > 0 ? '' : 'class="bg-translucent-danger"' !!}>
        {{ $cargo->id }}
    </th>
    <td>
        <h6 class="mb-1 text-sm" {!! $cargo->status > 0 ? '' : 'data-toggle="tooltip" data-placement="top" title="Груз в архиве"' !!}>{{ $cargo->cargo_name }}</h6>
        <small>{{ $cargo->carBody->name }}</small> / <small>{{ $cargo->carWeight->name }}</small>
    </td>
    <td>
        <div class="d-flex align-items-center">
            <div>
                <a class="avatar avatar-md" href="{{ route('adminchik.users.show', ['user' => $cargo->user->id]) }}" data-toggle="tooltip" data-title="Смотреть профиль">
                    @include('layouts.user-avatar', ['email' => $cargo->user->email])
                </a>
            </div>
            <div class="ml-3">
                <h6 class="mb-1 text-sm">{{ $cargo->user->name }}</h6>
                <small>{{ $cargo->user->email }}</small>
                <br/>
                <small>ID: {{ $cargo->user->id }}</small>
            </div>
        </div>
    </td>
    <td>
        <h6 class="mb-1 text-sm">{{ $cargo->cityFrom->name }}</h6>
        <small>{{ $cargo->regionFrom->name }}</small>
    </td>
    <td>
        <h6 class="mb-1 text-sm">{{ $cargo->cityTo->name }}</h6>
        <small>{{ $cargo->regionTo->name }}</small>
    </td>
    <td>
        <span class="badge badge-warning badge-pill">{{ $cargo->price }} {{ $cargo->currency->code }}</span>
        <br/>
        <small>{{ $cargo->priceType->name }} / {{ $cargo->payType->name }}</small>
    </td>
    <td>
        <h6 class="text-sm mb-0">{{ $cargo->contact_name }}</h6>
        <span class="d-block text-xs text-muted">{{ $cargo->contact_phone }}</span>
        <span class="badge badge-pill badge-soft-success">{{ $ownerMax[$cargo->owner_type] }}</span>
    </td>
    <td>
        <small>{{ \Carbon\Carbon::now()->subSeconds($dateUnix - strtotime($cargo->created_at))->diffForHumans() }}</small>
        <br/>
        <small>{{ \Carbon\Carbon::now()->subSeconds(($dateUnix - strtotime($cargo->updated_at)))->diffForHumans() }}</small>
    </td>
    <td class="text-right">
        <div class="dropdown action-item">
            <a class="nav-link px-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="0,10"><i class="fas fa-ellipsis-h"></i></a>
            <div class="dropdown-menu dropdown-menu-right py-2">
                <a href="{{ route('cargo.show', ['id' => $cargo->id, 'cargo_code' => $cargo->cargo_code, 'cargo_name_slug' => $cargo->cargo_name_slug]) }}" target="_blank" class="dropdown-item px-3">Просмотреть на сайте</a>
                <a href="{{ route('adminchik.cargos.index', ['user_id' => $cargo->user_id]) }}" class="dropdown-item px-3">Все грузы пользователя</a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('cargo.edit', ['id' => $cargo->id]) }}" target="_blank" class="dropdown-item px-3">Редактировать</a>
                @can('destroy', $cargo)
                @if($cargo->status > 0)
                    <a href="#" class="dropdown-item px-3" onclick="event.preventDefault(); document.getElementById('deactivate-form-{{ $cargo->id }}').submit();">Снять с публикации</a>
                    <form id="deactivate-form-{{ $cargo->id }}" action="{{ route('cargo.destroy_publish') }}" method="post">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="id" value="{{ $cargo->id }}">
                    </form>
                @endif
                @endcan
            </div>
        </div>
    </td>
</tr>
<tr class="table-divider"></tr>
