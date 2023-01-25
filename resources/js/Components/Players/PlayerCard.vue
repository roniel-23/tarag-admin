<script setup>
import { defineProps, ref } from "vue";
import { Link } from '@inertiajs/inertia-vue3';
import { Inertia } from "@inertiajs/inertia";
import Swal from 'sweetalert2';
import moment from "moment";

const player_data = defineProps({
    player: Object,
})

const deleteValue = ref(player_data.player.delete);

function deletePlayer() {
    Swal.fire({
        title: 'Move this player to trash?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, move to trash'
    }).then((result) => {
        if (result.isConfirmed) {
            Inertia.post(`/player/delete/${player_data.player.user_id}`)
            location.reload()
        }
    })
}

function permanentDeletePlayer() {
    Swal.fire({
        title: 'Are you sure you want to permanently delete this player?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, Delete Player'
    }).then((result) => {
        if (result.isConfirmed) {
            Inertia.post(`/player/delete/permanent/${player_data.player.user_id}`)
            location.reload()
        }
    })
}

function recoverPlayer() {
    Swal.fire({
        title: 'Are you sure you want to recover this player?',
        icon: 'info',
        showCancelButton: true,
        confirmButtonText: 'Yes, recover'
    }).then((result) => {
        if (result.isConfirmed) {
            Inertia.post(`/player/recover/${player_data.player.user_id}`)
            location.reload()
        }
    })
}
</script>

<template>

    <td class="px-6 py-2 whitespace-nowrap">
        <div class="flex items-center">
            <div class="flex-shrink-0 h-10 w-10">
                <img class="object-contain w-10 h-10 rounded-full border-4"
                    :class="player_data.player.verified == 1 ? 'border-blue-700' : 'border-gray-300'"
                    :src="$imageURL+'/uploads/'+player_data.player.photo">

            </div>
            <div class="ml-4 text-sm">
                <div v-if="deleteValue == 0" class="font-semibold text-gray-900">
                    <Link :href="route('player.show', { user_id: player_data.player.user_id })">
                    {{ player_data.player.first_name }} {{ player_data.player.last_name }}
                    </Link>
                </div>
                <div v-else-if="deleteValue == 1" class="font-semibold text-gray-900">
                    {{ player_data.player.first_name }} {{ player_data.player.last_name }}
                </div>
                <div class="text-gray-500">
                    {{ player_data.player.code_name }}
                </div>
            </div>
        </div>
    </td>
    <td class="px-6 py-2 whitespace-nowrap">
        <div>
            <div class="text-sm text-gray-900">
                {{ player_data.player.position }}
            </div>
            <div class="text-sm text-gray-500">
                {{ player_data.player.gender }} {{ player_data.player.height }}
            </div>
        </div>
    </td>
    <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500">
        {{ player_data.player.gcoin }}.00
    </td>
    <td class="px-6 py-2 whitespace-nowrap">
        <div class="bg-green-400 text-center">
            <span class="text-md font-semibold rounded-full cursor-pointer text-white">
                B{{ moment(player_data.player.created_at).format('YY') }}{{ player_data.player.user_id }}
            </span>
        </div>

    </td>
    <td  v-if="deleteValue == 0" class="whitespace-nowrap flex items-center align-center mt-4 gap-4">
        <Link :href="route('player.show', { user_id: player_data.player.user_id })">
        <i class="fa-solid fa-eye text-blue-600 hover:text-blue-500 cursor-pointer shadow-md transition hover:scale-110"></i>
        </Link>
        <i @click="deletePlayer" class="fa-solid fa-trash text-red-600 hover:text-red-500 cursor-pointer shadow-md transition hover:scale-110"></i>
    </td>
    <td v-else-if="deleteValue == 1" class="whitespace-nowrap flex items-center align-center mt-4 gap-4">
        <i @click="recoverPlayer" class="fa-solid fa-trash-can-arrow-up text-blue-600 hover:text-blue-500 cursor-pointer shadow-md transition hover:scale-110"></i>
        <i @click="permanentDeletePlayer" class="fa-solid fa-trash text-red-600 hover:text-red-500 cursor-pointer shadow-md transition hover:scale-110"></i>
    </td>

</template>

<style scoped>

</style>