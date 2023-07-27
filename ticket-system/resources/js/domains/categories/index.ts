import {Category} from './types';
import {setTranslation} from 'services/translation';
import {storeModuleFactory} from 'services/store';


export const CATEGORY_DOMAIN_NAME = 'categories'

setTranslation(CATEGORY_DOMAIN_NAME, {
    singular: 'category',
    plural: 'categories',
});

export const categoryStore = storeModuleFactory<Category>(CATEGORY_DOMAIN_NAME);