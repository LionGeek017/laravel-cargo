@extends('admin.index')
@section('content')
    <!-- Form add cargo -->
    <section class="slice slice-lg pt-3">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div>
                        <div class="mb-5 text-center">
                            <h6 class="h3">{{ $content->name }}</h6>
                            <p class="text-muted mb-0">Здесь можно изменить информацию статической страницы</p>
                        </div>
                        <span class="clearfix"></span>
                        <form enctype="multipart/form-data" role="form" class="border p-4" method="POST" action="{{ route('adminchik.contents.update', ['content' => $content->id]) }}">
                            @csrf
                            @method('PATCH')

                            <div class="form-group">
                                <label class="form-control-label">Имя</label>
                                <input name="name" class="form-control @error('name') is-invalid @enderror" type="text" placeholder="Название страницы" value="{{ old('name') ?? $content->name ?? '' }}">
                                @error('name')
                                <small class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-control-label">URL</label>
                                <input name="slug" class="form-control @error('slug') is-invalid @enderror" type="text" placeholder="URL страницы, например: rules" value="{{ old('slug') ?? $content->slug ?? '' }}" >
                                @error('slug')
                                <small class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="form-group">
                                    <label class="form-control-label">Текст</label>
                                    <textarea placeholder="Текст" rows="10" class="form-control" name="content">{{ old('content') ?? $content->content ?? '' }}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-control-label">Meta Title</label>
                                <input name="meta_title" class="form-control @error('meta_title') is-invalid @enderror" type="text" placeholder="Название страницы" value="{{ old('meta_title') ?? $content->meta_title ?? '' }}">
                                @error('meta_title')
                                <small class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-control-label">Meta Description</label>
                                <input name="meta_description" class="form-control @error('meta_description') is-invalid @enderror" type="text" placeholder="Описание" value="{{ old('meta_description') ?? $content->meta_description ?? '' }}">
                                @error('meta_description')
                                <small class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-control-label">Meta Keywords</label>
                                <input name="meta_keywords" class="form-control @error('meta_keywords') is-invalid @enderror" type="text" placeholder="Ключевые слова" value="{{ old('meta_keywords') ?? $content->meta_keywords ?? '' }}">
                                @error('meta_keywords')
                                <small class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </small>
                                @enderror
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-sm btn-primary">Сохранить</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
