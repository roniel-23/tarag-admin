<script setup>
import { defineProps, ref } from "vue";
import { Link } from '@inertiajs/inertia-vue3';
import Swal from 'sweetalert2';
import { Inertia } from "@inertiajs/inertia";

const court_data = defineProps({
    court: Object,
})

const deleteValue = ref(court_data.court.delete);

function deleteCourt() {
    Swal.fire({
        title: 'Move this court to trash?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, move to trash'
    }).then((result) => {
        if (result.isConfirmed) {
            Inertia.post(`/courtowner/delete/${court_data.court.user_id}`)
            location.reload()
        }
    })
}

function permanentDeleteCourt() {
    Swal.fire({
        title: 'Are you sure you want to permanently delete this court?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, Delete Court'
    }).then((result) => {
        if (result.isConfirmed) {
            Inertia.post(`/courtowner/delete/permanent/${court_data.court.user_id}`)
            location.reload()
        }
    })
}

function recoverCourt() {
    Swal.fire({
        title: 'Are you sure you want to recover this court?',
        icon: 'info',
        showCancelButton: true,
        confirmButtonText: 'Yes, recover'
    }).then((result) => {
        if (result.isConfirmed) {
            Inertia.post(`/courtowner/recover/${court_data.court.user_id}`)
            location.reload()
        }
    })
}
</script>
    
<template>

    <td class="px-6 py-2 whitespace-nowrap">
        <div class="flex items-center">
            <div class="flex-shrink-0 h-10 w-10">
                <img class="object-contain w-10 h-10 rounded-full border-4"
                    :class="court_data.court.verified == 1 ? 'border-blue-700' : 'border-gray-300'"
                    :src="$imageURL+'/uploads/'+court_data.court.court_images.split(',')[0]">
            </div>
            <div class="ml-4 text-base">
                <div v-if="deleteValue == 0" class="font-semibold text-gray-900">
                    <Link :href="route('court.show', { user_id: court_data.court.user_id })">
                    {{ court_data.court.court_name }}
                    </Link>
                </div>
                <div v-else-if="deleteValue == 1" class="font-semibold text-gray-900">
                    {{ court_data.court.court_name }}
                </div>
            </div>
        </div>
    </td>
    <td class="px-6 py-2 whitespace-nowrap">
        <div>
            <div class="font-semibold text-sm text-gray-900">
                {{ court_data.court.first_name }} {{ court_data.court.last_name }}
            </div>
            <div class="text-sm text-gray-500">
                {{ court_data.court.gender }}
            </div>
        </div>
    </td>
    <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500">
        {{ court_data.court.gcoin }}.00
    </td>
    <td class="px-6 py-2 whitespace-nowrap">
        <div class="bg-green-400 text-center">
            <span class="text-md rounded-full font-semibold cursor-pointer text-white">
                {{ court_data.court.user_id }}
            </span>
        </div>
    </td>
    <td v-if="deleteValue == 0" class="whitespace-nowrap flex items-center align-center mt-4 gap-4">
        <Link :href="route('court.show', { user_id: court_data.court.user_id })">
        <i class="fa-solid fa-eye text-blue-600 hover:text-blue-500 cursor-pointer shadow-md transition hover:scale-110"></i>
        </Link>
        <i @click="deleteCourt" class="fa-solid fa-trash text-red-600 hover:text-red-500 cursor-pointer shadow-md transition hover:scale-110"></i>
    </td>
    <td v-else-if="deleteValue == 1" class="whitespace-nowrap flex items-center align-center mt-4 gap-4">
        <i @click="recoverCourt" class="fa-solid fa-trash-can-arrow-up text-blue-600 hover:text-blue-500 cursor-pointer shadow-md transition hover:scale-110"></i>
        <i @click="permanentDeleteCourt" class="fa-solid fa-trash text-red-600 hover:text-red-500 cursor-pointer shadow-md transition hover:scale-110"></i>
    </td>

</template>
    
<style scoped>

</style>