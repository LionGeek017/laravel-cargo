<tr>
    <th>
        {{ $faq->id }}
    </th>
    <td>
        <i class="fas {{ $faq->ico }}"></i>
    </td>
    <td>
        <h6 class="mb-1 text-sm">{{ $faq->question }}</h6>
        <small>{{ $faq->answer }}</small>
    </td>
    <td>
        <small>{{ \Carbon\Carbon::now()->subSeconds($dateUnix - strtotime($faq->created_at))->diffForHumans() }}</small>
        <br/>
        <small>{{ \Carbon\Carbon::now()->subSeconds(($dateUnix - strtotime($faq->updated_at)))->diffForHumans() }}</small>
    </td>
    <td class="text-right">
        <div class="dropdown action-item">
            <a class="nav-link px-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="0,10"><i class="fas fa-ellipsis-h"></i></a>
            <div class="dropdown-menu dropdown-menu-right py-2">
                <a href="{{ route('faq.index')}}" target="_blank" class="dropdown-item px-3">Просмотреть на сайте</a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('adminchik.faqs.edit', ['faq' => $faq->id]) }}" class="dropdown-item px-3">Редактировать</a>
            </div>
        </div>
    </td>
</tr>
<tr class="table-divider"></tr>
