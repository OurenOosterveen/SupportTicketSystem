import {Ticket} from './types';
import {createOverviewRoute, createShowRoute} from 'services/router/factory';
import {setTranslation} from 'services/translation';
import {storeModuleFactory} from 'services/store';
import OverviewPage from './pages/Overview.vue';
import ShowPage from './pages/Show.vue';

export const TICKET_DOMAIN_NAME = 'tickets'

setTranslation(TICKET_DOMAIN_NAME, {
    singular: 'ticket',
    plural: 'tickets',
});

export const ticketStore = storeModuleFactory<Ticket>(TICKET_DOMAIN_NAME);

export const projectRoutes = [
    createOverviewRoute(TICKET_DOMAIN_NAME, OverviewPage),
    createShowRoute(TICKET_DOMAIN_NAME, ShowPage),
];