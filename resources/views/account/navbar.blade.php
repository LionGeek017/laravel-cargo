<ul class="nav nav-tabs mb-4">
    <li class="nav-item">
        <a class="nav-link {{ Route::is('account.cargo') ? 'active' : '' }}" href="{{ route('account.cargo') }}">Мои грузы</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::is('account.car') ? 'active' : '' }}" href="{{ route('account.car') }}">Мои автомобили</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::is('account.subscriptions') ? 'active' : '' }}" href="{{ route('account.subscriptions') }}">Подписки</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::is('account.settings') ? 'active' : '' }}" href="{{ route('account.settings') }}">Настройки</a>
    </li>
</ul>
