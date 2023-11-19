<nav class="navbar navbar-light fixed-top bg-light flex-md-nowrap p-0 shadow">
    <div>
        @if(Auth::check())
            <span class="mobile-menu-btn ml-2 ml-sm-3"><i class="fa-solid fa-bars"></i></span>
        @endif
        <a href="/" class="navbar-brand mr-0 px-3">Product Feedback App</a>
    </div>
    @guest()
        <ul class="navbar-nav main-nav px-3">
            <li class="nav-item">
                <a class="nav-link d-inline-block" href="{{ route('login') }}">Login</a>
                <span class="mx-1">/</span>
                <a class="nav-link d-inline-block" href="{{ route('register') }}">Register</a>
            </li>
        </ul>
    @else
        <div class="auth-dropdown dropdown mx-3">
            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ Auth::user()->name }}
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    @endguest
</nav>
