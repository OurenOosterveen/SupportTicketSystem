import { checkIfLoggedIn } from "./auth";
import { createApp } from "vue";
import { addRoutes, useRouterInApp } from "./services/router";
import App from "./App.vue";
import { routes } from "./routes";

const app = createApp(App);

addRoutes(routes);
console.log(routes);

    useRouterInApp(app);
    app.mount('#app');
