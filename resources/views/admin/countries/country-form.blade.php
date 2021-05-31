<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <label class="form-control-label">Имя</label>
            <input name="name" class="form-control @error('name') is-invalid @enderror" type="text" placeholder="Название страны" value="{{ old('name') ?? $country->name ?? '' }}">
            @error('name')
            <small class="text-danger">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label class="form-control-label">Код</label>
            <input name="code" class="form-control @error('code') is-invalid @enderror" type="text" placeholder="Код страны: UA" value="{{ old('code') ?? $country->code ?? '' }}">
            @error('code')
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
                <input name="vk_id" class="form-control @error('vk_id') is-invalid @enderror" type="text" placeholder="ID страны в VK API" value="{{ old('vk_id') ?? $country->vk_id ?? '' }}">
                @error('vk_id')
                <small class="text-danger">
                    <strong>{{ $message }}</strong>
                </small>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="status_from" name="status_from"
                   value="1" {{ old('status_from', $country->status_from ?? null) ? 'checked' : '' }}>
            <label class="custom-control-label" for="status_from">Доступна как отправная точка</label>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="active" name="active"
                   value="1" {{ old('active', $country->active ?? null) ? 'checked' : '' }}>
            <label class="custom-control-label" for="active">Активна</label>
        </div>
    </div>

    <div class="col-12 mt-3">
        <button type="submit" class="btn btn-sm btn-primary">Сохранить</button>
    </div>
</div>
