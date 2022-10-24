<script setup>
    import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
    import { Inertia } from '@inertiajs/inertia';
    import { Head, useForm } from "@inertiajs/inertia-vue3";
    import { defineProps } from "vue"
    
    let form = useForm({
        title: '',
        description: '',
    });

    defineProps({
        errors: Object
    })

    let submit = () =>{
        form.post('/posts');
        console.log(form.processing);
    };

    </script>

<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Create
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="submit">
                            <div>
                                <label for="title">Title</label>
                                <input
                                    type="text"
                                    v-model="form.title"
                                    class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600"
                                />
                            </div>
                            <div v-if="errors.title" class="text-red-600"> {{ errors.title }}</div>
                            <div class="mt-4">
                                <label for="title">Description</label>
                                <textarea
                                    name="description"
                                    type="text"
                                    v-model="form.description"
                                    class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600"
                                >
                                </textarea>
                            </div>
                            <div v-if="errors.description" class="text-red-600"> {{ errors.description }}</div>

                            <!-- submit -->
                            <div class="flex items-center mt-4">
                                <button type="submit" class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500" :disabled="form.processing">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
