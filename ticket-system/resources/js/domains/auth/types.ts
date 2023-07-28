export interface Credentials {
    email: string;
    password: string;
}

export interface User {
    id: number;
    first_name: string;
    last_name: string;
    email: string;
    telephone_number: string;
    is_admin: boolean;
}
