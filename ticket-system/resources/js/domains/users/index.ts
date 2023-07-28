import {User} from 'domains/auth/types';
import {setTranslation} from 'services/translation';
import {storeModuleFactory} from 'services/store';


export const USER_DOMAIN_NAME = 'users'

setTranslation(USER_DOMAIN_NAME, {
    singular: 'user',
    plural: 'users',
});

export const userStore = storeModuleFactory<User>(USER_DOMAIN_NAME);