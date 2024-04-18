<template>
    <div>
        <div class="card" style="width: 18rem;">
            <div class="card-header">
                <img src="..." class="card-img-top" alt="...">
            </div>
            <div class="card-body">
                <div class="seccion">
                    <button class="btn btn-primary increment" @click="increment(index)"><i class="bi bi-plus"></i></button>
                    <h5>0</h5>
                    <button class="btn btn-primary decrement" @click="decrement(index)"><i class="bi bi-dash"></i></button>
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