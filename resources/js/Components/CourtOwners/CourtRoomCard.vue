<script setup>
import { defineProps } from "vue";
import moment from "moment";

const props = defineProps({
    room: Object,
})

</script>
    
<template>

    <td class="px-6 py-2 whitespace-nowrap">
        <div class="flex items-center">
            <div class="ml-4 text-base">
                <div class="font-bold text-gray-900">
                    {{ room.room_title }}
                </div>
            </div>
        </div>
    </td>
    <td class="px-6 py-2 whitespace-nowrap text-start">
        {{ room.first_name }} {{ room.last_name }}
    </td>
    <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500">
        <div class="bg-yellow-400 text-white font-bold py-1">{{ room.number_of_players }}</div>
    </td>
    <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500">
        {{ room.game_time }}:00
    </td>
    <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500">
        {{ moment(room.game_date).format("MMMM DD YYYY") }}
    </td>
</template>
    
<style scoped>

</style>