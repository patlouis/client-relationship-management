<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'; 
import AppLayout from '@/layouts/AppLayout.vue';
import Button from '@/components/ui/button/Button.vue';
import { type BreadcrumbItem } from '@/types';
import { route } from 'ziggy-js';

interface Product {
    id: number;
    name: string;
    description: string;
    price: string;
    created_at: string;
}

interface Props {
    products: {
        data: Product[];
        links: any[];
    };
    breadcrumbs?: BreadcrumbItem[];
}

const props = defineProps<Props>();

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Products', href: route('products.index') },
];
</script>

<template>
    <Head title="Products" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="space-y-2 p-6">
            <div class="flex items-center justify-between py-4">
                <div>
                    <h1 class="text-2xl font-bold tracking-tight text-zinc-900 dark:text-zinc-100">Product List</h1>
                    <p class="text-sm text-zinc-500">Manage and view your inventory.</p>
                </div>
                
                <Link :href="route('products.create')">
                    <Button class="gap-2 cursor-pointer">
                        <span class="text-lg">+</span> 
                        Create Product
                    </Button>
                </Link>
            </div>

            <div class="border rounded-lg border-zinc-200 dark:border-zinc-800 overflow-hidden">
                <table class="w-full text-sm text-left">
                    <thead class="bg-zinc-50 dark:bg-zinc-900 text-zinc-500 border-b border-zinc-200 dark:border-zinc-800">
                        <tr>
                            <th class="px-4 py-3 font-medium">Name</th>
                            <th class="px-4 py-3 font-medium">Unit Price</th>
                            <th class="px-4 py-3 font-medium">Description</th>
                            <th class="px-4 py-3 font-medium text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-200 dark:divide-zinc-800 bg-white dark:bg-zinc-950">
                        <tr v-for="product in props.products.data" :key="product.id" class="hover:bg-zinc-50 dark:hover:bg-zinc-900/50 transition-colors">
                            <td class="px-4 py-3 font-medium text-zinc-900 dark:text-zinc-100">
                                {{ product.name }}
                            </td>
                            <td class="px-4 py-3 text-zinc-600 dark:text-zinc-400">
                                ${{ product.price }}
                            </td>
                            <td class="px-4 py-3 text-zinc-500 dark:text-zinc-500 truncate max-w-xs">
                                {{ product.description || '-' }}
                            </td>
                            <td class="px-4 py-3 text-right">
                                <Link :href="route('products.edit', product.id)" class="text-zinc-500 hover:text-indigo-600 text-xs font-medium underline">
                                    Edit
                                </Link>
                            </td>
                        </tr>

                        <tr v-if="props.products.data.length === 0">
                            <td colspan="4" class="px-4 py-8 text-center text-zinc-500">
                                No products found. Click "Create Product" to add one.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div v-if="props.products.data.length > 0" class="flex justify-end gap-2">
                <Link 
                    v-for="link in props.products.links" 
                    :key="link.label"
                    :href="link.url ?? '#'"
                    :class="[
                        'px-3 py-1 text-xs rounded border',
                        link.active 
                            ? 'bg-zinc-900 text-white border-zinc-900 dark:bg-zinc-100 dark:text-zinc-900' 
                            : 'bg-white text-zinc-600 border-zinc-200 hover:bg-zinc-50 dark:bg-zinc-950 dark:border-zinc-800 dark:text-zinc-400',
                        !link.url && 'opacity-50 cursor-not-allowed'
                    ]"
                    v-html="link.label" 
                />
            </div>
        </div>
    </AppLayout>
</template>
