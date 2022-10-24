<script setup>
defineProps({
    room: Object
})
</script>

<template>
    <div class="text-black pl-1 mt-2">
        <div class="flex justify-between items-center px-2">
            <div class="text-gray-400 text-xs">Court Name:</div>
            <div class="text-gray-700 text-base font-semibold">{{ room.court_name }}</div>
        </div>
        <div class="flex justify-between items-center px-2">
            <div class="text-gray-400 text-xs">Room OG Name:</div>
            <div class="text-gray-700 text-base font-semibold">{{ room.first_name }} {{ room.last_name }}</div>
        </div>
    </div>

</template>

<style scoped>

</style>