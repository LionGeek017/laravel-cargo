<div class="row m-4">
    <div class="col-md-4">
        <div class="form-group">
            <label class="form-control-label">Страна</label>
            <select class="form-control" data-toggle="select" name="country_id" id="select_country_id" data-child="select_region_id">
                @foreach($formData->countries as $country)
                    <option value="{{ $country->id }}" {{ old('country_id', $formData->car->country_id ?? $countryUser->id) == $country->id ? "selected" : "" }}>{{ $country->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="form-control-label">Регион</label>
            <select class="form-control" data-toggle="select" name="region_id" id="select_region_id" data-child="select_city_id" data-title="Выберите регион">
                <option value="0">Выберите регион</option>
                @foreach($formData->regions as $region)
                    <option value="{{ $region->id }}" {{ old('region_id', $formData->car->region_id ?? '') == $region->id ? "selected" : "" }}>{{ $region->name }}</option>
                @endforeach
            </select>
            @error('region_id')
                <small class="text-danger">
                    <strong>{{ $message }}</strong>
                </small>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="form-control-label">Город</label>
            <select class="form-control" data-toggle="select" name="city_id" id="select_city_id" data-title="Выберите город">
                <option value="0">Выберите город</option>
                @if(old('city_id') || $formData->cities)
                    @foreach($formData->cities as $city)
                        <option value="{{ $city->id }}" {{ old('city_id', $formData->car->city_id ?? '') == $city->id ? "selected" : "" }}>{{ $city->name }}</option>
                    @endforeach
                @endif
            </select>
            @error('city_id')
                <small class="text-danger">
                    <strong>{{ $message }}</strong>
                </small>
            @enderror
        </div>
    </div>
</div>
<div class="row m-4">
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-control-label">Имя / компания</label>
            <input class="form-control @error('contact_name') is-invalid @enderror" type="text" placeholder="Ваше имя или название компании" name="contact_name" value="{{ old('contact_name', $formData->car->contact_name ?? '') }}">
            @error('contact_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-control-label">Телефон</label>
            <input class="form-control @error('contact_phone') is-invalid @enderror" type="text" placeholder="+40-777 245 549" name="contact_phone" value="{{ old('contact_phone', $formData->car->contact_phone ?? '') }}">
            @error('contact_phone')
                <small class="text-danger">
                    <strong>{{ $message }}</strong>
                </small>
            @enderror
        </div>
    </div>
</div>
<div class="row m-4">
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-control-label">Тип кузова</label>
            <select class="custom-select form-control" data-toggle="select" name="car_body_id" data-title="Выберите тип кузова">
                <option value="0">Выберите тип кузова</option>
                @foreach($formData->bodies as $body)
                    <option value="{{ $body->id }}" {{ old('car_body_id', $formData->car->car_body_id ?? '') == $body->id ? "selected" : "" }}>{{ $body->name }}</option>
                @endforeach
            </select>
            @error('car_body_id')
                <small class="text-danger">
                    <strong>{{ $message }}</strong>
                </small>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-control-label">Грузоподъемность</label>
            <select class="custom-select form-control" data-toggle="select" name="car_weight_id" data-title="Выберите вес">
                <option value="0">Выберите вес</option>
                @foreach($formData->weights as $weight)
                    <option value="{{ $weight->id }}" {{ old('car_weight_id', $formData->car->car_weight_id ?? '') == $weight->id ? "selected" : "" }}>{{ $weight->name }}</option>
                @endforeach
            </select>
            @error('car_weight_id')
            <small class="text-danger">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
        </div>
    </div>
</div>
<div class="row mx-4">
    <div class="col-md-12">
        <div class="custom-control custom-switch mt-2">
            <input type="checkbox" class="custom-control-input" id="customSwitch1" name="is_owner" {{ old('is_owner', $formData->car->is_owner ?? null) ? 'checked' : '' }}>
            <label class="custom-control-label" for="customSwitch1">являюсь водителем данного ТС</label>
        </div>

        <div class="custom-control custom-switch mt-2">
            <input type="checkbox" class="custom-control-input" id="customSwitch2" name="is_loc_agree" {{ old('is_loc_agree', $formData->car->is_loc_agree ?? null) ? 'checked' : '' }}>
            <label class="custom-control-label" for="customSwitch2">согласен на передачу данных GPS</label>
        </div>

        <div class="custom-control custom-switch mt-2">
{{--            <input type="checkbox" class="custom-control-input" id="customSwitch3" name="available" {{ old('available', $formData->car->available ?? null) ? 'checked' : '' }}>--}}
            <input type="checkbox" class="custom-control-input" id="customSwitch3" name="available" checked>
            <label class="custom-control-label" for="customSwitch3">свободен</label>
        </div>
    </div>
</div>
<div class="row m-4">
    <div class="col-md-12">
        <button class="btn btn-sm btn-primary btn-icon rounded-pill">
            <span class="btn-inner--text">Сохранить</span>
            <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
        </button>
    </div>
</div>
