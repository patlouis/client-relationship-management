<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import Label from '@/components/ui/label/Label.vue';
import Input from '@/components/ui/input/Input.vue';
import Button from '@/components/ui/button/Button.vue';
import InputError from '@/components/InputError.vue';
import { route } from 'ziggy-js';

interface Product {
    id: number;
    name: string;
    price: string;
    description: string;
}

const props = defineProps<{
    product: Product;
}>();

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Products', href: route('products.index') },
    { title: 'Edit Product', href: route('products.edit', props.product.id) },
];

const form = useForm({
    name: props.product.name,
    price: props.product.price,
    description: props.product.description,
});

const submit = () => {
    form.put(route('products.update', props.product.id));
};
</script>

<template>
    <Head title="Edit Product" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="py-12">
            <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-zinc-900 overflow-hidden shadow-sm sm:rounded-xl border border-zinc-200 dark:border-zinc-800">
                    <div class="p-6">
                        <header class="mb-6">
                            <h2 class="text-lg font-medium text-zinc-900 dark:text-zinc-100">Edit Product</h2>
                            <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-400">
                                Update the product details below.
                            </p>
                        </header>

                        <form @submit.prevent="submit" class="space-y-6">
                            <div>
                                <Label for="name">Product Name</Label>
                                <Input
                                    id="name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.name"
                                    placeholder="e.g. Wireless Headphones"
                                />
                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>

                            <div>
                                <Label for="price">Price</Label>
                                <div class="relative mt-1">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-zinc-500">$</span>
                                    <Input
                                        id="price"
                                        type="number"
                                        step="0.01"
                                        class="block w-full pl-7"
                                        v-model="form.price"
                                        required
                                        placeholder="0.00"
                                    />
                                </div>
                                <InputError class="mt-2" :message="form.errors.price" />
                            </div>

                            <div>
                                <Label for="description">Description</Label>
                                <textarea
                                    id="description"
                                    rows="4"
                                    class="flex min-h-[80px] w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 mt-1 dark:bg-zinc-950 dark:border-zinc-800"
                                    v-model="form.description"
                                    placeholder="Tell us more about this product..."
                                ></textarea>
                                <InputError class="mt-2" :message="form.errors.description" />
                            </div>

                            <div class="flex items-center justify-end gap-4 pt-4 border-t border-zinc-100 dark:border-zinc-800">
                                <Button
                                    variant="outline"
                                    type="button"
                                    @click="$inertia.visit(route('products.index'))"
                                >
                                    Cancel
                                </Button>
                                
                                <Button 
                                    type="submit" 
                                    :disabled="form.processing"
                                    :class="{ 'opacity-25': form.processing }"
                                    class="cursor-pointer"
                                >
                                    <template v-if="form.processing">Saving...</template>
                                    <template v-else>Update Product</template>
                                </Button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
