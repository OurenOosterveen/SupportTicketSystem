import {Credentials, User} from './types';
import {computed, ref} from 'vue';
import {getRequest, postRequest} from '../services/http';
import {goToOverviewPage, goToRoute, registerBeforeRouteMiddleware} from '../services/router';
import {setTranslation} from '../services/translation';
import Login from './pages/Login.vue'

const TICKET_NAME = 'tickets'

setTranslation(TICKET_NAME, {
    singular: 'project',
    plural: 'projecten',
});

export const authRoutes = [
    {
        path: '/',
        name: 'Login',
        component: Login,
        meta: {auth: false, canSeeWhenLoggedIn: false},
    },
    // {
    //     path: '/wachtwoord-vergeten/:token/:email',
    //     name: 'resetPassword',
    //     component: ResetPassword,
    //     meta: {auth: false, canSeeWhenLoggedIn: false},
    // },
    // {
    //     path: '/wachtwoord-vergeten',
    //     name: 'forgotPassword',
    //     component: RequestResetPassword,
    //     meta: {auth: false, canSeeWhenLoggedIn: false},
    // },
];

const loggedInUser = ref<User | null>(null);

export const isLoggedIn = computed(() => loggedInUser.value !== null);
export const getLoggedInUser = computed(() => loggedInUser.value);

export const login = async (credentials: Credentials) => {
    const {data} = await postRequest('login', credentials);
    if (!data) return;
    loggedInUser.value = data.user;
};

export const logout = async () => {
    await getRequest('logout');
    loggedInUser.value = null;
};

export const me = async () => {
    const {data} = await getRequest('me');
    if (!data) return;
    loggedInUser.value = data;
};

export const checkIfLoggedIn = async () => {
    const {data} = await getRequest('me');
    loggedInUser.value = data.user;
};

export const goToLoginPage = () => goToRoute('Login', undefined);

registerBeforeRouteMiddleware(({meta}) => {
    if (!isLoggedIn.value && meta?.auth) {
        goToLoginPage();

        return true;
    }
    if (isLoggedIn.value && !meta?.canSeeWhenLoggedIn) {
        goToOverviewPage(TICKET_NAME);

        return true;
    }

    return false;
});