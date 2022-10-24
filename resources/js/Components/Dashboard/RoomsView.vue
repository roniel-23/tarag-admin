<script setup>
import { defineProps } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';
import NoData from '@/Components/NoData.vue'

defineProps({
    rooms: Object
})
</script>

<template>

    <div class="p-2 border-b rounded-t bg-white">
        <div class="text-lg font-semibold text-blue-900">
            Rooms
        </div>
    </div>
    <div class="no-scrollbar fixed-height mx-1 overflow-auto">
        <div v-if="rooms.length == 0">
            <NoData />
        </div>
        <div v-for="room in rooms" :key="room.id"
            class="bg-white fixed-height-below grid items-center mt-2 p-2 rounded-lg shadow-lg">
            <div class="flex justify-between border-b border-gray-300 text-blue-900">
                <h3 class="uppercase text-lg font-semibold text-blue-700">{{ room.room_title }}</h3>
                <p class="text-sm">{{ room.game_time }}:00</p>
            </div>
            <div class="flex justify-between items-center px-2">
                <div class="text-gray-400 text-xs">Court Name:</div>
                <div class="text-gray-700 text-base font-semibold">{{ room.court_name }}</div>
            </div>
            <div class="flex justify-between items-center px-2">
                <div class="text-gray-400 text-xs">Room OG Name:</div>
                <div class="text-gray-700 text-base font-semibold">{{ room.first_name }} {{ room.last_name }}</div>
            </div>
        </div>
    </div>

</template>

<style scoped>
.fixed-height {
    height: 50vh;
}

.fixed-height-below {
    height: 7.5rem;
}

.no-scrollbar::-webkit-scrollbar {
    display: none;
}

.no-scrollbar {
    -ms-overflow-style: none;
    /* IE and Edge */
    scrollbar-width: none;
    /* Firefox */
}
</style>