<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
    <title>Document</title>
</head>
<body>
    <header>EASY HELP</header>
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
    <footer>asdasdajsdj</footer>

    <script>
        // JavaScript para arrastrar las cartas de izquierda a derecha
        let isDragging = false;
        let startX, currentX, translateX = 0;

        document.getElementById('cardContainer').addEventListener('mousedown', startDragging);
        document.addEventListener('mousemove', drag);
        document.addEventListener('mouseup', stopDragging);
        
        // function positionCards(){
        //     const cards = document.querySelectorAll('.card');
        //     const firstCardLeft = cards[0].getBoundingClientRect().left;
        //     if (firstCardLeft > 0 && translateX > 0){

        //         const lastCard = cards.pop()
        //         document.querySelector('card-container').
        //     }
        //     console.log(firstCardLeft)
        //     requestAnimationFrame(positionCards)
        // }
        // positionCards();
        function positionCards() {
    const cardsContainer = document.getElementById('cardContainer');
    const cards = document.querySelectorAll('.card');
    const firstCardLeft = cards[0].getBoundingClientRect().left;
    const lastCard = cards[cards.length - 1];

    if (firstCardLeft > 0 && translateX > 0) {
        cardsContainer.removeChild(lastCard);
        cardsContainer.insertBefore(lastCard, cards[0]);
        translateX -= lastCard.offsetWidth;
        cardsContainer.style.transform = `translateX(${translateX}px)`;
    }
    requestAnimationFrame(positionCards);
}
positionCards();

        function startDragging(event) {
            isDragging = true;
            startX = event.clientX;
        }

        function drag(event) {
            if (isDragging) {
                currentX = event.clientX;
                translateX += currentX - startX;
                document.getElementById('cardContainer').style.transform = `translateX(${translateX}px)`;
                startX = currentX;
            }
        }

        function stopDragging() {
            isDragging = false;
        }
    </script>
</body>
</html>
