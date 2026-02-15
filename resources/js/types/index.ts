export * from './auth';
export * from './navigation';
export * from './ui';

export interface Product {
    id: number;
    category_id: number | null;
    name: string;
    description: string;
    price: string;
    created_at: string;
    category?: Category;
}

export interface Category {
    id: number;
    name: string;
    slug: string;
    description: string;
    created_at: string;
}
