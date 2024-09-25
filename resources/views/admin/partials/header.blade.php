<header>
    <nav class="bg-primary text-white" data-bs-theme="primary">
        <div class="container-fluid">
            <div class="py-1 d-flex justify-content-between align-items-center">
                <div class="ms-4">
                    <a href="{{route('home')}}" target="_blank">BOOLFOLIO</a>
                </div>
                <div>
                    <ul class="navbar-nav me-4">
                        @guest
                        <ul class="d-flex gap-3">
                            <li class="nav-item">
                                <a href="{{route('login')}}">Login</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('register')}}">Registrati</a>
                            </li>
                        </ul>
                        @else
                        <li class="nav-item">
                            <a href="#">{{Auth::user()->home}}</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('admin.home') }}">Admin</a>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest

                    </ul>
                </div>

            </div>
        </div>

    </nav>
</header>
