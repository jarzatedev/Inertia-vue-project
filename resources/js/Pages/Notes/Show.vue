<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3'

defineProps({
    note: Object,
});
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Notes module - detail
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="pl-10 py-4 text-white">
                        <h3>{{ note.excerpt }}</h3>
                        <p class="mt-2">{{ note.content }}</p>
                        <hr class="my-6">
                        <Link :href="route('notes.index')">
                            Back
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
