
import {Status} from './types';
import {setTranslation} from 'services/translation';
import {storeModuleFactory} from 'services/store';


export const STATUS_DOMAIN_NAME = 'statuses'

setTranslation(STATUS_DOMAIN_NAME, {
    singular: 'status',
    plural: 'statuses',
});

export const statusStore = storeModuleFactory<Status>(STATUS_DOMAIN_NAME);