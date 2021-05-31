<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="form-group">
            <label class="form-control-label">Название</label>
            <input name="title" class="form-control @error('title') is-invalid @enderror" type="text" placeholder="Название подписки" value="{{ old('title') ?? $post->title ?? '' }}">
            @error('title')
            <small class="text-danger">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
        </div>
    </div>

    <div class="col-lg-12">
        <div class="form-group">
            <div class="form-group">
                <label class="form-control-label">Описание</label>
                <textarea placeholder="Какие привилегии дает эта подписка" class="form-control" name="description">{{ old('description') ?? $post->description ?? '' }}</textarea>
                @error('description')
                <small class="text-danger">
                    <strong>{{ $message }}</strong>
                </small>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-lg-12 mt-3">
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Тип</label>
                    <input name="type" class="form-control @error('type') is-invalid @enderror" type="text" placeholder="На пример: 1" value="{{ old('type') ?? $post->type ?? '' }}">
                    @error('type')
                    <small class="text-danger">
                        <strong>{{ $message }}</strong>
                    </small>
                    @enderror
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Период</label>
                    <input name="period" class="form-control @error('period') is-invalid @enderror" type="text" placeholder="На сколько месяцев: 1" value="{{ old('period') ?? $post->period ?? '' }}">
                    @error('period')
                    <small class="text-danger">
                        <strong>{{ $message }}</strong>
                    </small>
                    @enderror
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Цена в $</label>
                    <input name="price" class="form-control @error('price') is-invalid @enderror" type="text" placeholder="Стоимость подписки" value="{{ old('price') ?? $post->price ?? '' }}">
                    @error('price')
                    <small class="text-danger">
                        <strong>{{ $message }}</strong>
                    </small>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 mt-3 text-right">
        <input type="hidden" name="status" value="1"/>
        <button type="submit" class="btn btn-sm btn-primary">Сохранить</button>
    </div>
</div>
