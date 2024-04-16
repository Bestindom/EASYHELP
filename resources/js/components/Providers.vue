<template>

    <!-- <div class="row row-cols-1 row-cols-md-3 g-4">
        <div class="col" v-for="(provider, index) in providers" :key="index">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">{{ provider.user_id }} {{ provider.name }}</h5>
                    <form>
                        <div class="form-floating row mb-3">
                            <input type="text" class="form-control" id="menu" name="menu" autofocus
                                v-model="provider.menu">
                            <label for="menu">Número de Menús</label>
                        </div>
                        <div>
                            <button id="incrementBtn">+</button>
                            <span id="counter">0</span>
                            <button id="decrementBtn">-</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> -->

    <div class="row row-cols-1 row-cols-md-3 g-4">
        <div class="col" v-for="(provider, index) in providers" :key="index">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">{{ provider.user_id }} {{ provider.name }}</h5>
                    <form>
                        <div class="form-floating row mb-3">
                            <input type="text" class="form-control" id="menu" name="menu" autofocus
                                v-model="provider.menu">
                            <label for="menu">Número de Menús</label>
                        </div>
                        <div>
                            <button @click="incrementMenu(index)">+</button>
                            <span>{{ menuCounts[index] }}</span>
                            <button @click="decrementMenu(index)">-</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</template>
<script>

import * as bootstrap from 'bootstrap'
import axios from 'axios';

export default {
    data() {
        return {
            providers: [],
            provider: {},
            myModal: {},
            types: [],
            messageError: '',
            isError: false,
            insert: false,
            menuCounts: []
        }
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
        incrementMenu(index) {
            this.menuCounts[index]++;
        },
        decrementMenu(index) {
            if (this.menuCounts[index] > 0) {
                this.menuCounts[index]--;
            }
        }
    },
    created() {
        this.selectProviders()
    },
}
</script>
<style></style>