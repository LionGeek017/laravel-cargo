<tr>
    <th>
        {{ $city->id }}
    </th>
    <td>
        {{ $city->name }}
        @if($city->area)
            <br/>
            <small>{{ $city->area }}</small>
        @endif
        <br/>
        <small>{{ $city->region->name }}</small>
    </td>
    <td>
        <h6 class="mb-1 text-sm">
            <img height="15" alt="Image placeholder" src="{{ URL::asset('img/icons/flags/'.Str::lower($city->country->code).'.svg') }}">
            {{ $city->country->name }}
        </h6>
    </td>
    <td>
        {{ Str::upper($city->vk_id) }}
    </td>
    <td>
        <small>{{ $city->loc_lat }}</small>
        <br/>
        <small>{{ $city->loc_lng }}</small>
    </td>
    <td>
        <small>{{ \Carbon\Carbon::now()->subSeconds($dateUnix - strtotime($city->created_at))->diffForHumans() }}</small>
        <br/>
        <small>{{ \Carbon\Carbon::now()->subSeconds(($dateUnix - strtotime($city->updated_at)))->diffForHumans() }}</small>
    </td>
    <td class="text-right">
        <div class="dropdown action-item">
            <a class="nav-link px-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="0,10"><i class="fas fa-ellipsis-h"></i></a>
            <div class="dropdown-menu dropdown-menu-right py-2">
                <a href="{{ route('adminchik.cities.edit', ['city' => $city->id]) }}" class="dropdown-item px-3">Редактировать</a>
            </div>
        </div>
    </td>
</tr>
<tr class="table-divider"></tr>
