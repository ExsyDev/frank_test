<template>
    <AppLayout title="Posts">
        <template #header>
            <div class="flex items-center space-x-4">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Posts
                </h2>
                <Link class="underline" :href="route('posts.create')">Create new post</Link>
            </div>

            <div class="py-12">
                <div class="max-w-7xl mx-auto min-h-screen">
                    <div class="overflow-hidden border border-gray-200 sm:rounded-lg">
                        <table class="w-full">
                            <tr class="border-b border-gray-200">
                                <th class="py-2">Title</th>
                                <th class="py-2">Author</th>
                                <th class="py-2" >Action</th>
                            </tr>
                            <tr v-for="post in $page.props.posts">
                                <td class="border-r border-b border-gray-200 text-center py-2" v-text="post.title" />
                                <td class="border-r border-b border-gray-200 text-center py-2" v-text="post.author.name" />
                                <td class="border-r border-b border-gray-200 text-center py-2 space-x-4 w-1/3">
                                    <Link :href="route('posts.show', post)" class=" underline">Show</Link>
                                    <Link :href="route('posts.edit', post)" class=" underline">Edit</Link>
                                    <form class="inline" @submit.prevent="form.post(route('posts.delete', post))">
                                        <button type="submit" class="underline">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </template>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, useForm } from "@inertiajs/vue3"

const form = useForm({});
</script>
