<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Proyecto Final con Laravel</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/script.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}" title="Inicio">
                Proyecto Final con Laravel
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <!-- Redirecciona a la página de login de usuario -->
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">
                                    {{ __('Login') }}
                                </a>
                            </li>

                            <!-- Redirecciona a la página de registro de usuario -->
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">
                                    {{ __('Register') }}
                                </a>
                            </li>
                        @else
                        
                        <!-- Redirecciona a la página de búsqueda de usuarios -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.showUsers') }}" title="Buscar">
                            <i class="fas fa-search"></i>
                            </a>
                        </li>

                        <!-- Redirecciona a la página principal de la web -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}" title="Inicio">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>

                        <!-- Redirecciona a la página de creación de una publicación -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('post.create') }}" title="Subir">
                                <i class="fas fa-arrow-up"></i>
                            </a>
                        </li>

                        <!-- Muestra la imagen de perfil -->
                        <li>
                            <a href="{{route('profile', ['id' => Auth::user()->id])}}" title="Perfil">
                                @if(Auth::user()->profileimage)
                                    @include('includes.avatar')
                                @endif
                            </a>
                        </li>

                        <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    <!-- Redirecciona a la página de perfil del usuario -->
                                    <a class="dropdown-item" href="{{route('profile', ['id' => Auth::user()->id])}}">
                                        Perfil
                                    </a>

                                    <!-- Redirecciona a la página de favoritos del usuario -->
                                    <a class="dropdown-item" href="{{route('userLikes')}}">
                                        Favoritos
                                    </a>

                                    <!-- Redirecciona a la página de edición de datos del usuario -->
                                    <a class="dropdown-item" href="{{ route('user.config') }}">
                                        Configuración
                                    </a>

                                    <!-- Cierra la sesión de usuario -->
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                        </li>

                        <!-- Muestra las opciones de herramientas de los usuarios administradores -->
                        @if(Auth::user()->role == 'admin')
                        <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Herramientas de Administrador <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    <!-- Redirecciona a la página de creación de categorías -->
                                    <a class="dropdown-item" href="{{route('profile', ['id' => Auth::user()->id])}}">
                                        Categorías
                                    </a>
                                    
                                </div>
                        </li>
                        @endif
                        
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
