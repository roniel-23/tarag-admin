<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import RoomCard from '@/Components/Rooms/RoomCard.vue'
import RoomInformation from "@/Components/Rooms/RoomInformation.vue";
import NoData from "@/Components/NoData.vue";
import Paginator from "@/Components/Paginator.vue";
import { Head } from "@inertiajs/inertia-vue3";
import { defineProps, ref, watch } from "vue";
import { Inertia } from "@inertiajs/inertia";

const componentKey = ref(0);

const props = defineProps({
    rooms: Object,
    filter: String
})
let search = ref(props.filter);
let roomInfo = ref(Object);
let showInfo = ref(false);
let show = ref(false)

// console.log(props.filter)
function showInformation(room) {
    showInfo.value = true
    componentKey.value += 1;
    roomInfo.value = room
}

watch(search, value => {
    Inertia.get('/rooms', { search: value }, {
        preserveState: true,
        replace: true
    });
});

</script>
    
<template>

    <Head title="Rooms" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Rooms
            </h2>
        </template>

        <div class="flex justify-between my-2 items-center font-semibold">

        </div>
        <div class="flex justify-between">
            <div class="w-1/3">
                <div class="items-center">
                    <div class="relative">
                        <div
                            class="inline-flex items-center justify-center absolute left-0 top-0 h-full w-10 text-gray-600">
                            <i class="fa-solid fa-search"></i>
                        </div>

                        <input v-model="search" type="search" name="search"
                            class="text-sm placeholder-gray-400 pl-10 pr-4 rounded-full border border-gray-400 w-full py-2 focus:outline-none"
                            placeholder="Search rooms..." />
                    </div>
                </div>
                <div class="text-start mt-3 border rounded-lg p-2 bg-white shadow-lg">
                    <div class="text-xl font-semibold border-b pb-2">
                        Court Information
                    </div>
                    <NoData v-show="!showInfo" />
                    <RoomInformation :roomInfo="roomInfo" v-if="showInfo" :key="componentKey" />
                </div>
            </div>
            <div class="w-2/3 pl-2 ml-2 border-l">
                <div class="grid grid-cols-2 gap-3">
                    <div class="rounded-lg text-white border-x border-b hover:ring-4"
                        v-for="(room, index) in rooms.data" :key="index">
                        <div class="rounded-t-lg bg-gray-800 p-2">
                            <div class="flex justify-between px-4 text-base text-center items-center">
                                <div>
                                    {{ room.id }}
                                </div>
                                <div>
                                    {{ room.room_title }}
                                </div>
                                <div class="text-xs">
                                    {{ room.game_time }}:00 {{ room.game_date }}
                                </div>
                            </div>
                        </div>
                        <RoomCard :room="room" />
                        <div class="flex justify-start my-2 ml-1">
                            <button @click="showInformation(room)"
                                class="text-xs uppercase bg-green-500 rounded-full px-3 m-1 hover:ring">
                                <small>Show info</small>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end mt-2">
                    <Paginator :links="rooms.links" />
                </div>
            </div>


        </div>
        <!-- <CourtsList :courts="props.courts" /> -->

    </BreezeAuthenticatedLayout>
</template>