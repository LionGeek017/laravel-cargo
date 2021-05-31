<tr>
    <th>
        {{ $region->id }}
    </th>
    <td>
        {{ $region->name }}
    </td>
    <td>
        <h6 class="mb-1 text-sm">
            <img height="15" alt="Image placeholder" src="{{ URL::asset('img/icons/flags/'.Str::lower($region->country->code).'.svg') }}">
            {{ $region->country->name }}
        </h6>
    </td>
    <td>
        {{ Str::upper($region->vk_id) }}
    </td>
    <td>
        <a href="{{ route('adminchik.cities.index', ['region_id' => $region->id]) }}">{{ $region->cities->count() }} {{ RusEnding($region->cities->count(), 'город', 'города', 'городов') }}</a>
    </td>
    <td>
        <small>{{ \Carbon\Carbon::now()->subSeconds($dateUnix - strtotime($region->created_at))->diffForHumans() }}</small>
        <br/>
        <small>{{ \Carbon\Carbon::now()->subSeconds(($dateUnix - strtotime($region->updated_at)))->diffForHumans() }}</small>
    </td>
    <td class="text-right">
        <div class="dropdown action-item">
            <a class="nav-link px-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="0,10"><i class="fas fa-ellipsis-h"></i></a>
            <div class="dropdown-menu dropdown-menu-right py-2">
                <a href="{{ route('adminchik.regions.edit', ['region' => $region->id]) }}" class="dropdown-item px-3">Редактировать</a>
            </div>
        </div>
    </td>
</tr>
<tr class="table-divider"></tr>
