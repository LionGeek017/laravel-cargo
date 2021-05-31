<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label class="form-control-label">Страна</label>
            <select class="form-control" data-toggle="select" name="country_id" id="select_country_id" data-child="select_region_id">
                <option value="0">Выберите страну</option>
                @foreach($countries as $country)
                    <option value="{{ $country->id }}" {{ old('country_id', $city->country_id ?? $countryId) == $country->id ? "selected" : "" }}>{{ $country->name }}</option>
                @endforeach
            </select>
            @error('country_id')
            <small class="text-danger">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label class="form-control-label">Регион</label>
            <select class="form-control" data-toggle="select" name="region_id" id="select_region_id" data-title="Выберите регион">
                <option value="0">Выберите регион</option>
                @if($regions)
                    @foreach($regions as $region)
                        <option value="{{ $region->id }}" {{ old('region_id', $city->region_id ?? $regionId) == $region->id ? "selected" : "" }}>{{ $region->name }}</option>
                    @endforeach
                @endif
            </select>
            @error('region_id')
            <small class="text-danger">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
        </div>
    </div>

    <div class="col-lg-12">
        <div class="form-group">
            <div class="form-group">
                <label class="form-control-label">Район</label>
                <input name="area" class="form-control" type="text" placeholder="Район (необязательно)" value="{{ old('area') ?? $city->area ?? '' }}">
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group">
            <div class="form-group">
                <label class="form-control-label">Имя</label>
                <input name="name" class="form-control @error('name') is-invalid @enderror" type="text" placeholder="Название города" value="{{ old('name') ?? $city->name ?? '' }}">
                @error('name')
                <small class="text-danger">
                    <strong>{{ $message }}</strong>
                </small>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group">
            <div class="form-group">
                <label class="form-control-label">VK API ID</label>
                <input name="vk_id" class="form-control @error('vk_id') is-invalid @enderror" type="text" placeholder="ID города в VK API" value="{{ old('vk_id') ?? $city->vk_id ?? '' }}">
                @error('vk_id')
                <small class="text-danger">
                    <strong>{{ $message }}</strong>
                </small>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group">
            <div class="form-group">
                <label class="form-control-label">Долгота</label>
                <input name="loc_lat" class="form-control @error('loc_lat') is-invalid @enderror" type="text" placeholder="Например: 46.1234" value="{{ old('loc_lat') ?? $city->loc_lat ?? '' }}">
                @error('loc_lat')
                <small class="text-danger">
                    <strong>{{ $message }}</strong>
                </small>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group">
            <div class="form-group">
                <label class="form-control-label">Широта</label>
                <input name="loc_lng" class="form-control @error('loc_lng') is-invalid @enderror" type="text" placeholder="Например: 52.4321" value="{{ old('loc_lng') ?? $city->loc_lng ?? '' }}">
                @error('loc_lng')
                <small class="text-danger">
                    <strong>{{ $message }}</strong>
                </small>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-12 mt-3">
        <button type="submit" class="btn btn-sm btn-primary">Сохранить</button>
    </div>
</div>
