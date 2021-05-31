<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="form-group">
            <label class="form-control-label">Имя</label>
            <input name="name" class="form-control @error('name') is-invalid @enderror" type="text" placeholder="Название категории" value="{{ old('name') ?? $category->name ?? '' }}">
            @error('name')
            <small class="text-danger">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
        </div>
    </div>
    <div class="col-lg-12">
        <div class="form-group">
            <label class="form-control-label">URL</label>
            <input name="slug" class="form-control @error('slug') is-invalid @enderror" type="text" placeholder="Введите URL категории, например: news" value="{{ old('slug') ?? $category->slug ?? '' }}">
            @error('slug')
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
                <input name="description" class="form-control @error('description') is-invalid @enderror" type="text" placeholder="Краткое описание, 3-5 слов" value="{{ old('description') ?? $category->description ?? '' }}">
                @error('description')
                <small class="text-danger">
                    <strong>{{ $message }}</strong>
                </small>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <label class="form-control-label">Изображение</label>
        <input type="file" name="img" id="img" class="custom-input-file @error('img') is-invalid @enderror" data-multiple-caption=""/>
        <label for="img">
            <i class="fa fa-upload"></i>
            <span>Загрузите заставку категории</span>
        </label>
        @error('img')
        <small class="text-danger">
            <strong>{{ $message }}</strong>
        </small>
        @enderror
        @if(isset($category))
            <div class="rounded img-blog-edit my-3" style="background-image: url('{{ URL::asset($category->img ?? 'img/default.jpg') }}')"></div>
        @endif
    </div>
{{--    <img width="80" src="{{ URL::asset($category->img ?? 'img/default.jpg') }}" />--}}
    <div class="col-lg-12 mt-3">
        <div class="form-group">
            <label class="form-control-label">Meta Title</label>
            <input name="meta_title" class="form-control @error('meta_title') is-invalid @enderror" type="text" placeholder="Заголовок" value="{{ old('meta_title') ?? $category->meta_title ?? '' }}">
            @error('meta_title')
            <small class="text-danger">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
        </div>
    </div>

    <div class="col-lg-12">
        <div class="form-group">
            <label class="form-control-label">Meta Description</label>
            <input name="meta_description" class="form-control @error('meta_description') is-invalid @enderror" type="text" placeholder="Описание: до 30 слов" value="{{ old('meta_description') ?? $category->meta_description ?? '' }}">
            @error('meta_description')
            <small class="text-danger">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
        </div>
    </div>

    <div class="col-lg-12">
        <div class="form-group">
            <label class="form-control-label">Meta Keywords</label>
            <input name="meta_keywords" class="form-control @error('meta_keywords') is-invalid @enderror" type="text" placeholder="Ключевые слова" value="{{ old('meta_keywords') ?? $category->meta_keywords ?? '' }}">
            @error('meta_keywords')
            <small class="text-danger">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
        </div>
    </div>

    <div class="mt-3">
        <button type="submit" class="btn btn-sm btn-primary">Сохранить</button>
    </div>
</div>
