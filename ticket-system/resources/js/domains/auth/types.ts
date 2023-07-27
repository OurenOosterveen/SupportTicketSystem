export interface Credentials {
    email: string;
    password: string;
}

export interface User {
    id: number;
    firstName: string;
    lastName: string;
    email: string;
    phonenumber: string;
    is_admin: boolean;
}
