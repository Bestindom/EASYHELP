@extends('layouts.principal')

@section('title', 'Landing')

@section('contenido')
    <div class="registroUsuario" id="contenedor1">
        <div class="container-fluid show">
            <div class="landing-text">
                <h3>Ayudemos Facil y rapido</h3>
                <p>Con EasyHelp podrás encontrar la mejor solución a tus problemas de forma rápida y sencilla</p>
            </div>
            <div class="landing-buttons">
                <a href="{{ url('/login') }}" class="btn btn-primary landing-button">Iniciar Sesión</a>
                <a href="{{ url('/registro') }}" class="btn btn-primary landing-button">Registrarse</a>
            </div>
        </div>
    </div>

    <div class="mision-container" id="contenedor2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-7 mision">
                    <div class="mision-text">
                        <h5>En EasyHelp, nos dedicamos a empoderar a las personas para que dediquen su tiempo a repartir
                            comida y
                            marcar
                            la
                            diferencia en la vida de quienes más lo necesitan.</h5><br>
                    </div>
                </div>
                <div class="col-5 mision">
                    <div class="mision-image">
                        <img src="{{ asset('img/foto-mision.jpeg') }}">
                    </div>
                </div>
            </div>
        </div>

        <div class="vision-container" id="contenedor3">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-5 vision">
                        <div class="vision-image">
                            <img src="{{ asset('img/foto-vision.jpeg') }}" >
                        </div>
                    </div>
                    <div class="col-7 vision">
                        <div class="vision-text">
                            <h5>Visualizamos un mundo donde la solidaridad sea una parte esencial de la vida diaria, generando un ciclo de ayuda
                                mutua que fortalezca nuestra sociedad.</h5><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="valores-container" id="contenedor4">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-7 valores">
                        <div class="valores-text">
                            <h5>Nuestros valores fundamentales son la solidaridad, la empatía, la innovación y la resiliencia. Creemos
                                en el
                                poder de estos valores para impulsar nuestro trabajo y crear un impacto positivo en la comunidad.
                                </h5>
                            {{-- <h5>¿Por qué nosotros? En EasyHelp, ofrecemos una plataforma para que cada individuo experimente la
                                satisfacción
                                de
                                hacer una diferencia real en la vida de los demás.Únete a nuestra comunidad y descubre cómo tu tiempo y
                                esfuerzo pueden marcar una diferencia tangible en el mundo.</h5> --}}
                        </div>
                    </div>
                    <div class="col-5 valores">
                        <div class="valores-image">
                            <img src="{{ asset('img/foto-vision.jpeg') }}">
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="estadisticasContainer" id="contenedor5">
            <div class="container-fluid">
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
                        <h2>Usuarios</h2>
                        <p>Aquí irá un número aleatorio</p>
                    </div>
                </div>
            </div>
            <div id="ticker-container">
                <div id="ticker">
                    <div class="ticker-content">
                        <span><img src="{{ asset('img/foto-vision.jpeg') }}" alt="Domino's" class="marcaImg"></span>
                        <span><img src="{{ asset('img/foto-vision.jpeg') }}" alt="Domino's" class="marcaImg"></span>
                        <span><img src="{{ asset('img/foto-vision.jpeg') }}" alt="Domino's" class="marcaImg"></span>
                        <span><img src="{{ asset('img/foto-vision.jpeg') }}" alt="Domino's" class="marcaImg"></span>
                        <span><img src="{{ asset('img/foto-vision.jpeg') }}" alt="Domino's" class="marcaImg"></span>
                        <span><img src="{{ asset('img/foto-vision.jpeg') }}" alt="Domino's" class="marcaImg"></span>
                        <span><img src="{{ asset('img/foto-vision.jpeg') }}" alt="Domino's" class="marcaImg"></span>
                        <span><img src="{{ asset('img/foto-vision.jpeg') }}" alt="Domino's" class="marcaImg"></span>
                        <span><img src="{{ asset('img/foto-vision.jpeg') }}" alt="Domino's" class="marcaImg"></span>
                        <span><img src="{{ asset('img/foto-vision.jpeg') }}" alt="Domino's" class="marcaImg"></span>
                        <span><img src="{{ asset('img/foto-vision.jpeg') }}" alt="Domino's" class="marcaImg"></span>
                        <span><img src="{{ asset('img/foto-vision.jpeg') }}" alt="Domino's" class="marcaImg"></span>
                        <span><img src="{{ asset('img/foto-vision.jpeg') }}" alt="Domino's" class="marcaImg"></span>
                        <span><img src="{{ asset('img/foto-vision.jpeg') }}" alt="Domino's" class="marcaImg"></span>
                        <span><img src="{{ asset('img/foto-vision.jpeg') }}" alt="Domino's" class="marcaImg"></span>
                        <!-- Agrega más marcas según sea necesario -->
                    </div>
                </div>
            </div>
            
        </div>
        
        <div class="carousel" id="contenedor6">
          <div class="container-fluid">
            <div class="containers contenedor7">
                <input type="radio" name="slider" id="item-1" checked>
                <input type="radio" name="slider" id="item-2">
                <input type="radio" name="slider" id="item-3">
                <input type="radio" name="slider" id="item-4">
                <input type="radio" name="slider" id="item-5">
                <input type="radio" name="slider" id="item-6">
                <input type="radio" name="slider" id="item-7">
                <div class="cards">
                    <label class="card" for="item-1" id="song-1">
                        <img src="img/imagen1.jpg" alt="song">
                    </label>
                    <label class="card" for="item-2" id="song-2">
                        <img src="img/imagen2.jpg" alt="song">
                    </label>
                    <label class="card" for="item-3" id="song-3">
                        <img src="img/imagen3.jpg" alt="song">
                    </label>
                </div>
            </div>
          </div>
      </div>
    @endsection
