@extends('index')
@section('content')

    <section class="slice slice-lg pb-4">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb py-2">
                    <li class="breadcrumb-item"><a class="text-dark text-underline text-sm" href="{{ route('cargo.search') }}">Грузы</a></li>
                    <li class="breadcrumb-item"><a class="text-dark text-underline text-sm" href="{{ route('cargo.search', ['country_id_from' => $countryUser->id]) }}">{{ $countryUser->name }}</a></li>
                    <li class="breadcrumb-item"><a class="text-dark text-underline text-sm" href="{{ route('cargo.search', ['country_id_from' => $countryUser->id, 'region_id_from' => $cargo->regionFrom->id]) }}">{{ $cargo->regionFrom->name }}</a></li>
                    <li class="breadcrumb-item"><a class="text-dark text-underline text-sm" href="{{ route('cargo.search', ['country_id_from' => $countryUser->id, 'region_id_from' => $cargo->regionFrom->id, 'city_id_from' => $cargo->cityFrom->id]) }}">{{ $cargo->cityFrom->name }}</a></li>
                    <li class="breadcrumb-item active text-sm" aria-current="page">{{ $cargo->cargo_name }}</li>
                </ol>
            </nav>
        </div>
    </section>

    <section class="slice slice-lg pb-3">
        <div class="container">
            <h5 class="mb-1 d-block">{{ $cargo->cargo_name }}</h5>
            <p class="mb-3 p-0 text-sm text-muted">Подробная информация груза</p>
        </div>
    </section>

    <section class="slice slice-lg">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6">
                    @include('cargo.parts.card')
                    @can('optional',  $cargo)
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="jumbotron py-4">
                                <h6>Актуальность</h6>
                                <hr class="my-2">
                                @if($cargo->status > 0)
                                    <p class="text-sm">Заказ будет отмечен неактуальным {{ $actual }}.
                                @else
                                    <p class="text-sm">Неактуально
                                @endif
                                <br>Вы можете продлевать актуальность на 24 часа.</p>
                                <div class="text-center">
                                    <form action="{{ route('cargo.update_publish') }}" method="post">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="id" value="{{ $cargo->id }}">
                                        <button type="submit" class="btn btn-sm btn-success" title="Продлить актуальность на 24 часа">
                                            <span class="btn-inner--text">Продлить на 24 часа</span>
                                        </button>
                                    </form>
                                    @if($cargo->status > 0)
                                    <small class="text-sm p-0">
                                        <a href="#" class="dropdown-item mt-3 p-0" onclick="event.preventDefault(); document.getElementById('deactivate-form-{{ $cargo->id }}').submit();">Снять с публикации</a>
                                    </small>
                                    <form id="deactivate-form-{{ $cargo->id }}" action="{{ route('cargo.destroy_publish') }}" method="post">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="id" value="{{ $cargo->id }}">
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="card">
                                <div class="card-header py-3">
                                    <span class="h6">Контакты </span>
                                </div>
                                <div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <small class="h6 text-sm mb-3 mb-sm-0">
                                                        <i class="fas fa-user-tie"></i>
                                                    </small>
                                                </div>
                                                <div class="col-sm-9">
                                                    <span class="text-sm">{{ $cargo->contact_name }}</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <small class="h6 text-sm mb-3 mb-sm-0">
                                                        <i class="fas fa-phone"></i>
                                                    </small>
                                                </div>
                                                <div class="col-sm-9">
                                                    <span class="text-sm">{{ $cargo->contact_phone }}</span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endcan
                </div>
                <div class="col-12 col-md-6">
                    <iframe
                        id="mod-directions-map-active-iframe"
                        width="100%"
                        height="100%"
                        frameborder="0"
                        style="padding-bottom: 31px"
                        src="https://www.google.com/maps/embed/v1/directions?origin={{ $cargo->countryFrom->name }},{{ $cargo->cityFrom->name }},{{ $cargo->cityFrom->area }},{{ $cargo->regionFrom->name }}&amp;destination={{ $cargo->countryTo->name }},{{ $cargo->cityTo->name }},{{ $cargo->cityTo->area }},{{ $cargo->regionTo->name }}&amp;key=">
                    </iframe>
                </div>
            </div>
        </div>
    </section>

@endsection

