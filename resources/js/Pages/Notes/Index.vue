<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3'
import {ref, watch} from "vue";
import { router } from '@inertiajs/vue3';

const props = defineProps({
    notes: Array,
    queryParams: Object,
});

const q = ref(props?.queryParams?.q ?? '');

watch(q, (value) => {
    router.replace( route( 'notes.index', { q: value } ), { preserveState: true } );
});
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Notes module
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="pl-10 pr-4 mt-4 text-white">
                        <div class="flex justify-between">
                            <input v-model="q" type="search" autocomplete="off" class="form-input rounded-lg w-full text-gray-950" placeholder="Search">
                            <Link :href="route('notes.create')" class="ml-2">Create</Link>
                        </div>
                        <table>
                            <tr>
                                <th>Excerpt</th>
                                <th></th>
                            </tr>
                            <tr v-for="note in notes">
                                <td>
                                    {{ note.excerpt }}
                                </td>
                                <td>
                                    <Link :href="route('notes.show', note.id)">show</Link>
                                </td>
                                <td>
                                    <Link :href="route('notes.edit', note.id)">edit</Link>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
