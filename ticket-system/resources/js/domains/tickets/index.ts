import {createOverviewRoute} from 'services/router/factory';
import {setTranslation} from 'services/translation';
import OverviewPage from './pages/Overview.vue'

export const TICKET_DOMAIN_NAME = 'tickets'

setTranslation(TICKET_DOMAIN_NAME, {
    singular: 'ticket',
    plural: 'tickets',
});

export const projectRoutes = [createOverviewRoute(TICKET_DOMAIN_NAME, OverviewPage)];