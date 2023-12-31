import {Credentials, User} from './types';
import {TICKET_DOMAIN_NAME} from 'domains/tickets';
import {computed, ref} from 'vue';
import {getRequest, postRequest} from 'services/http';
import {goToOverviewPage, goToRoute, registerBeforeRouteMiddleware} from 'services/router';
import ForgotPasswordPage from './pages/ForgotPassword.vue';
import Login from './pages/Login.vue'
import ResetPassword from './pages/ResetPassword.vue'

export const authRoutes = [
    {
        path: '/',
        name: 'Login',
        component: Login,
        meta: {auth: false, canSeeWhenLoggedIn: false},
    },
    {
        path: '/wachtwoord-updaten',
        name: 'resetPassword',
        component: ResetPassword,
        meta: {auth: false, canSeeWhenLoggedIn: false},
    },
    {
        path: '/wachtwoord-vergeten',
        name: 'forgotPassword',
        component: ForgotPasswordPage,
        meta: {auth: false, canSeeWhenLoggedIn: false},
    },
];

const loggedInUser = ref<User | null>(null);

export const isLoggedIn = computed(() => loggedInUser.value !== null);
export const getLoggedInUser = computed(() => loggedInUser.value);

export const isLoggedInUserAdmin = computed(() => loggedInUser.value?.is_admin);

export const login = async (credentials: Credentials) => {
    const {data} = await postRequest('login', credentials);
    if (!data) return;
    loggedInUser.value = data.user;
};

export const logout = async () => {
    await getRequest('logout');
    loggedInUser.value = null;
    goToLoginPage();
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
        goToOverviewPage(TICKET_DOMAIN_NAME);

        return true;
    }

    return false;
});