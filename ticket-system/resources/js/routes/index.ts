import {authRoutes} from 'domains/auth';
import {projectRoutes} from 'domains/tickets';


export const routes = [
    ...authRoutes,
    ...projectRoutes,
];