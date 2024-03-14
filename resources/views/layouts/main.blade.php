<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        @yield('title')
    </title>
    @vite(['resources/css/app.css', 'resources/css/app.scss', 'resources/js/app.js'])
</head>
<body>

<nav class="navbar navbar-expand-lg bg-primary">
    <div class="container-fluid">
        <a class="nav-link active" aria-current="page" href="{{ url('/')}}">AUTOEVALUACIÓN</a>   
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @if (Auth::check() && Auth::user()->rol->tipus == 'Administrador')
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Datos Maestros
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ url('alumne')}}">Admin</a></li>
                        <li><a class="dropdown-item" href="{{ url('cicle')}}">Profes</a></li>
                        <li><a class="dropdown-item" href="{{ url('cicle')}}">Alumnos</a></li>
                        {{-- <li><a class="dropdown-item" href="{{ url('/login')}}">Login</a></li> --}}
                    </ul>
                </li>
                @endif
            </ul>
            <form class="d-flex" role="search">
                <ul class="navbar-nav me-2">
                    @if (Auth::check())
                    <li class="form-control me-2">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                            {{ Auth::user()->nom }} {{ Auth::user()->cognom }}
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ url('/logout') }}">
                                <i class="bi bi-box-arrow-left"></i>Logout
                            </a>
                        </div>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link font-weight-bold" href="{{ url('/login') }}">
                            <i class="bi bi-box-arrow-in-right"></i> Login
                        </a>
                    </li>
                    @endif
                </ul>
            </form>
        </div>
    </div>
</nav>

@yield('contenido')

</body>
</html>
