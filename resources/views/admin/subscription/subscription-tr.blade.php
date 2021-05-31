<tr>
    <th>
        {{ $post->id }}
    </th>
    <td>
        <h6 class="mb-1 text-sm">{{ $post->title }}</h6>
        <small>Тип: {{ $post->type }}</small>
    </td>
    <td>
        {!! $post->description !!}
    </td>
    <td>
        {{ $post->period }} {{ RusEnding($post->period, 'месяц', 'месяца', 'месяцев') }}
    </td>
    <td>
        ${{ $post->price }}
    </td>
    <td>
        <a href="{{ route('adminchik.history.index', ['subscription_id' => $post->id]) }}">{{ $post->history->count() }} {{ RusEnding($post->history->count(), 'покупка', 'покупки', 'покупок') }}</a>
    </td>
    <td>
        <span class="badge badge-pill {{ $post->status ? 'badge-soft-success' : 'badge-soft-danger' }} text-small">{{ $status[$post->status] }}</span>
    </td>
    <td>
        <small>{{ \Carbon\Carbon::now()->subSeconds($dateUnix - strtotime($post->created_at))->diffForHumans() }}</small>
        <br/>
        <small>{{ \Carbon\Carbon::now()->subSeconds(($dateUnix - strtotime($post->updated_at)))->diffForHumans() }}</small>
    </td>
    <td class="text-right">
        <div class="dropdown action-item">
            <a class="nav-link px-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="0,10"><i class="fas fa-ellipsis-h"></i></a>
            <div class="dropdown-menu dropdown-menu-right py-2">
                <a href="{{ route('subscription.index') }}" target="_blank" class="dropdown-item px-3">Просмотреть на сайте</a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('adminchik.subscriptions.edit', ['subscription' => $post->id]) }}" class="dropdown-item px-3">Редактировать</a>
            </div>
        </div>
    </td>
</tr>
<tr class="table-divider"></tr>
