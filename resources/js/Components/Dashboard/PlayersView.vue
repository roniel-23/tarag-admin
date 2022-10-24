<script setup>
import ApplicationLogo from '../ApplicationLogo.vue';
import { defineProps } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';

defineProps({
    players: Object
})
</script>

<template>

    <div class="p-2 border-b rounded-t bg-white">
        <div class="text-lg font-semibold text-blue-900">
            Recent Players
        </div>
    </div>
    <div class="no-scrollbar fixed-height grid gap-1 px-1 overflow-auto">
        <div v-for="player in players" :key="player.id"
            class="fixed-height-below rounded-lg text-gray-500 flex items-center shadow-lg px-3 py-1 mt-2 bg-white">
            <div>
                <img class="object-contain w-12 h-12 rounded-full  border-2 border-white shadow-lg mx-auto"
                :src="$imageURL+'/uploads/'+player.photo">
            </div>
            <div class="ml-3">
                <h3 class="text-lg font-semibold text-blue-700">
                    <Link :href="route('player.show', { user_id: player.user_id })">
                    {{ player.first_name }} {{ player.last_name }}
                    </Link>
                </h3>
                <div class="text-base"><small>{{ player.position }} <span class="text-lg text-gray-200 mx-1">|</span> {{
                player.code_name }}</small></div>
            </div>
        </div>
    </div>

</template>

<style scoped>
.fixed-height {
    height: 55vh;
}

.fixed-height-below {
    height: 5rem;
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
