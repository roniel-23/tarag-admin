<script setup>
import { Head } from '@inertiajs/inertia-vue3';
import { ref, defineProps } from 'vue';
import { Inertia } from "@inertiajs/inertia";
import { useForm } from '@inertiajs/inertia-vue3'
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import Swal from 'sweetalert2';

const props = defineProps({
    settings: Object
})
const transaction_limit = ref(props.settings.player_transaction_limit)
const percentage = ref(props.settings.payment_percentage)
const description = ref(props.settings.app_description);

const form = useForm({
    name: null,
    apk: null,
})

let showTransactEdit = ref(false);
let showPercentEdit = ref(false);
let showDescription = ref(false);

function updateTransaction() {
    Inertia.post('/settings/transaction', { limit: transaction_limit.value, percent: percentage.value }, {
        preserveState: true,
        replace: true,
        onSuccess: () => { showTransactEdit.value = false, showPercentEdit.value = false }
    });
}

function updateLandingPage() {
    Inertia.post('/settings/landing', { description: description.value }, {
        preserveState: true,
        replace: true,
        onSuccess: () => { showDescription.value = false }
    });
}

function submit() {
    Swal.fire({
        title: 'Upload Application File?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Confirm'
    }).then((result) => {
        if (result.isConfirmed) {
            form.post('/upload/apk', {
                preserveState: true,
                replace: true,
                onError: () => { },
            });
            Swal.fire('Success', '', 'success');
            form.name = null;
            form.apk = null;
        }
    })
}
</script>
    
<template>

    <Head title="Settings" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Settings
            </h2>
        </template>

        <div class="py-3">
            <div class="max-w-7xl px-8 bg-white">
                <div class="flex justify-center pt-10">
                    <div class="w-64 text-lg font-semibold text-black mt-2">
                        <i class="text-blue-500 fa-solid fa-bars-progress"></i>
                        <span class="text-blue-700 ml-2">Transactions</span>
                    </div>
                    <div class="shadow-lg rounded-lg p-5 w-full">
                        <div class="overflow-x-auto relative">
                            <table class="w-full text-sm text-left text-gray-500">
                                <thead class="text-xs text-white uppercase bg-blue-700">
                                    <tr>
                                        <th scope="col" class="py-3 px-6">
                                            Description
                                        </th>
                                        <th scope="col" class="py-3 px-6">
                                            Value
                                        </th>
                                        <th scope="col" class="py-3 px-6">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row"
                                            class="py-4 px-6 text-base text-gray-900 whitespace-nowrap dark:text-white">
                                            Player Transaction Limit (<span class="font-normal"> daily </span>)
                                        </th>
                                        <td class="py-4 px-6 text-gray-800 font-bold">
                                            <div v-if="!showTransactEdit" class="w-44 text-sm">{{
                                                    props.settings.player_transaction_limit
                                            }}</div>
                                            <input v-else v-model="transaction_limit" type="number"
                                                class="w-44 text-sm py-0 px-0 rounded-sm border-none ring focus:outline-none" />
                                        </td>
                                        <td class="py-4 px-6 text-base">
                                            <i v-if="!showTransactEdit" @click="showTransactEdit = !showTransactEdit"
                                                class="fa-solid fa-pen cursor-pointer hover:text-blue-500 hover:scale-110"></i>
                                            <div v-else>
                                                <i @click="showTransactEdit = !showTransactEdit"
                                                    class="fa-solid fa-xmark text-red-500 cursor-pointer"></i>
                                                <i @click="updateTransaction"
                                                    class="fa-solid fa-check ml-2 text-green-500 cursor-pointer"></i>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row"
                                            class="py-4 px-6 text-base text-gray-900 whitespace-nowrap dark:text-white">
                                            Payment Percentage
                                        </th>
                                        <td class="py-4 px-6 text-gray-800 font-bold">
                                            <div v-if="!showPercentEdit" class="w-44 text-sm">{{
                                                    props.settings.payment_percentage
                                            }}%</div>
                                            <input v-else v-model="percentage" type="number"
                                                class="w-44 text-sm py-0 px-0 rounded-sm border-none ring focus:outline-none" />
                                        </td>
                                        <td class="py-4 px-6 text-base">
                                            <i v-if="!showPercentEdit" @click="showPercentEdit = !showPercentEdit"
                                                class="fa-solid fa-pen cursor-pointer hover:text-blue-500 hover:scale-110"></i>
                                            <div v-else>
                                                <i @click="showPercentEdit = !showPercentEdit"
                                                    class="fa-solid fa-xmark text-red-500 cursor-pointer"></i>
                                                <i @click="updateTransaction"
                                                    class="fa-solid fa-check ml-2 text-green-500 cursor-pointer"></i>
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center pt-10">
                    <div class="w-64 text-lg font-semibold text-black mt-2">
                        <i class="text-blue-500 fa-solid fa-bars-progress"></i>
                        <span class="text-blue-700 ml-2">Landing Page</span>
                    </div>
                    <div class="shadow-lg rounded-lg p-5 w-full">
                        <div class="overflow-x-auto relative">
                            <table class="w-full text-sm text-left text-gray-500">
                                <thead class="text-xs text-white uppercase bg-blue-700">
                                    <tr>
                                        <th scope="col" class="py-3 px-6">
                                            Description
                                        </th>
                                        <th scope="col" class="py-3 px-6">
                                            Value
                                        </th>
                                        <th scope="col" class="py-3 px-6">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row"
                                            class="py-4 px-6 text-base text-gray-900 whitespace-nowrap dark:text-white">
                                            Application Description
                                        </th>
                                        <td class="py-4 px-6 text-gray-800 font-semibold">
                                            <div v-if="!showDescription" class="text-sm">
                                                {{ props.settings.app_description }}
                                            </div>
                                            <div v-else>
                                                <textarea v-model="description" cols="58" rows="8"
                                                    class="text-sm rounded-sm border-none ring">
                                            </textarea>
                                            </div>

                                        </td>
                                        <td class="py-4 px-6 text-base">
                                            <i v-if="!showDescription" @click="showDescription = !showDescription"
                                                class="fa-solid fa-pen cursor-pointer hover:text-blue-500 hover:scale-110"></i>
                                            <div v-else>
                                                <i @click="showDescription = !showDescription"
                                                    class="fa-solid fa-xmark text-red-500 cursor-pointer"></i>
                                                <i @click="updateLandingPage"
                                                    class="fa-solid fa-check ml-2 text-green-500 cursor-pointer"></i>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center pt-10 pb-10">
                    <div class="w-64 text-lg font-semibold text-black mt-2">
                        <i class="text-blue-500 fa-solid fa-bars-progress"></i>
                        <span class="text-blue-700 ml-2">APK File</span>
                    </div>
                    <div class="shadow-lg rounded-lg p-5 w-full">
                        <form @submit.prevent="submit" class="grid">
                            <div class="flex mb-2">
                                <div class="flex items-center">
                                    <p class="w-24 bg-blue-500 py-2 text-center text-xs font-bold text-white uppercase">
                                        App Name</p>
                                    <span>
                                        <input type="text" v-model="form.name" placeholder="Input App name" required
                                            class="text-xs border-gray-200">
                                    </span>
                                </div>

                                <input type="file" @input="form.apk = $event.target.files[0]" required
                                    class="w-full border-y text-xs file:text-xs file:bg-blue-500 file:py-2 file:px-4 file:uppercase file:text-white file:font-semibold file:border-none file:cursor-pointer" />
                                <button type="reset" class="text-xs font-bold bg-red-500 px-5 text-white">CLEAR</button>
                                <button type="submit"
                                    class="rounded-r-full text-xs font-bold bg-green-500 px-5 text-white">UPLOAD</button>
                            </div>
                            <div v-if="form.errors.apk">{{ form.errors.apk }}</div>

                            <progress v-if="form.progress" :value="form.progress.percentage" max="100" class="w-full">
                                {{ form.progress.percentage }}%
                            </progress>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
    