<div class="card card-product">
    <div class="card-body py-4">
        <div class="p-0 d-flex justify-content-between align-items-center">
            <div>
                <h6 class="mb-0"><a href="{{ route('cargo.show', ['id' => $cargo->id, 'cargo_code' => $cargo->cargo_code, 'cargo_name_slug' => $cargo->cargo_name_slug]) }}">{{ $cargo->cargo_name }}</a> / {{ $cargo->carWeight->name }}</h6>
                <small class="text-sm">{{ $ownerMax[$cargo->owner_type] }}</small>
            </div>
            <div class="text-right">
                <div class="text-muted">
                    @if(!Route::is('cargo.show'))
                        <a href="#" class="btn-inner--icon px-1 text-success" data-toggle="modal" data-target="#modal-map" onclick="showMapDirections('{{ $cargo->countryFrom->name }},{{ $cargo->cityFrom->name }},{{ $cargo->cityFrom->area }},{{ $cargo->regionFrom->name }}', '{{ $cargo->countryTo->name }},{{ $cargo->cityTo->name }},{{ $cargo->cityTo->area }},{{ $cargo->regionTo->name }}');return false;"><i class="fas fa-map-marked-alt"></i></a>
                    @endif
                    <a href="{{ route('cargo.search', ['country_id_from' => $cargo->country_id_to, 'region_id_from' => $cargo->region_id_to, 'country_id_to' => $cargo->country_id_from, 'region_id_to' => $cargo->region_id_from, 'car_body_id' => $cargo->car_body_id]) }}" class="btn-inner--icon px-1 text-warning"><i class="fas fa-truck-loading"></i></a>
                    @can('optional', $cargo)
                    <div class="dropdown action-item p-0 m-0">
                        <a class="nav-link px-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="0,10"><i class="fas fa-ellipsis-h"></i></a>
                        <div class="dropdown-menu dropdown-menu-right p-2">
                            <a href="{{ route('cargo.edit', ['id'=>$cargo->id]) }}" class="dropdown-item p-0">Редактировать</a>
                            <a href="#" class="dropdown-item p-0" onclick="event.preventDefault(); document.getElementById('update-form-{{ $cargo->id }}').submit();">Обновить публикацию</a>
                            <form id="update-form-{{ $cargo->id }}" action="{{ route('cargo.update_publish') }}" method="post">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="id" value="{{ $cargo->id }}">
                            </form>
                            @if($cargo->status > 0)
                            <a href="#" class="dropdown-item p-0" onclick="event.preventDefault(); document.getElementById('deactivate-form-{{ $cargo->id }}').submit();">Снять с публикации</a>
                            <form id="deactivate-form-{{ $cargo->id }}" action="{{ route('cargo.destroy_publish') }}" method="post">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="id" value="{{ $cargo->id }}">
                            </form>
                            @endif
                        </div>
                    </div>
                    @endcan
                </div>
            </div>
        </div>

        <div class="mt-3">
            <div class="row align-items-center">
                <div class="col col-md-5 text-left">
                    <h5 class="text-dark p-0 m-0">
                        {{ $cargo->cityFrom->name }}
                        <img height="15" alt="Image placeholder" src="{{ URL::asset('img/icons/flags/'.Str::lower($cargo->countryFrom->code).'.svg') }}">
                    </h5>
                    <small class="text-sm">
                        {{ $cargo->regionFrom->name }}
                    </small>
                </div>
                <div class="col col-md-2 text-center text-muted">
                    {{ $cargo->distance }} км
                </div>
                <div class="col col-md-5 text-right">
                    <h5 class="text-dark p-0 m-0">
                        {{ $cargo->cityTo->name }}
                        <img height="15" alt="Image placeholder" src="{{ URL::asset('img/icons/flags/'.Str::lower($cargo->countryTo->code).'.svg') }}">
                    </h5>
                    <small class="text-sm">
                        {{ $cargo->regionTo->name }}
                    </small>
                </div>
            </div>
        </div>
        <hr class="divider divider-fade my-3 p-0"></hr>
        <div class="text-center">
            <i class="fas fa-truck"></i>
            <small class="text-sm">{{ $cargo->carBody->name }}</small>
        </div>
        <div class="text-right">
            <span class="badge badge-warning badge-pill">{{ $cargo->price }} {{ $cargo->currency->code }}</span>
            <br/>
            <small class="text-sm text-muted">{{ $cargo->priceType->name }} / {{ $cargo->payType->name }}</small>
        </div>
        <div class="card-footer row align-items-center p-0 m-0 pt-3">
            <div class="col-6 p-0 m-0">
                @if($cargo->user_id == Auth::id())
                    <div>
                        <span class="badge badge-pill badge-{{ $cargo->status ? 'success' : 'danger' }} mx-2">{{ $cargo->status ? 'Активен' : 'Закрыт' }}</span>
                    </div>
                @endif
                <div>
                    <i class="fas fa-code"></i>
                    <small class="text-sm">#{{ $cargo->cargo_code }}</small>
                </div>
            </div>
            <div class="col-6 text-right p-0 m-0">
                <button type="button" class="btn btn-outline-info btn-icon-label" onclick="showContacts({{ $cargo->id }}, '{{ $cargo->cargo_code }}', 'cargo')">
{{--                    data-toggle="modal" data-target="#modal-contacts"--}}
                  <span class="btn-inner--icon">
                      <i class="fas fa-mobile-alt"></i>
                  </span>
                    <span class="btn-inner--text">Контакты</span>
                </button>
            </div>
        </div>
    </div>
</div>
