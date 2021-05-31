<tr>
    <th>
        {{ $category->id }}
    </th>
    <td>
        <h6 class="mb-1 text-sm">{{ $category->name }}</h6>
        <small>{{ $category->description }}</small>
    </td>
    <td>
        <img width="80" class="rounded" src="{{ URL::asset($category->img ?? 'img/default.jpg') }}" />
    </td>
    <td>
        <small>{{ $category->slug }}</small>
    </td>
    <td>
        <a href="{{ route('adminchik.posts.index', ['category_id' => $category->id]) }}">{{ $category->posts->count() }} {{ RusEnding($category->posts->count(), 'пост', 'поста', 'постов') }}</a>
    </td>
    <td class="text-left">
        <p class="p-0 m-0" style="cursor: default;" data-toggle="tooltip" data-placement="top" title="{{ $category->meta_title }}"><i class="far fa-eye"></i> Title</p>
        <p class="p-0 m-0" style="cursor: default;" data-toggle="tooltip" data-placement="top" title="{{ $category->meta_description }}"><i class="far fa-eye"></i> Description</p>
        <p class="p-0 m-0" style="cursor: default;" data-toggle="tooltip" data-placement="top" title="{{ $category->meta_keywords }}"><i class="far fa-eye"></i> Keywords</p>
    </td>
    <td>
        <small>{{ \Carbon\Carbon::now()->subSeconds($dateUnix - strtotime($category->created_at))->diffForHumans() }}</small>
        <br/>
        <small>{{ \Carbon\Carbon::now()->subSeconds(($dateUnix - strtotime($category->updated_at)))->diffForHumans() }}</small>
    </td>
    <td class="text-right">
        <div class="dropdown action-item">
            <a class="nav-link px-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="0,10"><i class="fas fa-ellipsis-h"></i></a>
            <div class="dropdown-menu dropdown-menu-right py-2">
                <a href="{{ route('category.index', ['category_slug' => $category->slug]) }}" target="_blank" class="dropdown-item px-3">Просмотреть на сайте</a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('adminchik.categories.edit', ['category' => $category->id]) }}" class="dropdown-item px-3">Редактировать</a>
            </div>
        </div>
    </td>
</tr>
<tr class="table-divider"></tr>
