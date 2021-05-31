<tr>
    <th>
        {{ $post->id }}
    </th>
    <td>
        <h6 class="mb-1 text-sm">{{ $post->title }}</h6>
        <small>{!! $post->text_short !!}</small>
    </td>
    <td>
        <img width="80" class="rounded" src="{{ URL::asset($post->img ?? 'img/default.jpg') }}" />
    </td>
    <td>
        <small>{{ $post->category->name }}</small>
    </td>
    <td>
        <p class="p-0 m-0" style="cursor: default;" data-toggle="tooltip" data-placement="top" title="{{ $post->meta_title }}"><i class="far fa-eye"></i> Title</p>
        <p class="p-0 m-0" style="cursor: default;" data-toggle="tooltip" data-placement="top" title="{{ $post->meta_description }}"><i class="far fa-eye"></i> Description</p>
        <p class="p-0 m-0" style="cursor: default;" data-toggle="tooltip" data-placement="top" title="{{ $post->meta_keywords }}"><i class="far fa-eye"></i> Keywords</p>
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
                <a href="{{ route('post.show', ['category_slug' => $post->category->slug, 'id' => $post->id, 'post_slug' => $post->slug]) }}" target="_blank" class="dropdown-item px-3">Просмотреть на сайте</a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('adminchik.posts.edit', ['post' => $post->id]) }}" class="dropdown-item px-3">Редактировать</a>
            </div>
        </div>
    </td>
</tr>
<tr class="table-divider"></tr>
