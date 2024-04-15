<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/css.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        
    </style>
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
    <div class="container" id="cardContainer">
        <!-- Aquí se añadirán dinámicamente las tarjetas -->
    </div>

    <div id="imageContainer">
        <a href="{{ route('map') }}">
            <img src="{{ asset('img/mapa.jpg') }}" alt="Descripción de la imagen">
        </a>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detalles del Restaurante</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 id="restaurantName"></h5>
                    <p id="restaurantLocation"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        
        const cardContainer = document.getElementById('cardContainer');
        const cardsData = [
            { name: "Restaurante La Terraza", location: "Calle Principal 123, Ciudad Ficticia" },
            { name: "Pizzería Don Luigi", location: "Avenida Central 456, Ciudad Ficticia" },
            { name: "Sabor Mexicano", location: "Calle de los Sabores 789, Ciudad Ficticia" },
            { name: "Café del Parque", location: "Plaza Central 101, Ciudad Ficticia" },
            { name: "Sushi Sama", location: "Avenida del Mar 222, Ciudad Ficticia" },
            { name: "Parrilla Argenta", location: "Calle de las Brasas 333, Ciudad Ficticia" },
            { name: "La Trattoria", location: "Paseo Italia 555, Ciudad Ficticia" },
            { name: "Burger Palace", location: "Boulevard Hamburguesa 777, Ciudad Ficticia" },
            { name: "Vegetariano Verde", location: "Avenida de las Ensaladas 888, Ciudad Ficticia" },
            { name: "Mariscos del Puerto", location: "Malecón del Pescador 999, Ciudad Ficticia" }
        ];

        function createCard(data) {
            const card = document.createElement('div');
            card.classList.add('card');
            card.textContent = `${data.name} - ${data.location}`;
            const modalButton = document.createElement('button');
            modalButton.textContent = 'Ver Detalles';
            modalButton.classList.add('btn', 'btn-primary', 'btn-sm');
            modalButton.addEventListener('click', function() {
                document.getElementById('restaurantName').textContent = data.name;
                document.getElementById('restaurantLocation').textContent = data.location;
                $('#exampleModal').modal('show');
            });
            card.appendChild(modalButton);
            cardContainer.appendChild(card);
        }

        // Iterar sobre los datos y crear las tarjetas
        cardsData.forEach(createCard);
        // Función para arrastrar las tarjetas lateralmente
        let isDragging = false;
        let startX, currentX, translateX = 0;
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
                translateX -= lastCard.offsetWidth + 10; // Consideramos también el margen derecho de la tarjeta
                cardContainer.style.transform = `translateX(${translateX}px)`;
            } else if (lastCardRight < window.innerWidth && translateX < 0) {
                const firstCard = cards[0];
                cardContainer.removeChild(firstCard);
                cardContainer.appendChild(firstCard);
                translateX += firstCard.offsetWidth + 10; // Consideramos también el margen derecho de la tarjeta
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
