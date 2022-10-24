<script setup>
import { defineProps } from "vue";

defineProps({
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
        <div class="">{{ room.number_of_players }}</div>
    </td>
    <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500">
        {{ room.game_time }}:00
    </td>
    <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500">
        {{ room.game_date }}
    </td>
</template>
    
<style scoped>

</style>