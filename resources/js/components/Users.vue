<template>
    <div class="container-fluid user-table">
        <div class="card mt-5 mb-1 user-table-card">
            <div class="card-header bg-secondary fs-4 fw-bold text-white">
                Usuaris
                <button class="btn btn-primary float-end" @click="showForm()" id="add-user">
                    <i class="bi bi-plus-circle"></i> Nou Usuari
                </button>
            </div>
            <div class="card-body">
                <table class="table mt-2">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nom Usuari</th>
                            <!-- <th scope="col">Password</th> -->
                            <th scope="col">Tipus Usuari</th>
                            <th>Acció</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="user in users">
                            <td>{{ user.id }}</td>
                            <td>{{ user.username }}</td>
                            <!-- <td>{{ user.password }}</td> -->
                            <td class="user-type">
                                <p v-if="user.type.name == 'admin'" style="background-color: #219ebc;">
                                    {{ user.type.name }}
                                </p>

                                <p v-else-if="user.type.name == 'rider'" style="background-color: #ffb703;">
                                    {{ user.type.name }}
                                </p>

                                <p v-else-if="user.type.name == 'provider'" style="background-color: #fb8500;">
                                    {{ user.type.name }}
                                </p>
                            </td>
                            <td class="actions">
                                <!-- <div class="d-grid gap-2 d-md-flex justify-content-md-end"> -->
                                <!-- <button type="submit" class="btn btn-sm btn-primary" @click="selectType(user)">
                                    <i class="bi bi-person-fill"></i> Select Type
                                </button> -->
                                <button type="submit" class="btn btn-sm btn-secondary me-2" @click="editUser(user)">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button type="submit" class="btn btn-sm btn-danger" @click="confirmDelete(user)">
                                    <i class="bi bi-trash"></i>
                                </button>
                                <!-- </div> -->
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
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
        <div class="modal-dialog modal-dialog-centered">
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
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 v-if="insert" class="modal-title">Afegeix Un Usuari</h5>
                    <h5 v-else class="modal-title">Modifica Un Usuari</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-floating row mb-3">
                            <input type="text" class="form-control" id="username" name="username" autofocus
                                v-model="user.username">
                            <label for="username">Nom d'Usuari</label>
                        </div>
                        <div class="form-floating row mb-3">
                            <input type="password" class="form-control" id="password" name="password"
                                v-model="user.password">
                            <label for="password">Contrasenya</label>
                        </div>
                        <div class="choose-user">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="type" id="type1" v-model="user.type"
                                    value="2" hidden>
                                <label class="form-check-label rider-label" for="type1">
                                    <!-- <p>Rider</p> -->
                                    <img src="/public/img/repartidor.png">
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="type" id="type2" v-model="user.type"
                                    value="3" hidden>
                                <label class="form-check-label provider-label" for="type2">
                                    <img src="/public/img/provider.svg">
                                </label>
                            </div>
                        </div>
                    </form>
                    <span v-if="isError" class="badge text-bg-danger">{{ messageError }}</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-button" data-bs-dismiss="modal">Tanca</button>
                    <button v-if="insert" type="button" class="btn btn-primary insert-user" @click="insertUser()">
                        <i class="bi bi-plus-circle"></i> Afegir
                    </button>
                    <button v-else type="button" class="btn btn-primary update-user" @click="updateUser()">
                        <i class="bi bi-pencil-square"></i> Modificar
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
            rider: false
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
        updateUser() {
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
<style scoped>

.form-check-input:checked + .provider-label img {
    box-shadow: 0 0 15px 0 #fb8500;
}

.form-check-input:checked + .rider-label img {
    box-shadow: 0 0 15px 0 #ffb703;
}

p {
    margin: 0;
}

.user-table {
    display: flex;
    justify-content: center;
    align-items: center;
}

.user-table-card {
    width: 70%;
    margin-top: 100px !important;
    border-radius: 0px;
}

.card-header,
.modal-header {
    border-radius: 0px;
    background-color: #219EBC !important;
}

tr {
    text-align: center;
}

#add-user,
.insert-user,
.update-user {
    background-color: #035177;
    border-color: #035177;
}

.close-button {
    background-color: #fb8500;
    border-color: #fb8500;
}

.user-type {
    width: 110px;
}

.user-type p {
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50px;
    height: 25px;
}

.modal-content {
    border-radius: 0px;
}

.choose-user {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 30px;
    margin-top: 60px;
}
</style>