<template>
    <div class="row row-cols-1 row-cols-md-3 g-4 ">
        <div v-for="(provider, index) in providers" :key="index" class="col providers">
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
            menus: []
        };
    },
    methods: {
        selectProviders() {
            const me = this
            axios
                .get('provider')
                .then(response => {
                    console.log(response.data);
                    me.providers = response.data
                })
        },
        increment(index) {
            this.providers[index].menus++;
        },
        decrement(index) {
            if (this.providers[index].menus > 0) {
                this.providers[index].menus--;
            }
        }
    },
    created() {
        this.selectProviders();
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
}

.card {
    width: 450px;
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
