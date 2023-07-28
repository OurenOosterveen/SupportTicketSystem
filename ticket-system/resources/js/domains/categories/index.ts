import {Category} from './types';
import {createOverviewRoute, createShowRoute} from 'services/router/factory';
import {setTranslation} from 'services/translation';
import {storeModuleFactory} from 'services/store';
import OverviewPage from './pages/Overview.vue';
import ShowPage from './pages/Show.vue'


export const CATEGORY_DOMAIN_NAME = 'categories'

setTranslation(CATEGORY_DOMAIN_NAME, {
    singular: 'category',
    plural: 'categories',
});

export const categoryStore = storeModuleFactory<Category>(CATEGORY_DOMAIN_NAME);

export const categoryRoutes = [
    createOverviewRoute(CATEGORY_DOMAIN_NAME, OverviewPage),
    createShowRoute(CATEGORY_DOMAIN_NAME, ShowPage),
];