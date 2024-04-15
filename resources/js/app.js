
import "./bootstrap";


import { createApp } from "vue";
import users from "./components/Users.vue";
import maps from "./components/Maps.vue";
import register from "./components/Registro.vue";

createApp(users).mount("#users");
createApp(maps).mount("#map");
createApp(register).mount("#register");
