<template>
    <div>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div v-for="(provider, index) in providers" :key="index" class="col">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ provider.user_id + '. ' + provider.name }}</h5>
                        <form>
                            <div class="form-floating row mb-3">
                                <input class="form-control" id="menus" name="menus" autofocus
                                    v-model="provider.menus">
                                <label for="username">Menús</label>
                            </div>
                        </form>
                        <button @click="increment(index)">+</button>
                        <button @click="decrement(index)">-</button><br>
                        <h5 class="card-title">{{ provider.street }}</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" @click="updateMenus(provider)">
                            <i class="bi bi-bag-check-fill"></i> Modificar
                        </button>
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
            provider: {},
            users: [],
            user: {},
            menus: [],
            messageError: ''
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
        selectUsers() {
            const me = this
            axios
                .get('user')
                .then(response => {
                    console.log(response.data);
                    me.users = response.data
                })
        },
        increment(index) {
            this.providers[index].menus++;
        },
        decrement(index) {
            if (this.providers[index].menus > 0) {
                this.providers[index].menus--;
            }
        },
        updateMenus(provider) 
        {
            const me = this
            axios
                .put('provider/' + provider.user_id, provider)
                .then(response => {
                    me.selectProviders()
                })
                .catch(error => {
                    console.log(error)
                    me.messageError = error.response.data.error
                })
        },
    },
    created() {
        this.selectProviders();
        this.selectUsers();
    }
}
</script>

<style></style>
