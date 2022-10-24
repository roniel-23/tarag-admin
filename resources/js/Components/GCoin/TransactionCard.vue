<script setup>
import { defineProps, defineEmits } from "vue";

defineProps({
    transaction: Object,
})
const emits = defineEmits(['transaction'])
</script>
    
<template>

    <td class="px-2 py-2 whitespace-nowrap text-sm text-gray-500">
        {{ transaction.created_at }}
    </td>
    <td class="px-2 py-2 whitespace-nowrap">
        <div>
            <div v-if="transaction.event.includes('Payment')" class="px-4 inline-flex text-md rounded-full bg-blue-400 text-white">
                {{ transaction.event }}
            </div>
            <div v-else-if="transaction.event.includes('Leave')" class="px-4 inline-flex text-md rounded-full bg-red-500 text-white">
                {{ transaction.event }}
            </div>
            <div v-else class="px-4 inline-flex text-md rounded-full bg-green-500 text-white">
                {{ transaction.event }}
            </div>
        </div>
    </td>
    <td class="px-2 py-2 whitespace-nowrap text-sm font-semibold text-gray-900">
            {{ transaction.amount }}.00
    </td>
    <td v-if="transaction.sender_first_name != null " class="px-2 py-2 whitespace-nowrap text-sm text-gray-500">
        {{ transaction.sender_first_name }} {{ transaction.sender_last_name }}
    </td>
    <td v-else class="px-2 py-2 whitespace-nowrap text-sm text-gray-500">
        TARA G!
    </td>

    <td v-if="transaction.player_first_name != null" class="px-2 py-2 whitespace-nowrap text-sm text-gray-500">
        {{ transaction.player_first_name }} {{ transaction.player_last_name }}
    </td>
    <td v-else-if="transaction.court_first_name != null" class="px-2 py-2 whitespace-nowrap text-sm text-gray-500">
        {{ transaction.court_first_name }} {{ transaction.court_last_name }}
    </td>
    <td v-else class="px-2 py-2 whitespace-nowrap text-sm text-gray-500">
        TARA G!
    </td>
    <td class="px-2 py-2 whitespace-nowrap text-sm font-semibold text-gray-500 hover:scale-105 hover:text-blue-800">
            <button @click="$emit('transaction', transaction)">{{ transaction.reference_no }}</button>
    </td>
</template>
    
<style scoped>

</style>