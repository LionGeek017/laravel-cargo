<tr>
    <th>
        {{ $country->id }}
    </th>
    <td>
        <h6 class="mb-1 text-sm">
            <img height="15" alt="Image placeholder" src="{{ URL::asset('img/icons/flags/'.Str::lower($country->code).'.svg') }}">
            {{ $country->name }}
        </h6>
    </td>
    <td>
        {{ Str::upper($country->code) }}
    </td>
    <td>
        {{ Str::upper($country->vk_id) }}
    </td>
    <td>
        <a href="{{ route('adminchik.regions.index', ['country_id' => $country->id]) }}">{{ $country->regions->count() }} {{ RusEnding($country->regions->count(), 'регион', 'региона', 'регионов') }}</a>
    </td>
    <td>
        <a href="{{ route('adminchik.cities.index', ['country_id' => $country->id]) }}">{{ $country->cities->count() }} {{ RusEnding($country->cities->count(), 'город', 'города', 'городов') }}</a>
    </td>
    <td>
        <span class="badge badge-pill {{ $country->active ? 'badge-soft-success' : 'badge-soft-danger' }} text-small">{{ $status[$country->active] }}</span>
    </td>
    <td>
        <small>{{ \Carbon\Carbon::now()->subSeconds($dateUnix - strtotime($country->created_at))->diffForHumans() }}</small>
        <br/>
        <small>{{ \Carbon\Carbon::now()->subSeconds(($dateUnix - strtotime($country->updated_at)))->diffForHumans() }}</small>
    </td>
    <td class="text-right">
        <div class="dropdown action-item">
            <a class="nav-link px-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="0,10"><i class="fas fa-ellipsis-h"></i></a>
            <div class="dropdown-menu dropdown-menu-right py-2">
                <a href="{{ route('adminchik.countries.edit', ['country' => $country->id]) }}" class="dropdown-item px-3">Редактировать</a>
            </div>
        </div>
    </td>
</tr>
<tr class="table-divider"></tr>
