import "./bootstrap";

import { createApp } from "vue";
import users from "./components/Users.vue";
import maps from "./components/Maps.vue";

createApp(users).mount("#users");
createApp(maps).mount("#maps");
