@extends('layouts.principal')

@section('contenido')
    <div class="container-fluid registroUsuario" id="contenedor1">
        <h3>Ayudemos Facil y rapido</h3>
        <p>Con EasyHelp podrás encontrar la mejor solución a tus problemas de forma rápida y sencilla</p>
        <a href="{{ url('/login') }}" class="btn btn-primary inicioSesion">Iniciar Sesión</a>
        <a href="{{ url('/register') }}" class="btn btn-primary registro">Registrarse</a>
    </div>
    <div class="queEsContainer" id="contenedor2">
        <h1>QUE ES EASY HELP??? </h1>
        <p>
            En EasyHelp, nos dedicamos a empoderar a las personas para que dediquen su tiempo a repartir comida y marcar la
            diferencia en la vida de quienes más lo necesitan.
            Visualizamos un mundo donde la solidaridad sea una parte esencial de la vida diaria, generando un ciclo de ayuda
            mutua que fortalezca nuestra sociedad.
            Nuestros valores fundamentales son la solidaridad, la empatía, la innovación y la resiliencia. Creemos en el
            poder de estos valores para impulsar nuestro trabajo y crear un impacto positivo en la comunidad.
            ¿Por qué nosotros? En EasyHelp, ofrecemos una plataforma para que cada individuo experimente la satisfacción de
            hacer una diferencia real en la vida de los demás. Únete a nuestra comunidad y descubre cómo tu tiempo y
            esfuerzo pueden marcar una diferencia tangible en el mundo.
        </p>
    </div>
    <div class="container-fluid estadisticasContainer" id="contenedor3">
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

    <div class="container-fluid carousel-slide" id="contenedor4">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#contenedor4" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#contenedor4" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#contenedor4" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
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
        <button class="carousel-control-prev" type="button" data-bs-target="#contenedor4"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#contenedor4"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
@endsection
