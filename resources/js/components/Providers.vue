<template>
    <div class="row row-cols-5" ref="cardContainer" @mousedown="startDragging($event)">
        <div v-for="(provider, index) in providers" :key="index" class=" providers">
            <div class="card h-100">
                <div class="card-header" :style="{ 'background-image': 'url(' + provider.img + ')' }"></div>
                <div class="card-body">
                    <div class="provider-name">
                        <h5 class="name">{{ provider.name }}</h5>
                        <h5>-</h5>
                        <h5 class="street">{{ provider.street }}</h5>
                        <div class="menus-left">
                            <h5>{{ provider.menus }} menús</h5>
                        </div>
                    </div>
                    <div class="get-menus">
                        <button class="btn btn-primary increment" @click="increment(index)"><i class="bi bi-plus"></i></button>
                        <h5>0</h5>
                        <button class="btn btn-primary decrement" @click="decrement(index)"><i class="bi bi-dash"></i></button>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary">Reservar</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            providers: [],
            menus: [],
            isDragging: false,
            startX: 0,
            currentX: 0,
            translateX: 0
        };
    },
    methods: {
        selectProviders() {
            axios
                .get('provider')
                .then(response => {
                    this.providers = response.data;
                })
                .catch(error => {
                    console.error('Error fetching providers:', error);
                });
        },
        increment(index) {
            this.providers[index].menus++;
        },
        decrement(index) {
            if (this.providers[index].menus > 0) {
                this.providers[index].menus--;
            }
        },
        startDragging(event) {
            this.isDragging = true;
            this.startX = event.clientX;
            document.addEventListener('mousemove', this.drag);
            document.addEventListener('mouseup', this.stopDragging);
        },
        drag(event) {
            if (this.isDragging) {
                this.currentX = event.clientX;
                const deltaX = this.currentX - this.startX;
                this.translateX += deltaX;
                this.$refs.cardContainer.style.transform = `translateX(${this.translateX}px)`;
                this.startX = this.currentX;
            }
        },
        stopDragging() {
            this.isDragging = false;
            document.removeEventListener('mousemove', this.drag);
            document.removeEventListener('mouseup', this.stopDragging);
        },
        checkBoundary() {
        const cards = this.$refs.cardContainer.querySelectorAll('.providers');
        const firstCardLeft = cards[0].getBoundingClientRect().left;
        const lastCardRight = cards[cards.length - 1].getBoundingClientRect().right;

        // Verificar si la primera tarjeta está fuera de la pantalla hacia la derecha
        if (firstCardLeft > window.innerWidth) {
            const lastCard = cards[cards.length - 1];
            const clone = lastCard.cloneNode(true); // Clonar la última tarjeta
            this.$refs.cardContainer.removeChild(lastCard); // Eliminar la última tarjeta original
            this.$refs.cardContainer.insertBefore(clone, cards[0]); // Insertar el clon al principio
        }
    // Verificar si la última tarjeta está fuera de la pantalla hacia la izquierda
        else if (lastCardRight < 0) {
            const firstCard = cards[0];
            const clone = firstCard.cloneNode(true); // Clonar la primera tarjeta
            this.$refs.cardContainer.removeChild(firstCard); // Eliminar la primera tarjeta original
            this.$refs.cardContainer.appendChild(clone); // Insertar el clon al final
        }
    },
        loop() {
            // Aquí puedes agregar lógica para comprobar los límites continuamente
        }
    },
    mounted() {
        this.selectProviders();
        this.checkBoundary();
        // this.loop(); // No se necesita para el arrastre de tarjetas
    }
}
</script>

<style scoped>
h5 {
    margin: 0;
    padding: 0;
}

.providers {
    display: flex;
    justify-content: center;
    align-items: center;
    cursor:grab;
}

.card {
    width: 450px;
    user-select: none;
}

.card-header {
    height: 200px;
    background-repeat: no-repeat;
    background-size: cover;
}

.card-body {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.provider-name {
    display: flex;
    gap: 5px;
    text-align: right;
}

.menus-left {
    background-color: #FB8500;
    border-radius: 50px;
    width: 100px;
    height: 35px;
    display: flex;
    justify-content: center;
    margin-left: auto;
    align-items: center;
}

.get-menus {
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    gap: 15px;
}

.card-footer {
    display: flex;
    justify-content: right;
}

.increment, .decrement {
    border-radius: 50px;
    width: 50px;
}

</style>
