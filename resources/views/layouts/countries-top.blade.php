<ul class="nav">
    <li class="nav-item dropdown ml-lg-2">
        <a class="nav-link px-0 country-active-a" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="0,10">
            <img alt="Image placeholder" class="country-active-img" src="{{ URL::asset('img/icons/flags/'.Str::lower($countryUser->code).'.svg') }}">
            <span class="d-none d-lg-inline-block country-active-name">{{ $countryUser->name }}</span>
            <span class="d-lg-none country-active-code">{{ $countryUser->code }}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-sm shadow list-countries-top">
            @foreach($countries as $country)
                <a href="#" data-code="{{ Str::lower($country->code) }}" class="dropdown-item"><img alt="Image placeholder" src="{{ URL::asset('img/icons/flags/'.Str::lower($country->code).'.svg') }}"><span>{{ $country->name }}</span></a>
            @endforeach
        </div>
    </li>
</ul>
