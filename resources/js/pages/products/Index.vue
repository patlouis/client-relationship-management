<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'; 
import AppLayout from '@/layouts/AppLayout.vue';
import Button from '@/components/ui/button/Button.vue';
import { type BreadcrumbItem } from '@/types';
import { route } from 'ziggy-js';

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Products', href: route('products.index') },
];
</script>

<template>
    <Head title="Products" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex items-center justify-between py-4">
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-zinc-900 dark:text-zinc-100">Product List</h1>
                <p class="text-sm text-zinc-500">Manage and view your inventory.</p>
            </div>
            
            <Link :href="route('products.create')">
                <Button class="gap-2">
                    <span class="i-lucide-plus h-4 w-4" />
                    Create Product
                </Button>
            </Link>
        </div>

        </AppLayout>
</template>
