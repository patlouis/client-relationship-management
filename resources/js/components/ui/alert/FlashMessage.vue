<script setup lang="ts">
import { usePage } from '@inertiajs/vue3';
import { computed, ref, watch, onMounted } from 'vue';

const page = usePage();
const flash = computed(() => (page.props.flash || {}) as { success?: string; error?: string });
const show = ref(false);

const handleFlash = () => {
    if (flash.value.success || flash.value.error) {
        show.value = true;
        setTimeout(() => (show.value = false), 5000);
    }
};

watch(() => page.props.flash, handleFlash, { deep: true });

onMounted(handleFlash);
</script>

<template>
    <Teleport to="body">
        <Transition
            enter-active-class="transform ease-out duration-300 transition"
            enter-from-class="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-4"
            enter-to-class="translate-y-0 opacity-100 sm:translate-x-0"
            leave-active-class="transition ease-in duration-200"
            leave-from-class="opacity-100"
            leave-to-class="opacity-0"
        >
            <div v-if="show && (flash.success || flash.error)" 
                 class="fixed top-5 right-5 z-[100] w-full max-w-sm pointer-events-auto"
            >
                <div :class="[
                    'flex items-start gap-4 rounded-xl p-4 shadow-md border backdrop-blur-md',
                    flash.success 
                        ? 'bg-white/90 border-emerald-100 dark:bg-zinc-900/90 dark:border-emerald-900/50' 
                        : 'bg-white/90 border-red-100 dark:bg-zinc-900/90 dark:border-red-900/50'
                ]">
                    <div :class="[
                        'mt-0.5 rounded-full p-1',
                        flash.success ? 'text-emerald-600 bg-emerald-50 dark:bg-emerald-500/10' : 'text-red-600 bg-red-50 dark:bg-red-500/10'
                    ]">
                        <svg v-if="flash.success" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                        <svg v-else xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                    </div>

                    <div class="flex-1">
                        <p class="text-sm font-semibold text-zinc-900 dark:text-zinc-100">
                            {{ flash.success ? 'Success' : 'Error' }}
                        </p>
                        <p class="mt-1 text-xs text-zinc-600 dark:text-zinc-400 leading-relaxed">
                            {{ flash.success || flash.error }}
                        </p>
                    </div>

                    <button @click="show = false" class="text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-200 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>
            </div>
        </Transition>
    </Teleport>
</template>
