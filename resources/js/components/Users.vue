<template>
    <div class="card mt-2 mb-1">
        <div class="card-header bg-secondary fs-4 fw-bold text-white">
            Users
            <button class="btn btn-primary float-end" @click="showForm()">
                <i class="bi bi-plus-circle"></i> New cicle
            </button>
        </div>
        <div class="card-body">
            <table class="table mt-2">
                <thead>
                <tr>
                    <th scope="col">Username</th>
                    <th scope="col">Name</th>
                    <th scope="col">Lastname</th>
                    <th scope="col">type</th>
                </tr>
                </thead>
                <tbody>
                    <tr v-for="user in users">
                        <td>{{ user.id }}</td>
                        <td>{{ user.username }}</td>
                        <td>{{ user.password }}</td>
                        <td>{{ user.type }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

   
</template>

<script>

import * as bootstrap from 'bootstrap'
import axios from 'axios';

export default {
    data() {
        return {
            users: [],
        }
    },
    methods: {
        selectUsers()
        {
            const me = this
            axios
                .get('/EASYHELP/public/api/user')
                .then(response => {
                    console.log(response.data);
                    me.users = response.data
                })
        },
    },
    created() {
        this.selectUsers()
    },
}
</script>
<style>
    
</style>