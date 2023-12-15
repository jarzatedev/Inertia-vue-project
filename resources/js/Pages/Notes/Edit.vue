<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import {reactive} from 'vue';
import {router} from '@inertiajs/vue3';
import Swal from 'sweetalert2';

const props = defineProps({
    note: Object,
});

const form = reactive({
    excerpt: props.note.excerpt,
    content: props.note.content,
})

function submit() {
    router.put('/notes/' + props.note.id, form);
}

function destroy() {
    Swal.fire({
        title: 'Delete: ' + props.note.excerpt,
        text: 'Do you want to continue',
        icon: 'error',
        showDenyButton: true,
        confirmButtonText: "Delete",
        denyButtonText: `Cancel`
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(`/notes/${props.note.id}`);
        } else if (result.isDenied) {
            Swal.fire(`The note: ${props.note.excerpt}, are not deleted!`, "", "info");
        }
    });
}
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Notes module - edit
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="pl-10 py-4 px-4 text-white">
                        <form @submit.prevent="submit">
                            <label class="block font-medium text-sm" for="excerpt">Excerpt:</label>
                            <textarea v-model="form.excerpt"
                                      class="form-input w-full rounded-md shadow-sm text-gray-700"
                                      id="content"></textarea>

                            <label class="block font-medium text-sm" for="content">Content:</label>
                            <textarea v-model="form.content"
                                      class="form-input w-full rounded-md shadow-sm text-gray-700"
                                      id="content" rows="8"></textarea>
                            <button type="submit">Edit</button>
                        </form>
                        <hr class="my-6">
                        <a href="#" @click.prevent="destroy">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
