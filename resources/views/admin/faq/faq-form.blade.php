<div class="form-group">
    <label class="form-control-label">Вопрос</label>
    <input name="question" class="form-control @error('question') is-invalid @enderror" type="text" placeholder="Напишите вопрос" value="{{ old('question') ?? $faq->question ?? '' }}">
    @error('question')
    <small class="text-danger">
        <strong>{{ $message }}</strong>
    </small>
    @enderror
</div>

<div class="form-group">
    <label class="form-control-label">Ответ</label>
    <input name="answer" class="form-control @error('answer') is-invalid @enderror" type="text" placeholder="Напишите ответ" value="{{ old('answer') ?? $faq->answer ?? '' }}" >
    @error('answer')
    <small class="text-danger">
        <strong>{{ $message }}</strong>
    </small>
    @enderror
</div>

<div class="form-group">
    <label class="form-control-label">ICO</label>
    <input name="ico" class="form-control @error('ico') is-invalid @enderror" type="text" placeholder="Название иконки Font Awesome, например: fa-link" value="{{ old('ico') ?? $faq->ico ?? '' }}">
    @error('ico')
    <small class="text-danger">
        <strong>{{ $message }}</strong>
    </small>
    @enderror
</div>
<div class="mt-3">
    <button type="submit" class="btn btn-sm btn-primary">Сохранить</button>
</div>
