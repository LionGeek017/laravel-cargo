
<div class="row m-4">
    <div class="col-12 col-md-6">
        <div class="form-group">
            <label class="form-control-label">Откуда</label>
            <div class="mb-3">
                <select class="form-control" data-toggle="select" name="country_id_from" id="select_country_id_from" data-child="select_region_id_from" data-countryidactive="{{ $countryUser->id }}">
                    @foreach($formData->countries as $country)
                        <option value="{{ $country->id }}" {{ old('country_id_from', $formData->cargo->country_id_from ?? $countryUser->id) == $country->id ? "selected" : "" }}>{{ $country->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <select class="form-control" data-toggle="select" name="region_id_from" id="select_region_id_from" data-child="select_city_id_from" data-title="Выберите регион">
                    <option value="0">Выберите регион</option>
                    @foreach($formData->regionsFrom as $region)
                        <option value="{{ $region->id }}" {{ old('region_id_from', $formData->cargo->region_id_from ?? '') == $region->id ? "selected" : "" }}>{{ $region->name }}</option>
                    @endforeach
                </select>
                @error('region_id_from')
                <small class="text-danger">
                    <strong>{{ $message }}</strong>
                </small><br/>
                @enderror
            </div>
            <div class="mb-3">
                <select class="form-control" data-toggle="select" name="city_id_from" id="select_city_id_from" data-title="Выберите город">
                    <option value="0">Выберите город</option>
                    @if(old('city_id_from') || $formData->citiesFrom)
                        @foreach($formData->citiesFrom as $city)
                            <option value="{{ $city->id }}" {{ old('city_id_from', $formData->cargo->city_id_from ?? '') == $city->id ? "selected" : "" }}>{{ $city->name }}</option>
                        @endforeach
                    @endif
                </select>
                @error('city_id_from')
                    <small class="text-danger">
                        <strong>{{ $message }}</strong>
                    </small>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="form-group">
            <label class="form-control-label">Куда</label>
            <div class="mb-3">
                <select class="form-control" data-toggle="select" name="country_id_to" id="select_country_id_to" data-child="select_region_id_to" data-countryidactive="{{ $countryUser->id }}">
                    @foreach($formData->countries as $country)
                        <option value="{{ $country->id }}" {{ old('country_id_to', $formData->cargo->country_id_to ?? $countryUser->id) == $country->id ? "selected" : "" }}>{{ $country->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <select class="form-control" data-toggle="select" name="region_id_to" id="select_region_id_to" data-child="select_city_id_to" data-title="Выберите регион">
                    <option value="0">Выберите регион</option>
                    @foreach($formData->regionsTo as $region)
                        <option value="{{ $region->id }}" {{ old('region_id_to', $formData->cargo->region_id_to ?? '') == $region->id ? "selected" : "" }}>{{ $region->name }}</option>
                    @endforeach
                </select>
                @error('region_id_to')
                <small class="text-danger">
                    <strong>{{ $message }}</strong>
                </small><br/>
                @enderror
            </div>
            <div class="mb-3">
                <select class="form-control" data-toggle="select" name="city_id_to" id="select_city_id_to" data-title="Выберите город">
                    <option value="0">Выберите город</option>
                    @if(old('city_id_to') || $formData->citiesTo)
                        @foreach($formData->citiesTo as $city)
                            <option value="{{ $city->id }}" {{ old('city_id_to', $formData->cargo->city_id_to ?? '') == $city->id ? "selected" : "" }}>{{ $city->name }}</option>
                        @endforeach
                    @endif
                </select>
                @error('city_id_to')
                <small class="text-danger">
                    <strong>{{ $message }}</strong>
                </small>
                @enderror
            </div>
        </div>
    </div>
</div>
<div class="row mx-4">
    <div class="col-md-12">
        <div class="form-group">
            <label class="form-control-label">Груз</label>
            <input class="form-control @error('cargo_name') is-invalid @enderror" type="text" name="cargo_name" placeholder="Мука в мешках, щебень, мебель..." value="{{ old('cargo_name', $formData->cargo->cargo_name ?? '') }}">
            @error('cargo_name')
            <small class="text-danger">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
        </div>
    </div>
</div>
<div class="row mx-4">
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-control-label">Грузоподъемность</label>
            <select class="custom-select form-control" data-toggle="select" name="car_weight_id" data-title="Выберите вес">
                <option value="0">Выберите вес</option>
                @foreach($formData->weights as $weight)
                    <option value="{{ $weight->id }}" {{ old('car_weight_id', $formData->cargo->car_weight_id ?? '') == $weight->id ? "selected" : "" }}>{{ $weight->name }}</option>
                @endforeach
            </select>
            @error('car_weight_id')
            <small class="text-danger">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-control-label">Тип кузова</label>
            <select class="custom-select form-control" data-toggle="select" name="car_body_id" data-title="Выберите тип кузова">
                <option value="0">Выберите тип кузова</option>
                @foreach($formData->bodies as $body)
                    <option value="{{ $body->id }}" {{ old('car_body_id', $formData->cargo->car_body_id ?? '') == $body->id ? "selected" : "" }}>{{ $body->name }}</option>
                @endforeach
            </select>
            @error('car_body_id')
            <small class="text-danger">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
        </div>
    </div>
</div>
<div class="row mx-4">
    <div class="col-md-3">
        <div class="form-group">
            <label class="form-control-label @error('price') is-invalid @enderror">Цена</label>
            <input class="form-control" type="text" name="price" placeholder="Стоимость перевозки" value="{{ old('price', $formData->cargo->price ?? '') }}">
            @error('price')
            <small class="text-danger">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="form-control-label">Валюта</label>
            <select class="custom-select form-control" data-toggle="select" name="currency_id" data-title="Выбрать">
                <option value="0">Выбрать</option>
                @foreach($formData->currencies as $currency)
                    <option value="{{ $currency->id }}" {{ old('currency_id', $formData->cargo->currency_id ?? '') == $currency->id ? "selected" : "" }}>{{ $currency->name }}</option>
                @endforeach
            </select>
            @error('currency_id')
            <small class="text-danger">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="form-control-label">Оплата за</label>
            <select class="custom-select form-control" data-toggle="select" name="price_type_id" data-title="Выбрать">
                <option value="0">Выбрать</option>
                @foreach($formData->priceTypes as $priceType)
                    <option value="{{ $priceType->id }}" {{ old('price_type_id', $formData->cargo->price_type_id ?? '') == $priceType->id ? "selected" : "" }}>{{ $priceType->name }}</option>
                @endforeach
            </select>
            @error('price_type_id')
            <small class="text-danger">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="form-control-label">Способ оплаты</label>
            <select class="custom-select form-control" data-toggle="select" name="pay_type_id" data-title="Выбрать">
                <option value="0">Выбрать</option>
                @foreach($formData->payTypes as $payType)
                    <option value="{{ $payType->id }}" {{ old('pay_type_id', $formData->cargo->pay_type_id ?? '') == $payType->id ? "selected" : "" }}>{{ $payType->name }}</option>
                @endforeach
            </select>
            @error('pay_type_id')
            <small class="text-danger">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
        </div>
    </div>
</div>
<div class="row mx-4">
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-control-label">Имя / компания</label>
            <input class="form-control @error('contact_name') is-invalid @enderror" type="text" name="contact_name" placeholder="Ваше имя или название компании" value="{{ old('contact_name', $formData->cargo->contact_name ?? '') }}">
            @error('contact_name')
            <small class="text-danger">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-control-label">Телефон</label>
            <input class="form-control @error('contact_phone') is-invalid @enderror" type="text" name="contact_phone" placeholder="0661234567" value="{{ old('contact_phone', $formData->cargo->contact_phone ?? '') }}">
            @error('contact_phone')
            <small class="text-danger">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
        </div>
    </div>
</div>
<div class="row m-4 align-items-center">
    <div class="col-12 col-md-6">
        <button type="submit" class="btn btn-sm btn-primary btn-icon rounded-pill">
            <span class="btn-inner--text">Сохранить</span>
            <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
        </button>
    </div>
    <div class="col-12 col-md-6 text-right">
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="customRadioInline1" value="1" name="owner_type" checked class="custom-control-input">
            <label class="custom-control-label" for="customRadioInline1">Владелец</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="customRadioInline2" value="2" name="owner_type" {{ old('owner_type', $formData->cargo->owner_type ?? null) == 2 ? 'checked' : '' }} class="custom-control-input">
            <label class="custom-control-label" for="customRadioInline2">Диспетчер</label>
        </div>
    </div>
</div>
