<div class="card card-product">
    <div class="row card-image ">
        <div class="col-md-6 text-left">
            <h6 class="px-1 m-0 font-weight-bold text-dark">
                <a href="{{ route('car.show', ['car' => $car->id . '-' . $car->car_code]) }}">{{ Str::ucfirst($car->carBody->name) }}</a>
            </h6>
            <p class="p-0 m-0 text-sm text-muted">{{ $car->carWeight->name }}</p>
        </div>
        <div class="col-md-6 text-right align-items-center">
            <span class="badge badge-pill {{ ($car->available && $car->status) ? 'badge-soft-success' : 'badge-soft-danger' }} text-small">{{ $car->status ? $availableType[$car->available] : 'Закрыт' }}</span>
            @if(!Route::is('car.show'))
                <a class="px-1" href="#" data-toggle="modal" data-target="#modal-map" onclick="showMapLocations('{{ (empty($car->loc_lat) || empty($car->loc_lng)) ? $car->country->name . ',' . $car->city->name . ',' . $car->city->area . ',' . $car->region->name : $car->loc_lat . ',' . $car->loc_lng }}'); return false;"><i class="fas fa-map-marked-alt"></i></a>
            @endif
            @can('optional', $car)
            <div class="dropdown action-item p-0 m-0">
                <a class="nav-link px-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="0,10"><i class="fas fa-ellipsis-h"></i></a>
                <div class="dropdown-menu dropdown-menu-right p-2">
                    <a href="{{ route('car.edit', ['car'=>$car->id]) }}" class="dropdown-item p-0">Редактировать</a>
                    <a href="#" class="dropdown-item p-0" onclick="event.preventDefault(); document.getElementById('update-form-{{ $car->id }}').submit();">Обновить публикацию</a>
                    <form id="update-form-{{ $car->id }}" action="{{ route('car.update_publish') }}" method="post">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="id" value="{{ $car->id }}">
                    </form>
                    @if($car->status > 0)
                        <a href="#" class="dropdown-item p-0" onclick="event.preventDefault(); document.getElementById('deactivate-form-{{ $car->id }}').submit();">Снять с публикации</a>
                        <form id="deactivate-form-{{ $car->id }}" action="{{ route('car.destroy_publish') }}" method="post">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="id" value="{{ $car->id }}">
                        </form>
                    @endif
                </div>
            </div>
            @endcan
        </div>
    </div>
    <div class="card-body pt-0">
        <div class="text-left">
            <h5 class="mb-0">
                <span class="font-weight-bold text-dark">{{ $car->city->name }}</span>
                <img class="flag" height="15" alt="Image placeholder" src="{{ URL::asset('img/icons/flags/'.Str::lower($car->country->code).'.svg') }}">
            </h5>
            <p>{{ $car->region->name }}{{ ($car->city->area && $car->city->area != 'Not area') ? ', ' . $car->city->area : '' }}</p>
        </div>
        <hr class="divider divider-fade my-3 p-0"></hr>
        <div class="row align-items-center">
            <div class="col col-md-6 text-left">
                <p class="p-0 m-0">{{ $ownerType[$car->is_owner] }}</p>
                <p class="p-0 m-0 text-sm text-muted">#{{ $car->car_code }}</p>
            </div>
            <div class="col col-md-6 text-right">
                <button type="button" class="btn btn-outline-info btn-icon-label py-2" onclick="showContacts({{ $car->id }}, '{{ $car->car_code }}', 'car')">
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

