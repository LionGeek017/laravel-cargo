<!-- Form search cargo -->
<section class="slice pb-4">
    <div class="container">
        <div class="">
{{--            <div class="mb-5 text-center">--}}
{{--                <h6 class="h3">Найти груз</h6>--}}
{{--            </div>--}}
            <span class="clearfix"></span>
            <form role="form" class="border" method="GET" action="{{ route('cargo.search') }}">
                <div class="row m-4">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label class="form-control-label">Где забрать</label>
                            <div class="mb-3">
                                <select class="form-control" data-toggle="select" name="country_id_from" id="select_country_id_from" data-child="select_region_id_from" data-countryidactive="{{ $countryUser->id }}">
                                    @foreach($formData->countries as $country)
                                        <option value="{{ $country->id }}" {{ request('country_id_from', $countryUser->id) == $country->id ? "selected" : "" }}>{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <select class="form-control" data-toggle="select" name="region_id_from" id="select_region_id_from" data-child="select_city_id_from" data-title="Любой">
                                    <option value="0">Любой</option>
                                    @foreach($formData->regionsFrom as $region)
                                        <option value="{{ $region->id }}" {{ request('region_id_from') == $region->id ? "selected" : "" }}>{{ $region->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <select class="form-control" data-toggle="select" name="city_id_from" id="select_city_id_from" data-title="Любой">
                                    <option value="0">Любой</option>
                                    @if(old('city_id_from') || $formData->citiesFrom)
                                        @foreach($formData->citiesFrom as $city)
                                            <option value="{{ $city->id }}" {{ request('city_id_from') == $city->id ? "selected" : "" }}>{{ $city->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label class="form-control-label">Куда доставить</label>
                            <div class="mb-3">
                                <select class="form-control" data-toggle="select" name="country_id_to" id="select_country_id_to" data-child="select_region_id_to" data-countryidactive="{{ $countryUser->id }}">
                                    @foreach($formData->countries as $country)
                                        <option value="{{ $country->id }}" {{ request('country_id_to', $countryUser->id) == $country->id ? "selected" : "" }}>{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <select class="form-control" data-toggle="select" name="region_id_to" id="select_region_id_to" data-child="select_city_id_to" data-title="Любой">
                                    <option value="0">Любой</option>
                                    @foreach($formData->regionsTo as $region)
                                        <option value="{{ $region->id }}" {{ request('region_id_to') == $region->id ? "selected" : "" }}>{{ $region->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <select class="form-control" data-toggle="select" name="city_id_to" id="select_city_id_to" data-title="Любой">
                                    <option value="0">Любой</option>
                                    @if(old('city_id_to') || $formData->citiesTo)
                                        @foreach($formData->citiesTo as $city)
                                            <option value="{{ $city->id }}" {{ request('city_id_to') == $city->id ? "selected" : "" }}>{{ $city->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row m-4">
                    <div class="col-md-3">
                        <div class="">
                            <label class="form-control-label">Грузоподъемность</label>
                            <select class="custom-select" data-toggle="select" name="car_weight_id" data-title="Любая">
                                <option value="0">Любая</option>
                                @foreach($formData->weights as $weight)
                                    <option value="{{ $weight->id }}" {{ request('car_weight_id') == $weight->id ? "selected" : "" }}>{{ $weight->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="">
                            <label class="form-control-label">Тип кузова</label>
                            <select class="custom-select" data-toggle="select" name="car_body_id" data-title="Любой">
                                <option value="0">Любой</option>
                                @foreach($formData->bodies as $body)
                                    <option value="{{ $body->id }}" {{ request('car_body_id') == $body->id ? "selected" : "" }}>{{ $body->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex align-items-end justify-content-center">
                        <div class="">
                            <button type="submit" class="btn btn-primary btn-icon rounded-pill">
                                <span class="btn-inner--text">Искать</span>
                                <span class="btn-inner--icon"><i class="fas fa-search"></i></span>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
