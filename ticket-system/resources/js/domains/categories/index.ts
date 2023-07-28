import {Category} from './types';
import {createOverviewRoute} from 'services/router/factory';
import {setTranslation} from 'services/translation';
import {storeModuleFactory} from 'services/store';
import OverviewPage from './pages/Overview.vue';


export const CATEGORY_DOMAIN_NAME = 'categories'

setTranslation(CATEGORY_DOMAIN_NAME, {
    singular: 'category',
    plural: 'categories',
});

export const categoryStore = storeModuleFactory<Category>(CATEGORY_DOMAIN_NAME);

export const categoryRoutes = [
    createOverviewRoute(CATEGORY_DOMAIN_NAME, OverviewPage),
];