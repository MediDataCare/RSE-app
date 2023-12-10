<header id="header" class="header fixed-top" data-scrollto-offset="0">

    <div class="container-fluid d-flex align-items-center justify-content-between">

        <a href="/" class="logo d-flex align-items-center scrollto me-auto me-lg-0">
            <!-- <img src="assets/img/logo.png" alt=""> -->
            <h1>MediData<span>Care<i class="fas fa-plus-circle"></i></span></h1>
            <!-- Antigo Logotipo da Pagina <h1>MediData<span>Care+</span></h1>-->
        </a>
        <!-- ALterado para Original <nav id="navbar" class="navbar w-md-100"> -->
        <nav id="navbar" class="navbar">
            @if ((request()->is('private')) || (request()->is('private/*')))
                <i class="bi bi-list mobile-nav-toggle d-none"></i>
                <ul class="">
                    <li><a class="nav-link scrollto" href="/private">Home</a></li>
                    @if(Auth::user()->data->role == 'admin')
                        <li><a class="nav-link scrollto" href="{{route('users-index')}}">Utilizadores</a></li>
                    @endif
                    <li><a class="nav-link scrollto" href="{{route('exam-type-index')}}">Dados</a></li>
                    <li><a class="nav-link scrollto"  href="{{route('entities')}}">Entidades</a></li>
                    <!-- <a class="btn-getstarted scrollto w-md-100" href="/login">Login <i class="fas fa-user"></i></a> -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="btn-getstarted scrollto" href="/login">Login <i class="fas fa-user"></i></a>
                            </li>
                        @endif
                        @else
                        <li class="dropdown">
                            <a id="navbarDropdown" class="btn-getstarted scrollto dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>
                            <ul>
                                <li><a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a></li>
                            </ul>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    @endguest
                </ul>
            @else
            <i class="bi bi-list mobile-nav-toggle d-none"></i>
            <ul class="gap-3">
                <li><a class="nav-link scrollto" href="/">Home</a></li>
                @auth
                @if(Auth::user()->data && Auth::user()->data->role)
                    @if(Auth::user()->data->role == 'manager' || Auth::user()->data->role == 'admin')
                        <li><a class="nav-link scrollto" href="/private">Backoffice</a></li>
                    @endif
                @endif
                @endauth
                @auth
                    @if(Auth::user()->data && Auth::user()->data->role)
                        @if((Auth::user()->data->role == 'user' && empty(Auth::user()->data->entitie)) || Auth::user()->data->role == 'admin')
                            <li><a class="nav-link scrollto" href="/user/form">Inserir Dados</a></li>
                        @endif
                    @endif
                @endauth
                @auth
                @if(Auth::user()->data && Auth::user()->data->role)
                    @if((Auth::user()->data->role == 'entitie' || !empty(Auth::user()->data->entitie)) || Auth::user()->data->role == 'admin')
                        <li><a href="/entitie/form">Criar Estudo</a></li>
                    @endif
                @endif
                @endauth
                @guest
                    @if (Route::has('login'))
                        <li class="dropdown"><a href="#">Registar <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                            <ul>
                                <li><a href="/register">Utilizador</a></li>
                                <li><a href="/resgiter-entitie">Entidade</a></li>
                            </ul>
                        </li>
                    @endif
                @endguest
                <!-- <li><a class="nav-link scrollto" href="/contact">Contactos</a></li> -->
                <!-- <a class="btn-getstarted scrollto w-md-100" href="/login">Login <i class="fas fa-user"></i></a> -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="btn-getstarted scrollto" href="/login">Login <i class="fas fa-user"></i></a>
                        </li>
                    @endif
                    @else
                    <li class="dropdown">
                        <a id="navbarDropdown" class="btn-getstarted scrollto dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>
                        <ul>
                            @if(Auth::user()->data && Auth::user()->data->role)
                                @if(Auth::user()->data->role == 'entitie'|| !empty(Auth::user()->data->entitie) || Auth::user()->data->role == 'admin')
                                    @if(Auth::user()->data->role == 'admin')
                                        <li><a href="/entitie/profile">Perfil Entidade</a></li>
                                    @else
                                        <li><a href="/entitie/profile">Perfil</a></li>
                                    @endif
                                @endif
                                @if(Auth::user()->data->role == 'user' && empty(Auth::user()->data->entitie) || Auth::user()->data->role == 'admin')
                                    @if(Auth::user()->data->role == 'admin')
                                        <li><a href="/user/profile">Perfil User</a></li>
                                    @else
                                        <li><a href="/user/profile">Perfil</a></li>
                                    @endif
                                @endif
                            @endif
                            <li><a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();">
                                 {{ __('Logout') }}
                             </a></li>
                        </ul>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                @endguest
            </ul>
            @endif
        </nav>

    </div>
</header>
