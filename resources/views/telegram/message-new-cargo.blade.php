{{ hex2bin('E29C85') }} <b>{{ $cargo -> cargo_name }}</b>
{{ hex2bin('F09F9188') }}: {{ $cargo->countryFrom->name }}, {{ $cargo->cityFrom->name }}, {{ $cargo->regionFrom->name }}
{{ hex2bin('F09F9189') }}: {{ $cargo->countryTo->name }}, {{ $cargo->cityTo->name }}, {{ $cargo->regionTo->name }}
{{ hex2bin('F09F9A9A') }}: {{ $cargo->carWeight->name }}
{{ hex2bin('F09F92B0') }}: {{ $cargo->price }} {{ $cargo->currency->code }} {{ $cargo->payType->name }}
<a href="{{ base_path() }}/cargo/{{ $cargo->id }}-{{ $cargo->cargo_code }}/{{ $cargo->cargo_name_slug }}">Посмотреть подробней...</a>
