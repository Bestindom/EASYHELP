
import "./bootstrap";


import { createApp } from "vue";
import users from "./components/Users.vue";
import maps from "./components/Maps.vue";
import providers from "./components/Providers.vue";
import register from "./components/Registro.vue";
// import proveedor from "./components/ProvedoresMomentaneo.vue"

createApp(users).mount("#users");
createApp(maps).mount("#map");
createApp(providers).mount("#providers");
createApp(register).mount("#register");
// createApp(proveedor).mount("#proveedor");
