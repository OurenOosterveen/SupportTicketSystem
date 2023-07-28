import {authRoutes} from 'domains/auth';
import {categoryRoutes} from 'domains/categories';
import {projectRoutes} from 'domains/tickets';


export const routes = [
    ...authRoutes,
    ...projectRoutes,
    ...categoryRoutes,
];