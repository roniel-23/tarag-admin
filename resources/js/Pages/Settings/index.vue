<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { ref, defineProps } from 'vue';
import { Inertia } from "@inertiajs/inertia";

const props = defineProps({
    settings: Object
})
const transaction_limit = ref(props.settings.player_transaction_limit)
const percentage = ref(props.settings.payment_percentage)
const description = ref(props.settings.app_description);

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
                <div class="flex justify-center py-10">
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
                                            Player Transaction Limit
                                        </th>
                                        <td class="py-4 px-6 text-gray-800 font-bold">
                                            <div v-if="!showTransactEdit" class="w-44 text-sm">{{
                                            props.settings.player_transaction_limit }}</div>
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
                                            props.settings.payment_percentage }}%</div>
                                            <input v-else v-model="percentage" type="number"
                                                class="w-44 text-sm py-0 px-0 rounded-sm border-none ring focus:outline-none" />
                                        </td>
                                        <td class="py-4 px-6 text-lg">
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
                <div class="flex justify-center py-10">
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
                                                <textarea v-model="description" cols="58" rows="8" class="text-sm rounded-sm border-none ring">
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
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
    