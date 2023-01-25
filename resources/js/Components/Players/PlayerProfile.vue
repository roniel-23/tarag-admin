<script setup>
import PlayerStats from '@/Components/Players/PlayerStats.vue'
import Spinner from '@/Components/Spinner.vue'
import Swal from 'sweetalert2'
import PlayerFullId from './PlayerFullId.vue'
import moment from "moment";

import { usePlayersAddressStore } from '../../Stores/PlayersAddressStore'
import { Inertia } from '@inertiajs/inertia'
import { defineProps, ref } from 'vue'
import { storeToRefs } from 'pinia'

const { fetchPlayerAddress } = usePlayersAddressStore();
const { playerAddress, loading, error } = storeToRefs(usePlayersAddressStore());


const showVerificationView = ref(false);
const showFullId = ref(false);

const player_data = defineProps({
    player: Object,
})

defineEmits(['close'])

fetchPlayerAddress(player_data.player.user_id);

function showVerification() {
    showVerificationView.value = !showVerificationView.value;
}

function requestID() {
    Swal.fire({
        title: 'Request another ID?',
        icon: 'info',
        showCancelButton: true,
        confirmButtonText: 'Confirm'
    }).then((result) => {
        if (result.isConfirmed) {
            Inertia.post(`/verification/player/request/${player_data.player.user_id}`)
            location.reload()
        }
    })
}

function showAlert() {
    Swal.fire({
        title: 'Player will be set to verified.',
        icon: 'info',
        showCancelButton: true,
        confirmButtonText: 'Yes, Verify Player'
    }).then((result) => {
        if (result.isConfirmed) {
            Inertia.post(`/verification/player/${player_data.player.user_id}`)
            location.reload()
        }
    })
}

</script>

<template>

    <div v-if="loading" class="text-center text-gray-500 mt-10">
        <Spinner />
        <p class="mt-5">Loading Player Information</p>
    </div>
    <div v-if="error">
        <!-- {{ error.message }} -->
    </div>

    <div class="border border-gray-100 border-1 p-3 bg-white rounded-t-lg">
        <div class="flex justify-start items-center gap-5">
            <div class="flex gap-4 items-center">
                <img class="object-contain h-64 w-72 p-1 shadow-lg" :src="$imageURL+'/uploads/'+player.photo"
                    :alt="player.code_name">
                <div class="grid grid-row-3 pr-10">
                    <div class="text-black text-3xl font-semibold">
                        {{ player.first_name }}
                    </div>
                    <div class="text-black text-3xl font-semibold">
                        {{ player.last_name }}
                    </div>
                    <div class="text-red-600 text-lg font-semibold">
                        B{{ moment(player.created_at).format('YY') }}{{ player.user_id }}
                    </div>
                    <hr class="text-gray-900 mt-2">
                    <div class="text-gray-700 text-2xl font-semibold mt-2">
                        {{ player.code_name }}
                    </div>
                    <div class="text-gray-500">
                        Status:
                        <span @click="showVerification"
                            class="text-white font-semibold rounded-full px-2 cursor-pointer"
                            :class="player.verified == 1 ? 'bg-green-500' : 'bg-red-500'">
                            <span v-if="player.verified == 1">
                                Verified
                            </span>
                            <span v-else>
                                Unverified
                            </span>
                        </span>
                    </div>
                    <div class="grid grid-cols-2 gap-2 text-center text-white mt-2">
                        <div class="bg-blue-500 py-1 px-4">
                            <p class="text-xl font-semibold shadow-xl">{{ player.gcoin }}.00</p>
                            <p class="text-sm font-semibold"><small>G! Coin</small></p>
                        </div>
                        <div class="bg-blue-500 py-1 px-4">
                            <p class="text-xl font-semibold shadow-xl">{{ player.gcoin_reward }}.00</p>
                            <p class="text-sm font-semibold"><small>Reward</small></p>
                        </div>
                    </div>
                </div>
            </div>
            <div v-show="!showVerificationView" class="text-lg text-gray-400 px-10">
                <div class="text-xs">Weight</div>
                <div class="text-black font-semibold">
                    {{ player.weight }}kg
                </div>
                <div class="text-xs mt-4">Height</div>
                <div class="text-black font-semibold">
                    {{ player.height }}
                </div>
                <div class="text-xs mt-4">Position</div>
                <div class="text-black font-semibold">
                    {{ player.position }}
                </div>
            </div>
            <div v-if="playerAddress" class="text-lg text-gray-400">
                <div class="text-xs">Address</div>
                <div class="text-black font-semibold">
                    {{ playerAddress.address }} <br>{{ playerAddress.barangay }}
                </div>
                <div class="text-xs mt-4">Second Address</div>
                <div class="text-black font-semibold">
                    {{ playerAddress.municipality }} {{ playerAddress.province }}
                </div>
                <div class="text-xs mt-4">zipcode</div>
                <div class="text-black font-semibold">
                    {{ playerAddress.zipcode }}
                </div>
            </div>
            <div v-if="playerAddress" v-show="showVerificationView" class="mx-auto p-2 items-center shadow-lg">
                <div v-if="player.verified == 1" class="flex justify-end text-red-500">
                    <button @click="showVerification">
                        <i class="px-1 fa-solid fa-xmark hover:scale-125"></i>
                    </button>
                </div>

                <div class="mb-4">
                    <img @click="showFullId = true"
                        class="mx-auto h-48 w-80 cursor-pointer transition hover:scale-150 hover:border-4 hover:border-white"
                        :src="$imageURL+'/uploads/'+playerAddress.id_photo"
                        alt="Submitted ID">
                </div>

                <div v-if="player.verified == 0" class="grid text-white grid-cols-4 gap-1">
                    <button @click="showAlert"
                        class="shadow-lg bg-green-600 rounded-l-md hover:bg-green-700">Accept</button>
                    <button @click="requestID" class="shadow-lg col-span-2 bg-gray-900 hover:bg-gray-800">Request another
                        ID</button>
                    <button @click="showVerification"
                        class="shadow-lg bg-red-600 rounded-r-md hover:bg-red-700 ">Close</button>
                </div>
                <div v-if="player.verified == 2" class="grid text-white grid-cols-4 gap-1">
                    <button @click="showAlert"
                        class="shadow-lg bg-green-600 rounded-l-md hover:bg-green-700">Accept</button>
                    <button disabled
                        class="col-span-2 text-gray-800">Request sent!</button>
                    <button @click="showVerification"
                        class="shadow-lg rounded-r-md bg-red-600 hover:bg-red-700">Close</button>
                </div>
            </div>
        </div>
    </div>

    <PlayerFullId v-if="showFullId" :id="playerAddress.id_photo" @close="showFullId = false"></PlayerFullId>
    <div class="border border-gray-100 border-1 bg-white my-1">
        <PlayerStats />
    </div>




</template>

<style scoped>

</style>