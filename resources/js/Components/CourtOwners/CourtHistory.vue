<script setup>
import { ref, defineProps } from 'vue';
import CourtRoomCard from './CourtRoomCard.vue';
import NoData from '@/Components/NoData.vue';

const active = ref(true);

const rooms = defineProps({
    courtRooms: Array,
    toggle: Boolean
})

console.log(rooms.courtRooms.length)

</script>
    
<template>
    <div class="grid grid-cols-2 text-center text-white font-bold text-xs">
        <div @click="active=!active" :class="active ? 'bg-gray-900': 'bg-white text-gray-900'"
            class="border border-gray-900 py-2 cursor-pointer hover:bg-gray-900 hover:text-white">
            ROOMS
        </div>
        <div @click="active=!active" :class="!active ? 'bg-gray-900': 'bg-white text-gray-900'"
            class="border border-gray-900 py-2 cursor-pointer hover:bg-gray-900 hover:text-white">
            COURT GALLERY
        </div>
    </div>
    <div v-if="active" class="flex flex-col block mt-2" :class="toggle ? 'h-72' : 'fixed-table-height'">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div>
                    <!-- <table class="min-w-full text-center"> -->
                        <table class="w-full text-center">
                        <thead class="border-b bg-gray-900 sticky top-0">
                            <tr class="text-xs font-medium text-white">
                                <th scope="col" class="px-6 py-2">
                                    ROOM NAME
                                </th>
                                <th scope="col" class="px-6 py-2">
                                    ROOM OG
                                </th>
                                <th scope="col" class="px-6 py-2">
                                    NUMBER OF PLAYERS
                                </th>
                                <th scope="col" class="px-6 py-2">
                                    TIME
                                </th>
                                <th scope="col" class="px-6 py-2">
                                    DATE
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white border-b" v-for="room in courtRooms" :key="room.id">
                                <CourtRoomCard :room="room" />
                            </tr>
                        </tbody>
                    </table>
                    <NoData v-if="rooms.courtRooms.length == 0" />
                </div>
            </div>
        </div>
    </div>
    <div v-if="!active" class="flex flex-col">

    </div>

</template>
    
<style scoped>
    .fixed-table-height {
        height: 65vh;
    }
</style>