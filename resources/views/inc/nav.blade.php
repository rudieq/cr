            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link{{ request()->routeIs('users.*') ? ' active' : '' }}" href="{{ route('users.index') }}">{{ __('Users') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ request()->routeIs('computers.*') ? ' active' : '' }}" href="{{ route('computers.index') }}">{{ __('Computers') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ request()->routeIs('estates.*') ? ' active' : '' }}" href="{{ route('estates.index') }}">{{ __('Estates') }}</a>
                </li>
            </ul>