
export interface User {
    id: number
    is_active: boolean
    name: string
    email: string
    created_at: string
    updated_at: string
}

export interface Params {
    is_active?: number | null;
    created_at?: number | null;
    updated_at?: number | null;
}
