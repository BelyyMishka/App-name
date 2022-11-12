<header class="">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('index') }}"><h2>{{ env('APP_NAME') }}<em>.</em></h2></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                    aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item @if(\Illuminate\Support\Facades\Route::currentRouteName() == 'index') active @endif">
                        <a class="nav-link" href="{{ route('index') }}">Home</a>
                    </li>
                    <li class="nav-item @if(\Illuminate\Support\Facades\Route::currentRouteName() == 'posts.index') active @endif">
                        <a class="nav-link" href="{{ route('posts.index') }}">Blog</a>
                    </li>
                    @auth
                        <li class="nav-item @if(\Illuminate\Support\Facades\Route::currentRouteName() == 'posts.create') active @endif">
                            <a class="nav-link" href="{{ route('posts.create') }}">Create post</a>
                        </li>
                    @endauth
                    @auth
                        <li class="nav-item @if(\Illuminate\Support\Facades\Request::is('profile/*') || \Illuminate\Support\Facades\Request::is('profile')) active @endif">
                            <a class="nav-link" href="{{ route('profile.index') }}">Profile</a>
                        </li>
                    @endauth
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('auth.loginForm') }}">Login</a>
                        </li>
                    @endguest
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('auth.logout') }}">Logout</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
</header>
