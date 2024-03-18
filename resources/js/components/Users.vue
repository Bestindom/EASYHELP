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
                </tbody>
            </table>
        </div>
    </div>

   
</template>

<script>

import * as bootstrap from 'bootstrap'
import axios from 'axios';

export default {
}
</script>
<style>
    
</style>