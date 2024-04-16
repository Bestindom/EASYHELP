<template>
    <div class="card mt-2 mb-1">
        <div class="card-header bg-secondary fs-4 fw-bold text-white">
            Users
            <button class="btn btn-primary float-end" @click="showForm()">
                <i class="bi bi-plus-circle"></i> New User
            </button>
        </div>
        <div class="card-body">
            <table class="table mt-2">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Username</th>
                        <th scope="col">Password</th>
                        <th scope="col">type</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in users">
                        <td>{{ user.id }}</td>
                        <td>{{ user.username }}</td>
                        <td>{{ user.password }}</td>
                        <td>{{ user.type.name }}</td>
                        <td>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <!-- <button type="submit" class="btn btn-sm btn-primary" @click="selectType(user)">
                                    <i class="bi bi-person-fill"></i> Select Type
                                </button> -->
                                <button type="submit" class="btn btn-sm btn-secondary" @click="editUser(user)">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </button>
                                <button type="submit" class="btn btn-sm btn-danger" @click="confirmDelete(user)">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Type Modal -->

    <div class="modal" tabindex="-1" id="typeModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Select your user type {{ user.username }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <button type="submit" class="btn btn-sm btn-primary" @click="insertRider()">
                        <i class="bi bi-person-fill"></i> Rider
                    </button>
                </div>
                <div class="modal-body">
                    <button type="submit" class="btn btn-sm btn-primary" @click="insertProvider()">
                        <i class="bi bi-person-fill"></i> Provider
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->

    <div class="modal" tabindex="-1" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure to delete <strong>{{ user.username }}</strong>?</p>
                    <span v-if="isError" class="badge text-bg-danger">{{ messageError }}</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" @click="deleteUser()">
                        <i class="bi bi-trash"></i> Accept
                    </button>
                </div>
            </div>
        </div>
    </div>


    <!-- Insert/Update Modal -->

    <div class="modal" tabindex="-1" id="userModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 v-if="insert" class="modal-title">User</h5>
                    <h5 v-else class="modal-title">Modify User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-floating row mb-3">
                            <input type="text" class="form-control" id="username" name="username" autofocus
                                v-model="user.username">
                            <label for="username">Username</label>
                        </div>
                        <div class="form-floating row mb-3">
                            <input type="password" class="form-control" id="password" name="password"
                                v-model="user.password">
                            <label for="password">Password</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="type" id="type1" v-model="user.type" value="2">
                            <label class="form-check-label" for="type1">
                                Rider
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="type" id="type2" v-model="user.type" value="3">
                            <label class="form-check-label" for="type2">
                                Provider
                            </label>
                        </div>
                    </form>
                    <span v-if="isError" class="badge text-bg-danger">{{ messageError }}</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button v-if="insert" type="button" class="btn btn-primary" @click="insertUser()">
                        <i class="bi bi-plus-circle"></i> Insert
                    </button>
                    <button v-else type="button" class="btn btn-primary" @click="updateUser()">
                        <i class="bi bi-pencil-square"></i> Modify
                    </button>
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
            users: [],
            user: {},
            providers: [],
            provider: {},
            myModal: {},
            types: [],
            messageError: '',
            isError: false,
            insert: false,
        }
    },
    methods: {
        showForm() {
            this.insert = true
            this.isError = false
            this.user = {}
            this.myModal = new bootstrap.Modal('#userModal')
            this.myModal.show()
        },
        editUser(user) {
            this.insert = false
            this.user = user
            this.myModal = new bootstrap.Modal('#userModal')
            this.myModal.show()
        },
        selectType(user) {
            this.isError = false
            this.user = user
            this.myModal = new bootstrap.Modal('#typeModal')
            this.myModal.show()
        },
        insertUser() {
            const me = this
            axios
                .post('user', me.user)
                .then(response => {
                    me.user.id = response.data.id; // Asigna el ID del usuario creado
                    
                    if (me.user.type == '2') {
                        me.insertRider();
                    } else {
                        me.insertProvider();
                    }
                    me.selectUsers()
                    me.myModal.hide()
                })
                .catch(error => {
                    me.isError = true
                    console.log(error)
                    me.messageError = error.response.data.error
                })
        },
        insertProvider() {
            const me = this
            axios
                .post('provider', me.user)
                .then(response => {
                    console.log('provider add')
                })
                .catch(error => {
                    me.isError = true
                    console.log(error)
                    me.messageError = error.response.data.error
                })
        },
        insertRider() {
            const me = this
            console.log('ESTE ES MI USER ID: ' + me.user.id)
            axios
                .post('rider', me.user)
                .then(response => {
                    console.log('rider add')
                })
                .catch(error => {
                    me.isError = true
                    console.log(error)
                    me.messageError = error.response.data.error
                })
        },
        updateUser() 
        {
            const me = this
            axios
                .put('user/' + me.user.id, me.user)
                .then(response => {
                    // me.insertProvider()
                    me.selectUsers()
                    me.myModal.hide()
                })
                .catch(error => {
                    me.isError = true
                    console.log(error)
                    me.messageError = error.response.data.error
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
        selectTypes() {
            const me = this
            axios
                .get('type')
                .then(response => {
                    console.log(response.data);
                    me.types = response.data
                })
        },
        confirmDelete(user) {
            this.isError = false
            this.user = user
            this.myModal = new bootstrap.Modal('#deleteModal')
            this.myModal.show()
        },
        deleteUser() {
            const me = this
            axios
                .delete('user/' + me.user.id)
                .then(response => {
                    me.selectUsers()
                    me.myModal.hide()
                })
                .catch(error => {
                    me.isError = true
                    console.log(error)
                    me.messageError = error.response.data.error
                })
        }
    },
    created() {
        this.selectUsers()
        this.selectTypes()
    },
}
</script>
<style></style>