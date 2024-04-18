<template>
    <div>
        <div class="card">
            <div class="card-header">
                <img src="..." class="card-img-top" alt="logo">
            </div>
            <div class="card-body">
                <div class="seccion">
                    <h1>Contador: {{ counter }}</h1>
                    <button @click="incrementCounter">Incrementar</button>
                    <button @click="decrementCounter">Decrementar</button>
                </div>
            </div>
        </div>
        <div></div>
    </div>
</template>
<script>
export default {
    data() {
        return {};
    },
    methods: {

    },
    mounted() {

    }
}
</script>
<style scoped>
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

.seccion {
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    gap: 15px;
}
</style>