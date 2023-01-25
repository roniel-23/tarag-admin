<script setup>
import { defineProps, defineEmits, ref } from "vue";
import * as htmlToImage from 'html-to-image';
import { toPng, toJpeg } from 'html-to-image';

const props = defineProps({
    transaction: Object,
})

let receiver = ref('');

const emits = defineEmits(['close'])

function saveReceipt(reference_no) {
    htmlToImage.toJpeg(document.getElementById('image_to_save'), { quality: 0.95 })
        .then(function (dataUrl) {
            var link = document.createElement('a');
            link.download = 'receipt-' + reference_no;
            link.href = dataUrl;
            link.click();
        });
    }

</script>

<template>
    <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div
                    class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <!-- <div class="flex justify-end">
                            <button @click="$emit('close')"><i class="fa-solid fa-xmark text-red-500"></i></button>
                        </div> -->
                        <div id="image_to_save" class="p-2 bg-white">
                            <div class="border border-black pb-2">
                                <div class="h-20 flex items-center justify-center">
                                    <div class="flex gap-2">
                                        <div>
                                            <img class="w-12 h-12" src="../../../../storage/images/tarag_logo.png"
                                                alt="Tara G! Logo">
                                        </div>
                                        <div>
                                            <h2 class="text-xl text-orange-500 font-bold">TARA G!</h2>
                                            <p class="text-gray-700"><small>Transaction Receipt</small></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="border-y mx-5 px-10 py-3 text-black">
                                    <div class="flex justify-between">
                                        <div class="text-gray-600">
                                            <small>Amount Due</small>
                                        </div>
                                        <div class="text-lg font-bold">
                                            {{ transaction.amount }}.00
                                        </div>
                                    </div>
                                    <div class="flex justify-between">
                                        <div class="text-gray-600">
                                            <small>Sender</small>
                                        </div>
                                        <div v-if="transaction.sender_first_name != null"
                                            class="text-base font-semibold">
                                            {{ transaction.sender_first_name }} {{ transaction.sender_last_name }}
                                        </div>
                                        <div v-else class="text-base font-semibold">
                                            Tara G!
                                        </div>
                                    </div>
                                    <div class="flex justify-between">
                                        <div class="text-gray-600">
                                            <small>Received by</small>
                                        </div>
                                        <div v-if="transaction.player_first_name != null"
                                            class="text-base font-semibold">
                                            {{ transaction.player_first_name }} {{ transaction.player_last_name }}
                                        </div>
                                        <div v-else-if="transaction.court_first_name != null"
                                            class="text-base font-semibold">
                                            {{ transaction.court_first_name }} {{ transaction.court_last_name }}
                                        </div>
                                        <div v-else class="text-base font-semibold">
                                            Tara G!
                                        </div>
                                    </div>
                                    <div class="flex justify-between">
                                        <div class="text-gray-600">
                                            <small>Transaction Type</small>
                                        </div>
                                        <div v-if="transaction.event?.includes('Payment')"
                                            class="text-base font-semibold text-blue-700">
                                            {{ transaction.event }}
                                        </div>
                                        <div v-else-if="transaction.event?.includes('Leave')"
                                            class="text-base font-semibold text-red-700">
                                            {{ transaction.event }}
                                        </div>
                                        <div v-else class="text-base font-semibold text-green-700">
                                            {{ transaction.event }}
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center text-gray-600 my-2 text-blue-500">
                                    <small>
                                        <p>Reference No: <span class="font-bold">{{ transaction.reference_no }}</span>
                                        </p>
                                        <p>{{ transaction.created_at }}</p>
                                    </small>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <button type="button" @click="$emit('close')"
                            class="inline-flex w-full justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm">Close</button>
                        <button type="button" @click="saveReceipt(transaction.reference_no)"
                            class="mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Download</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>