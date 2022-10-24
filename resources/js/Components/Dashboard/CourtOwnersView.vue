<script setup>
import ApplicationLogo from '../ApplicationLogo.vue';
import { defineProps } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';

defineProps({
    court_owners: Object
})
</script>

<template>

    <div class="p-2 border-b rounded-t bg-white">
        <div class="text-lg font-semibold text-blue-900">
            Recent Court Owners
        </div>
    </div>
    <div class="no-scrollbar fixed-height grid gap-1 px-1 overflow-auto">
        <div v-for="court_owner in court_owners" :key="court_owner.key"
            class="fixed-height-below w-full rounded-lg text-gray-500 flex items-center shadow-lg px-3 py-1 mt-2 bg-white">
            <div>
                <img class="object-contain w-12 h-12 rounded-full  border-2 border-white shadow-lg mx-auto"
                :src="$imageURL+'/uploads/'+court_owner.court_images.split(',')[0]" alt="player">
            </div>
            <div class="ml-3">
                <h3 class="text-xl font-semibold text-blue-700">
                    <Link :href="route('court.show', { user_id: court_owner.user_id })">
                        {{ court_owner.court_name }}
                    </Link>
                </h3>
                <div class="text-base"><small>{{ court_owner.first_name }} {{ court_owner.last_name }}<span class="text-lg text-gray-200 mx-1">|</span>{{ court_owner.contact_number }}</small></div>
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