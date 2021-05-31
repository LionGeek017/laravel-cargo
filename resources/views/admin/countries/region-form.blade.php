<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <label class="form-control-label">Страна</label>
            <select class="form-control" data-toggle="select" name="country_id" id="select_country_id">
                <option value="0">Выберите страну</option>
                @foreach($countries as $country)
                    <option value="{{ $country->id }}" {{ old('country_id', $region->country_id ?? $countryId) == $country->id ? "selected" : "" }}>{{ $country->name }}</option>
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
            <label class="form-control-label">Имя</label>
            <input name="name" class="form-control @error('name') is-invalid @enderror" type="text" placeholder="Название региона" value="{{ old('name') ?? $region->name ?? '' }}">
            @error('name')
            <small class="text-danger">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group">
            <div class="form-group">
                <label class="form-control-label">VK API ID</label>
                <input name="vk_id" class="form-control @error('vk_id') is-invalid @enderror" type="text" placeholder="ID страны в VK API" value="{{ old('vk_id') ?? $region->vk_id ?? '' }}">
                @error('vk_id')
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
