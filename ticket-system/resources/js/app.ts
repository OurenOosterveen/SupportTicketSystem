import {addRoutes, useRouterInApp} from './services/router';
import {createApp} from 'vue';
import {routes} from './routes';
import App from './App.vue';

const app = createApp(App);

addRoutes(routes);

useRouterInApp(app);
app.mount('#app');
