<script setup>
import CourtHistory from './CourtHistory.vue'
import Spinner from '@/Components/Spinner.vue'
import Swal from 'sweetalert2'
import CourtFullId from './CourtFullId.vue'

import { useCourtsAddressStore } from '@/Stores/CourtsAddressStore'
import { useCourtDataStore } from '@/Stores/CourtDataStore'
import { Inertia } from '@inertiajs/inertia'
import { defineProps, ref } from 'vue'
import { storeToRefs } from 'pinia'

const { fetchCourtAddress } = useCourtsAddressStore();
const { fetchCourtData } = useCourtDataStore();
const { courtAddress, loading, error } = storeToRefs(useCourtsAddressStore());
const { courtData } = storeToRefs(useCourtDataStore());

const showVerificationView = ref(false);
const showFullHeaderView = ref(true);
const showFullId = ref(false);

const court_data = defineProps({
    court: Object,
})

defineEmits(['close'])

fetchCourtAddress(court_data.court.user_id);
fetchCourtData(court_data.court.id);

function showVerification() {
    showVerificationView.value = !showVerificationView.value;
}

function showFullHeader() {
    showFullHeaderView.value = !showFullHeaderView.value;
}

function requestID() {
    Swal.fire({
        title: 'Request another ID?',
        icon: 'info',
        showCancelButton: true,
        confirmButtonText: 'Confirm'
    }).then((result) => {
        if (result.isConfirmed) {
            Inertia.post(`/verification/court/request/${court_data.court.user_id}`)
            location.reload()
        }
    })
}

function showAlert() {
    Swal.fire({
        title: 'Court will be set to verified.',
        icon: 'info',
        showCancelButton: true,
        confirmButtonText: 'Yes, Verify Court'
    }).then((result) => {
        if (result.isConfirmed) {
            Inertia.post(`/verification/court/${court_data.court.user_id}`)
            location.reload()
        }
    })
}

</script>
    
<template>

    <div v-if="loading" class="text-center text-gray-500 mt-10">
        <Spinner />
        <p class="mt-5">Loading Court Information</p>
    </div>
    <div v-if="error">
        <!-- {{ error.message }} -->
    </div>

    <div v-if="showFullHeaderView" class="border border-gray-100 border-1 p-3 bg-white rounded-t-lg">
        <div class="flex justify-between items-center gap-5">
            <div class="flex gap-4 items-center">
                <img class="object-contain h-64 w-96 shadow-lg p-1"
                    :src="$imageURL + '/uploads/' + court_data.court.court_images.split(',')[0]"
                    :alt="court_data.court.court_name">

                <div class="grid grid-row-3 pr-10 text-gray-500">
                    <div class="text-black text-3xl font-semibold">
                        <i @click="showFullHeader"
                            class="text-gray-400 text-xl fa-solid fa-caret-up cursor-pointer hover:text-gray-700"></i>
                        {{ court_data.court.court_name }}
                    </div>
                    <hr class="text-gray-900 mt-2">
                    <div class="my-1">
                        <div class="text-xs">Court Owner</div>
                        <div class="text-black text-base font-semibold">
                            {{ court_data.court.first_name }} {{ court_data.court.last_name }}
                        </div>
                    </div>
                    <div v-if="courtAddress">
                        <div class="text-xs">Address</div>
                        <div class="text-black font-semibold">
                            {{ courtAddress.address }} {{ courtAddress.barangay }}
                        </div>
                    </div>
                    <div v-if="courtAddress" class="my-1">
                        <div class="text-xs">Second Address</div>
                        <div class="text-black font-semibold">
                            {{ courtAddress.municipality }} {{ courtAddress.province }} {{ courtAddress.zipcode }}
                        </div>
                    </div>
                    <div class="text-gray-500">
                        Status:
                        <span @click="showVerification"
                            class="text-white font-semibold rounded-full px-2 cursor-pointer"
                            :class="court_data.court.verified == 1 ? 'bg-green-500' : 'bg-red-500'">
                            <span v-if="court_data.court.verified == 1">
                                Verified
                            </span>
                            <span v-else>
                                Unverified
                            </span>
                        </span>
                    </div>
                </div>
            </div>
            <div v-show="!showVerificationView" class="grid grid-cols-2 gap-8 text-base text-white mx-auto">
                <div class="text-center bg-gray-800 px-5 py-3 shadow-red-500">
                    <div class="text-3xl font-bold">
                        {{ court_data.court.user_id }}
                    </div>
                    <div>
                        Court ID
                    </div>
                </div>
                <div v-if="courtData" class="text-center bg-gray-800 px-5 py-3">
                    <div class="text-3xl font-bold">
                        {{ courtData.rate.price_rate }} <span class="text-base">/ hr</span>
                    </div>
                    <div>
                        Court Rate
                    </div>
                </div>
                <div v-if="courtData" class="text-center bg-blue-600 px-5 py-3">
                    <div class="text-2xl font-bold">
                        {{ courtData.total_room }}
                    </div>
                    <div>
                        Room Count
                    </div>
                </div>
                <div class="text-center bg-blue-600 px-5 py-3">
                    <div class="text-2xl font-bold">
                        {{ court_data.court.gcoin }}.00
                    </div>
                    <div>
                        G! Coin
                    </div>
                </div>
            </div>
            <div v-if="courtAddress" v-show="showVerificationView" class="mx-auto p-2 items-center shadow-lg">
                <div v-if="court.verified == 1" class="flex justify-end text-red-500">
                    <button @click="showVerification">
                        <i class="px-1 fa-solid fa-xmark hover:scale-125"></i>
                    </button>
                </div>
                <div class="mb-4">
                    <img @click="showFullId = true"
                        class="mx-auto object-scale-down bg-white h-48 w-80 cursor-pointer transition hover:scale-150 hover:border-4 hover:border-white"
                        :src="$imageURL + '/uploads/' + courtAddress.id_photo" alt="Submitted ID">
                </div>

                <div v-if="court.verified == 0" class="grid text-white grid-cols-4 gap-1">
                    <button @click="showAlert"
                        class="shadow-lg bg-green-600 rounded-l-md hover:bg-green-700">Accept</button>
                    <button @click="requestID" class="shadow-lg col-span-2 bg-gray-900 hover:bg-gray-800">Request
                        another
                        ID</button>
                    <button @click="showVerification"
                        class="shadow-lg rounded-r-md bg-red-600 hover:bg-red-700">Close</button>
                </div>
                <div v-if="court.verified == 2" class="grid text-white grid-cols-4 gap-1">
                    <button @click="showAlert"
                        class="shadow-lg bg-green-600 rounded-l-md hover:bg-green-700">Accept</button>
                    <button disabled class="col-span-2 text-gray-800">Request sent!</button>
                    <button @click="showVerification"
                        class="shadow-lg rounded-r-md bg-red-600 hover:bg-red-700">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div v-if="!showFullHeaderView" class="border border-gray-100 border-1 p-5 mb-2 bg-white rounded-t-lg">
        <div class="flex justify-between items-center gap-5">
            <div class="flex">
                <div class="flex gap-2 text-black text-3xl font-semibold items-center">
                    <i @click="showFullHeader"
                        class="text-gray-400 text-xl fa-solid fa-caret-down cursor-pointer hover:text-gray-600"></i>
                    <div>{{ court_data.court.court_name }}</div>
                </div>
            </div>
            <div class="grid grid-cols-4 gap-3 text-base text-black">
                <div class="text-center">
                    <div class="text-3xl font-bold">
                        {{ court_data.court.user_id }}<span class="text-xs text-gray-400"> Court ID</span>
                    </div>
                </div>
                <div v-if="courtData" class="text-center">
                    <div class="text-3xl font-bold">
                        {{ courtData.rate.price_rate }}<span class="text-base">/hr</span><span
                            class="text-xs text-gray-400"> Court Rate</span>
                    </div>
                </div>
                <div v-if="courtData" class="text-center">
                    <div class="text-3xl font-bold">
                        {{ courtData.total_room }}<span class="text-xs text-gray-400"> Room Count</span>
                    </div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold">
                        {{ court_data.court.gcoin }}.00 <span class="text-xs text-gray-400">G! Coin</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <CourtFullId v-if="showFullId" :id="($imageURL + '/uploads/' + courtAddress.id_photo)" @close="showFullId = false"></CourtFullId>
    <div v-if="courtData" class="border border-gray-100 border-1 bg-white my-1">
        <CourtHistory :courtRooms="courtData.rooms" :toggle="showFullHeaderView" />
    </div>

</template>
    
<style scoped>

</style>