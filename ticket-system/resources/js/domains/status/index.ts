
import {Status} from './types';
import {setTranslation} from 'services/translation';
import {storeModuleFactory} from 'services/store';


export const STATUS_DOMAIN_NAME = 'status'

setTranslation(STATUS_DOMAIN_NAME, {
    singular: 'status',
    plural: 'status',
});

export const statusStore = storeModuleFactory<Status>(STATUS_DOMAIN_NAME);