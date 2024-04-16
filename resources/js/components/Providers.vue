<template>
    <div>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div v-for="(item, index) in items" :key="index" class="col">   
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ item.title }}</h5>
                        <p class="card-text">{{ item.menuCount }} menús</p>
                        <button @click="increment(index)">+</button>
                        <button @click="decrement(index)">-</button>
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
            items: [
                { title: 'Jiajie', menuCount: 0 },
                { title: 'Pizza', menuCount: 0 }
            ]
        };
    },
    methods: {
        increment(index) {
            this.items[index].menuCount++;
        },
        decrement(index) {
            if (this.items[index].menuCount > 0) {
                this.items[index].menuCount--;
            }
        }
    }
}
</script>

<style></style>
