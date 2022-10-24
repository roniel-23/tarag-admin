<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head } from "@inertiajs/inertia-vue3";
import { defineProps } from 'vue';
import PlayerProfile from "@/Components/Players/PlayerProfile.vue";

defineProps({
    player: Object,
})

</script>
    
<template>

    <Head title="Player Info" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Player Information
            </h2>
        </template>
        <div class="mt-5">
            <PlayerProfile :player="player" />
        </div>

    </BreezeAuthenticatedLayout>
</template>