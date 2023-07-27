export interface Ticket {
    id: number;
    title: string;
    content: string;
    created_at: string;
    updated_at: string;
    user_id: number;
    assignee_id: number;
    status_id: number;
    category_id: number;
}