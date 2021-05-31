<img alt="Image placeholder" src="https://www.gravatar.com/avatar/{{ md5( strtolower( trim( $email ?? Auth::user()->email ) ) ) }}?d=identicon" class="avatar  rounded-circle {{ $nexClass ?? '' }}"/>
