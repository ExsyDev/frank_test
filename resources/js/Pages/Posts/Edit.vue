<template>
    <AppLayout title="Posts">
        <template #header>
            <div class="pt-8 pb-12">
                <div class="max-w-7xl mx-auto min-h-screen">
                    <div class="mt-8 overflow-hidden border border-gray-200 p-4 sm:rounded-lg">
                        <h2 class="font-semibold text-xl mb-4">Edit post</h2>
                        <form @submit.prevent="updatePost">
                            <input type="text" v-model="form.title" class="bg-gray-50 mb-4 border-gray-300 rounded-lg resize-none w-full">
                            <textarea v-model="form.content" class="bg-gray-50 border-gray-300 rounded-lg resize-none w-full" rows="5"></textarea>
                            <button type="submit" class="bg-gray-800 mt-3 py-2 text-white block w-[250px] rounded-md">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </template>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm, usePage } from '@inertiajs/vue3';

const form = useForm({
    title: usePage().props.post.title || null,
    content: usePage().props.post.content || null
})

const updatePost = () => {
    form.post(route('posts.update', usePage().props.post), {
        preserveScroll: true
    })
}
</script>
