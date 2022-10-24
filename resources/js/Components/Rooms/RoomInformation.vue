<script setup>
import { defineProps } from "vue";
import { useRoomPlayersStore } from '@/Stores/RoomPlayersStore'
import { storeToRefs } from "pinia";
import { Link } from '@inertiajs/inertia-vue3';
import Spinner from "../Spinner.vue";
import NoData from "../NoData.vue";

const roomInformation = defineProps({
    roomInfo: Object,
})

const { fetchRoomPlayers } = useRoomPlayersStore();
const { players, loading, error } = storeToRefs(useRoomPlayersStore());

fetchRoomPlayers(roomInformation.roomInfo.id);

</script>

<template>
    <div>
        <div class="text-xl font-bold text-center my-2 py-2 bg-orange-100">{{ roomInfo.room_title }}</div>

        <div class="flex justify-between items-center">
            <div class="text-xs text-gray-500">Court Name:</div>
            <div class="text-lg font-semibold">{{ roomInfo.court_name }}</div>
        </div>
        <div class="flex justify-between items-center">
            <div class="text-xs text-gray-500">Room OG:</div>
            <div class="text-lg font-semibold">{{ roomInfo.first_name }} {{ roomInfo.last_name }}</div>
        </div>
        <div class="grid grid-cols-2 gap-3 my-2 text-white">
            <div class="grid justify-center text-center bg-orange-500 rounded-l">
                <div class="text-lg font-bold">{{ roomInfo.game_time }}:00</div>
                <div class="text-xs uppercase"><small>Game Time</small></div>
            </div>
            <div class="grid justify-center gap text-center bg-orange-500 rounded-r">
                <div class="text-lg font-bold">{{ roomInfo.game_date }}</div>
                <div class="text-xs uppercase"><small>Game Date</small></div>
            </div>
        </div>
        <div class="mt-3">
            <div class="items-center text-center mt-3" v-if="loading">
                <Spinner />
                <p class="text-sm text-gray-500 mt-3">Loading Players</p>
            </div>
            <div v-if="error">
                <p class="text-sm text-gray-500 mt-3">{{ error.message }}</p>
            </div>
            <div class="mt-3" v-if="players">
                <div class="flex justify-between border-b pb-1 items-center text-lg bg-white">
                    <div class="font-semibold">Players List</div>
                    <div class="font-bold text-orange-500">{{ players.room_players_count }} <small
                            class="text-xs text-gray-500">of {{ roomInfo.number_of_players }}</small></div>
                </div>
                <div class="h-80 overflow-auto pr-2">
                    <div v-if="players.room_players_count == 0">
                        <NoData />
                    </div>
                    <div class="border-b py-1" v-for="(player, index) in players.room_players" :key="player.id">
                        <div class="flex justify-between items-center">
                            <div class="text-xs">
                                <div class="text-base font-semibold text-gray-900">
                                    <Link :href="route('player.show', { user_id: player.user_id })">{{ player.first_name
                                    }} {{ player.last_name }}</Link>
                                </div>
                                <div class="text-gray-500">
                                    {{ player.code_name }}
                                </div>
                            </div>

                            <div class="text-base font-semibold text-gray-900">
                                {{ player.position }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</template>