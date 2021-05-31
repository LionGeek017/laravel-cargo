<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="form-group">
            <label class="form-control-label">ID пользователя</label>
            <select class="form-control" data-toggle="select" name="user_id">
                <option value="0">Выбрать</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id', $post->user->id ?? $userId ?? '') == $user->id ? "selected" : (($post->user->id ?? $userId) ? "disabled" : "") }}>ID: {{ $user->id }} - {{ $user->name ?? $user->email }}</option>
                @endforeach
            </select>
            {!! ($post->user->id ?? $userId) ? '<small>Изменить пользователя нельзя</small>' : '' !!}
            @error('user_id')
            <small class="text-danger">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
        </div>
    </div>

    <div class="col-lg-12">
        <div class="form-group">
            <label class="form-control-label">Тип подписки</label>
            <select class="form-control" data-toggle="select" name="subscription_id">
                @foreach($subscriptions as $subscription)
                    <option value="{{ $subscription->id }}" {{ old('subscription_id', $post->subscription_id ?? '') == $subscription->id ? "selected" : "" }}>{{ $subscription->title }}</option>
                @endforeach
            </select>
            @error('subscription_id')
            <small class="text-danger">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
        </div>
    </div>

    <div class="col-lg-12">
        <div class="form-group">
            <label class="form-control-label">Дата окончания</label>
            <input name="date_end" class="form-control @error('date_end') is-invalid @enderror" type="date" placeholder="Дата" value="{{ explode(' ', old('date_end', $post->date_end ?? ''))[0] ?? '' }}">
            @error('date_end')
            <small class="text-danger">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
        </div>
    </div>

    <div class="col-lg-12 mt-3 text-right">
        <input type="hidden" name="status" value="1"/>
        <button type="submit" class="btn btn-sm btn-primary">Сохранить</button>
    </div>
</div>
