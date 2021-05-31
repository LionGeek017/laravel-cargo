<!-- Form search car -->
<section class="slice pb-4">
    <div class="container">
        <div class="">
{{--            <div class="mb-5 text-center">--}}
{{--                <h6 class="h3">Найти машину</h6>--}}
{{--            </div>--}}
            <span class="clearfix"></span>
            <form role="form" class="border" method="GET" action="{{ route('car.search') }}">
                <div class="row m-4">
                    <div class="col col-md-4">
                        <label class="form-control-label">Страна</label>
                        <div class="mb-3">
                            <select class="form-control" data-toggle="select" name="country_id" id="select_country_id" data-child="select_region_id" data-countryidactive="{{ $countryUser->id }}">
                                @foreach($formData->countries as $country)
                                    <option value="{{ $country->id }}" {{ request('country_id', $countryUser->id) == $country->id ? "selected" : "" }}>{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col col-md-4">
                        <label class="form-control-label">Регион</label>
                        <div class="mb-3">
                            <select class="form-control" data-toggle="select" name="region_id" id="select_region_id" data-child="select_city_id" data-title="Любой">
                                <option value="0">Любой</option>
                                @foreach($formData->regions as $region)
                                    <option value="{{ $region->id }}" {{ request('region_id') == $region->id ? "selected" : "" }}>{{ $region->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col col-md-4">
                        <label class="form-control-label">Город</label>
                        <div class="mb-3">
                            <select class="form-control" data-toggle="select" name="city_id" id="select_city_id" data-title="Любой">
                                <option value="0">Любой</option>
                                @if(old('city_id') || $formData->cities)
                                    @foreach($formData->cities as $city)
                                        <option value="{{ $city->id }}" {{ request('city_id') == $city->id ? "selected" : "" }}>{{ $city->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col col-md-4">
                        <label class="form-control-label">Грузоподъемность</label>
                        <select class="custom-select" data-toggle="select" name="car_weight_id" data-title="Любая">
                            <option value="0">Любая</option>
                            @foreach($formData->weights as $weight)
                                <option value="{{ $weight->id }}" {{ request('car_weight_id') == $weight->id ? "selected" : "" }}>{{ $weight->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col col-md-4">
                        <label class="form-control-label">Тип кузова</label>
                        <select class="custom-select" data-toggle="select" name="car_body_id" data-title="Любой">
                            <option value="0">Любой</option>
                            @foreach($formData->bodies as $body)
                                <option value="{{ $body->id }}" {{ request('car_body_id') == $body->id ? "selected" : "" }}>{{ $body->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col col-md-4 d-flex align-items-end justify-content-center">
                        <div>
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
