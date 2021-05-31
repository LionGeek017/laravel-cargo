<tr>
    <th {!! $date > $post->date_end ? 'class="bg-translucent-danger" data-toggle="tooltip" data-placement="top" title="Подписка закрыта"' : '' !!}>
        {{ $post->id }}
    </th>
    <td>
        <div class="d-flex align-items-center">
            <div>
                <a class="avatar avatar-md" href="{{ route('adminchik.users.show', ['user' => $post->user->id]) }}" data-toggle="tooltip" data-title="Смотреть профиль">
                    @include('layouts.user-avatar', ['email' => $post->user->email])
                </a>
            </div>
            <div class="ml-3">
                <h6 class="m-0">{{ $post->user->name }}</h6>
                <small>{{ $post->user->email }}</small>
                <br/>
                <small>ID: {{ $post->user->id }}</small>
            </div>
        </div>
    </td>
    <td>
        <small>{{ $post->subscription->title }}</small>
    </td>
    <td>
        @if($post->admin_id)
            <div class="d-flex align-items-center">
                <div>
                    <a class="avatar avatar-md" href="{{ route('adminchik.users.show', ['user' => $post->admin->id]) }}" data-toggle="tooltip" data-title="Смотреть профиль">
                        @include('layouts.user-avatar', ['email' => $post->admin->email])
                    </a>
                </div>
                <div class="ml-3">
                    <h6 class="m-0">{{ $post->admin->name }}</h6>
                    <small>{{ $post->admin->email }}</small>
                    <br/>
                    <small>ID: {{ $post->admin->id }}</small>
                </div>
            </div>
        @endif
    </td>
    <td>
        ${{ $post->price }}
    </td>
    <td>
        <small>{{ \Carbon\Carbon::now()->subSeconds($dateUnix - strtotime($post->date_start))->diffForHumans() }}</small>
    </td>
    <td>
        @if($date >= $post->date_end)
            <small>{{ \Carbon\Carbon::now()->subSeconds($dateUnix - strtotime($post->date_end))->diffForHumans() }}</small>
        @else
            <small>{{ \Carbon\Carbon::now()->addSeconds(strtotime($post->date_end) - $dateUnix)->diffForHumans() }}</small>
        @endif
    </td>
    <td class="text-right">
        <div class="dropdown action-item">
            <a class="nav-link px-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="0,10"><i class="fas fa-ellipsis-h"></i></a>
            <div class="dropdown-menu dropdown-menu-right py-2">
{{--                <a href="" target="_blank" class="dropdown-item px-3">Все подписки пользователя</a>--}}
{{--                <div class="dropdown-divider"></div>--}}
                <a href="{{ route('adminchik.history.edit', ['history' => $post->id]) }}" class="dropdown-item px-3">Редактировать</a>
            </div>
        </div>
    </td>
</tr>
<tr class="table-divider"></tr>

