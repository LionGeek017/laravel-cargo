<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="form-group">
            <label class="form-control-label">Название</label>
            <input name="title" class="form-control @error('title') is-invalid @enderror" type="text" placeholder="Название поста" value="{{ old('title') ?? $post->title ?? '' }}">
            @error('title')
            <small class="text-danger">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
        </div>
    </div>
    <div class="col-lg-12">
        <div class="form-group">
            <label class="form-control-label">Категория</label>
            <select class="form-control" data-toggle="select" name="category">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category', $post->category->id ?? '') == $category->id ? "selected" : "" }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="form-group">
            <div class="form-group">
                <label class="form-control-label">Краткое описание</label>
                <textarea placeholder="Напишите коротко о посте" class="form-control" name="text_short">{{ old('text_short') ?? $post->text_short ?? '' }}</textarea>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="form-group">
            <div class="form-group">
                <label class="form-control-label">Текст</label>
                <textarea placeholder="Полный текст поста" rows="10" class="form-control" name="text_full">{{ old('text_full') ?? $post->text_full ?? '' }}</textarea>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <label class="form-control-label">Изображение</label>
        <input type="file" name="img" id="img" class="custom-input-file @error('img') is-invalid @enderror" data-multiple-caption=""/>
        <label for="img">
            <i class="fa fa-upload"></i>
            <span>Загрузите заставку поста</span>
        </label>
        @error('img')
        <small class="text-danger">
            <strong>{{ $message }}</strong>
        </small>
        @enderror
        @if(isset($post))
            <div class="rounded img-blog-edit my-3" style="background-image: url('{{ URL::asset($post->img ?? 'img/default.jpg') }}')"></div>
        @endif
    </div>

    <div class="col-lg-12 mt-3">
        <div class="form-group">
            <label class="form-control-label">Meta Title</label>
            <input name="meta_title" class="form-control @error('meta_title') is-invalid @enderror" type="text" placeholder="Заголовок" value="{{ old('meta_title') ?? $post->meta_title ?? '' }}">
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
            <input name="meta_description" class="form-control @error('meta_description') is-invalid @enderror" type="text" placeholder="Описание: до 30 слов" value="{{ old('meta_description') ?? $post->meta_description ?? '' }}">
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
            <input name="meta_keywords" class="form-control @error('meta_keywords') is-invalid @enderror" type="text" placeholder="Ключевые слова" value="{{ old('meta_keywords') ?? $post->meta_keywords ?? '' }}">
            @error('meta_keywords')
            <small class="text-danger">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
        </div>
    </div>

    <div class="col-lg-12">
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="status" name="status"
                   value="1" {{ old('status', $post->status ?? null) ? 'checked' : '' }}>
            <label class="custom-control-label" for="status">Показывать пост на сайте</label>
        </div>
    </div>

    <div class="mt-3">
        <button type="submit" class="btn btn-sm btn-primary">Сохранить</button>
    </div>
</div>
