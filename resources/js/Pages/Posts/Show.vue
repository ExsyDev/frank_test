<template>
    <AppLayout title="Posts">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight" v-text="$page.props.post.title" />

            <div class="pt-8 pb-12">
                <div class="max-w-7xl mx-auto min-h-screen">
                    <div class="overflow-hidden border border-gray-200 p-4 sm:rounded-lg">
                        <div v-html="$page.props.post.content" />
                    </div>

                    <h2 class="text-xl mt-8 font-semibold">Comments</h2>

                    <div class="mt-8 overflow-hidden border border-gray-200 p-4 sm:rounded-lg" v-for="comment in $page.props.post.comments">
                        <div class="mb-4 font-bold text-lg" v-text="comment.author.name" />
                        <p v-text="comment.body" />
                        <div class="text-gray-400 mt-4 block" v-text="convertDate(comment.created_at)" />
                    </div>

                    <div class="mt-8 overflow-hidden border border-gray-200 p-4 sm:rounded-lg">
                        <h2 class="font-semibold text-xl mb-4">Make a comment</h2>
                        <form @submit.prevent="comment">
                            <textarea v-model="form.body" class="bg-gray-50 border-gray-300 rounded-lg resize-none w-full h-12"></textarea>
                            <button type="submit" class="bg-gray-800 mt-3 py-2 text-white block w-[250px] rounded-md">Comment</button>
                        </form>
                    </div>
                </div>
            </div>
        </template>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm, usePage } from "@inertiajs/vue3"

const form = useForm({
   'body': null
});

const comment = () => {
    form.post(route('posts.comment', usePage().props.post), {
        preserveScroll: true
    })

    form.reset();
}

const convertDate = (date) => {
    return new Date(date).toLocaleString("ru-RU", {
        day:"2-digit",
        month:"2-digit",
        year:"2-digit",
        hour:"2-digit",
        minute:"2-digit"}
    ).replace(',', '');
}
</script>
