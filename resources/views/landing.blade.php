<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/css/app.scss'])
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>EASYHELP</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-primary">
        <div class="container-fluid">
            <a class="nav-link active" aria-current="page" href="{{ url('/') }}">AUTOEVALUACIÓN</a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @if (Auth::check() && Auth::user()->rol->tipus == 'Administrador')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Datos Maestros
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ url('alumne') }}">Admin</a></li>
                                <li><a class="dropdown-item" href="{{ url('cicle') }}">Profes</a></li>
                                <li><a class="dropdown-item" href="{{ url('cicle') }}">Alumnos</a></li>
                                {{-- <li><a class="dropdown-item" href="{{ url('/login')}}">Login</a></li> --}}
                            </ul>
                        </li>
                    @endif
                </ul>
                <form class="d-flex" role="search">
                    <ul class="navbar-nav me-2">
                        @if (Auth::check())
                            <li class="form-control me-2">
                                <a class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
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

    <div class="registroUsuario">
        <h3>Ayudemos Facil y rapido</h3>
        <p>Con EasyHelp podrás encontrar la mejor solución a tus problemas de forma rápida y sencilla</p>
        <a href="{{ url('/login') }}" class="btn btn-primary inicioSesion">Iniciar Sesión</a>
        <a href="{{ url('/register') }}" class="btn btn-primary registro">Registrarse</a>
    </div>
    <div class="queEsContainer">
        <h1>QUE ES EASY HELP??? </h1>
        <p>
            En EasyHelp, nos dedicamos a empoderar a las personas para que dediquen su tiempo a repartir comida y marcar la diferencia en la vida de quienes más lo necesitan.
            Visualizamos un mundo donde la solidaridad sea una parte esencial de la vida diaria, generando un ciclo de ayuda mutua que fortalezca nuestra sociedad.
            Nuestros valores fundamentales son la solidaridad, la empatía, la innovación y la resiliencia. Creemos en el poder de estos valores para impulsar nuestro trabajo y crear un impacto positivo en la comunidad.
            ¿Por qué nosotros? En EasyHelp, ofrecemos una plataforma para que cada individuo experimente la satisfacción de hacer una diferencia real en la vida de los demás. Únete a nuestra comunidad y descubre cómo tu tiempo y esfuerzo pueden marcar una diferencia tangible en el mundo.
        </p>
    </div>
    <div class="estadisticasContainer">
        <h1>AHORA MISMO CONTAMOS CON:</h1>
        <div class="statistics">
            <div class="statistic">
                <h2>Riders</h2>
                <p>Aquí irá un número aleatorio</p>
            </div>
            <div class="statistic">
                <h2>Proveedores</h2>
                <p>Aquí irá un número aleatorio</p>
            </div>
            <div class="statistic">
                <h2>Usuarios Totales</h2>
                <p>Aquí irá un número aleatorio</p>
            </div>
        </div>
    </div>

    <div id="carouselExampleIndicators" class="carousel slide">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="{{ asset('img/imagen1.jpg') }}" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="{{ asset('img/imagen2.jpg') }}" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="{{ asset('img/imagen3.jpg') }}" class="d-block w-100" alt="...">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    {{-- <div class="slideshow-container">
        <div class="mySlides fade">
          <div class="numbertext">1 / 3</div>
          <img src="{{ asset('img/imagen1.jpg') }}" style="width:100%">
        </div>
        <div class="mySlides fade">
          <div class="numbertext">2 / 3</div>
          <img src="{{ asset('img/imagen2.jpg') }}" style="width:100%">
        </div>
        <div class="mySlides fade">
          <div class="numbertext">3 / 3</div>
          <img src="{{ asset('img/imagen3.jpg') }}" style="width:100%">
        </div>
      
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
      </div>
      <br>
      
      <div style="text-align:center">
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
      </div> --}}

    <footer class="bg-primary text-white text-center p-3">
        <p>EasyHelp - 2024</p>
    </footer>
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}

</body>
@vite(['resources/js/app.js'])

</html>