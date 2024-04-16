<template>
    <div>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div v-for="(provider, index) in providers" :key="index" class="col">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ provider.user_id + '. ' + provider.name }}</h5>
                        <p class="card-text">{{ provider.menus }} menús</p>
                        <button @click="increment(index)">+</button>
                        <button @click="decrement(index)">-</button><br>
                        <h5 class="card-title">{{ provider.street }}</h5>
                    </div>
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

<style></style>
