<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/css.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-primary">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">EASYHELP</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    @if (Auth::check())
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                {{ Auth::user()->username }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ url('/logout') }}"><i
                                            class="bi bi-box-arrow-left"></i> Logout</a></li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold" href="{{ url('/login') }}"><i
                                    class="bi bi-box-arrow-in-right"></i> Login</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <h1>PROVEEDORES</h1>
    <div class="container">
        
        <div id="cardContainer">
            <!-- Aquí puedes agregar tus tarjetas -->
            <div class="card">Tarjeta 1</div>
            <div class="card">Tarjeta 2</div>
            <div class="card">Tarjeta 3</div>
            <div class="card">Tarjeta 4</div>
            <div class="card">Tarjeta 5</div>
            <div class="card">Tarjeta 6</div>
            <div class="card">Tarjeta 7</div>
            <div class="card">Tarjeta 8</div>
            <div class="card">Tarjeta 9</div>
            <div class="card">Tarjeta 10</div>
            <div class="card">Tarjeta 11</div>
            <div class="card">Tarjeta 12</div>  
        </div>
    </div>
    <div id="imageContainer">
        <a href="{{ route('map') }}">
            <img src="{{ asset('img/mapa.jpg') }}" alt="Descripción de la imagen">
        </a>
    </div>

    <script>
        let isDragging = false;
        let startX, currentX, translateX = 0;
        const cardContainer = document.getElementById('cardContainer');

        cardContainer.addEventListener('mousedown', startDragging);
        document.addEventListener('mousemove', drag);
        document.addEventListener('mouseup', stopDragging);

        function startDragging(event) {
            isDragging = true;
            startX = event.clientX;
        }

        function drag(event) {
            if (isDragging) {
                currentX = event.clientX;
                translateX += currentX - startX;
                cardContainer.style.transform = `translateX(${translateX}px)`;
                startX = currentX;
            }
        }

        function stopDragging() {
            isDragging = false;
        }

        function checkBoundary() {
            const cards = document.querySelectorAll('.card');
            const firstCardLeft = cards[0].getBoundingClientRect().left;
            const lastCardRight = cards[cards.length - 1].getBoundingClientRect().right;

            if (firstCardLeft > 0 && translateX > 0) {
                const lastCard = cards[cards.length - 1];
                cardContainer.removeChild(lastCard);
                cardContainer.insertBefore(lastCard, cards[0]);
                translateX -= lastCard.offsetWidth;
                cardContainer.style.transform = `translateX(${translateX}px)`;
            } else if (lastCardRight < window.innerWidth && translateX < 0) {
                const firstCard = cards[0];
                cardContainer.removeChild(firstCard);
                cardContainer.appendChild(firstCard);
                translateX += firstCard.offsetWidth;
                cardContainer.style.transform = `translateX(${translateX}px)`;
            }
        }

        function loop() {
            checkBoundary();
            requestAnimationFrame(loop);
        }

        loop();
    </script>
</body>
</html>
