@extends('admin.index')
@section('content')
    <!-- Form add cargo -->
    <section class="slice slice-lg pt-3">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div>
                        <div class="mb-5 text-center">
                            <h6 class="h3">Мета теги и СЕО</h6>
                            <p class="text-muted mb-0">Здесь можно изменить главные мета теги и сео тексты</p>
                        </div>
                        <span class="clearfix"></span>
                        <form enctype="multipart/form-data" role="form" class="border p-4" method="POST" action="{{ route('adminchik.metatags.update', ['metatag' => $post->id]) }}">
                            @csrf
                            @method('PATCH')

                            <div class="form-group">
                                <label class="form-control-label">Title</label>
                                <input name="title" class="form-control @error('title') is-invalid @enderror" type="text" placeholder="Заголовок" value="{{ old('title') ?? $post->title ?? '' }}">
                                @error('title')
                                <small class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-control-label">Description</label>
                                <input name="description" class="form-control @error('description') is-invalid @enderror" type="text" placeholder="Описание" value="{{ old('description') ?? $post->description ?? '' }}">
                                @error('description')
                                <small class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-control-label">Keywords</label>
                                <input name="keywords" class="form-control @error('keywords') is-invalid @enderror" type="text" placeholder="Ключевые слова" value="{{ old('keywords') ?? $post->keywords ?? '' }}">
                                @error('keywords')
                                <small class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </small>
                                @enderror
                            </div>

                            <label class="form-control-label">Изображение</label>
                            <input type="file" name="img" id="img" class="custom-input-file @error('img') is-invalid @enderror" data-multiple-caption=""/>
                            <label for="img">
                                <i class="fa fa-upload"></i>
                                <span>Загрузите картинку для тега og:image</span>
                            </label>
                            @error('img')
                            <small class="text-danger">
                                <strong>{{ $message }}</strong>
                            </small>
                            @enderror
                            @if($post->img)
                                <div class="rounded img-blog-edit my-3" style="background-image: url('{{ URL::asset($post->img) }}')"></div>
                            @endif

                            <div class="form-group">
                                <div class="form-group">
                                    <label class="form-control-label">Слоган на верх главной страницы</label>
                                    <textarea placeholder="Напишите красивый слоган" class="form-control" name="slogan_top">{{ old('slogan_top') ?? $post->slogan_top ?? '' }}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-group">
                                    <label class="form-control-label">СЕО текст на главную</label>
                                    <textarea placeholder="Текст" rows="10" class="form-control" name="seo_main">{{ old('seo_main') ?? $post->seo_main ?? '' }}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-group">
                                    <label class="form-control-label">СЕО текст на страницу грузов</label>
                                    <textarea placeholder="Текст" rows="10" class="form-control" name="seo_cargo">{{ old('seo_cargo') ?? $post->seo_cargo ?? '' }}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-group">
                                    <label class="form-control-label">СЕО текст на страницу машин</label>
                                    <textarea placeholder="Текст" rows="10" class="form-control" name="seo_car">{{ old('seo_car') ?? $post->seo_car ?? '' }}</textarea>
                                </div>
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
