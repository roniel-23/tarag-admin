<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import BreezeButton from '@/Components/Button.vue'
import PlayersList from "@/Components/Players/PlayersList.vue";
import Spinner from '@/Components/Spinner.vue'
import { Head } from "@inertiajs/inertia-vue3";
import { defineProps, ref, watch } from "vue";
import { Link } from '@inertiajs/inertia-vue3';
import {Inertia} from "@inertiajs/inertia";
import { usePlayersCountStore } from '@/Stores/PlayersCountStore'
import { storeToRefs } from "pinia";

const { count, loading, error } = storeToRefs(usePlayersCountStore());
const { fetchPlayersCount } = usePlayersCountStore();

fetchPlayersCount();

const props = defineProps({
    players: Object,
    filter: String
})
let search = ref(props.filter);

// console.log(props.filter)

watch(search, value => {
  Inertia.get('/players', { search: value }, {
    preserveState: true,
    replace: true
  });
});

</script>

<template>

    <Head title="Players" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <div class="grid grid-cols-2 justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    G! Players
                </h2>
                <div v-if="loading">
                    <Spinner />
                </div>
                <div v-if="error">
                    {{ error.message }}
                </div>
                <div v-if="count" class="flex justify-around">
                    <div>
                        <span class="text-xl font-bold">{{ count.all_players }}</span>
                        <span class="text-xs text-gray-500"> Total Players</span>
                    </div>
                    <div>
                        <span class="text-xl font-bold">{{ count.verified_players }}</span>
                        <span class="text-xs text-gray-500"> Verified Players</span>
                    </div>
                    <div>
                        <span class="text-xl font-bold">{{ count.unverified_players }}</span>
                        <span class="text-xs text-gray-500"> Unverified Players</span>
                    </div>

                </div>
            </div>

        </template>

        <div class="flex justify-between my-2 items-center font-semibold">
            <div class="grid grid-cols-3 gap-2 text-sm font-semibold text-white text-center items-center">
                <Link :href="route('players')">
                    <BreezeButton class="justify-center w-full">PLAYERS</BreezeButton>
                </Link>
                <Link :href="route('players.verified')">
                    <BreezeButton class="justify-center w-full">VERIFIED PLAYERS</BreezeButton>
                </Link>
                <Link :href="route('players.unverified')">
                    <BreezeButton class="justify-center w-full">UNVERIFIED PLAYERS</BreezeButton>
                </Link>
            </div>
            <div class="flex justify-between gap-2 items-center">
                <div class="relative">
                    <div
                        class="inline-flex items-center justify-center absolute left-0 top-0 h-full w-10 text-gray-600">
                        <i class="fa-solid fa-search"></i>
                    </div>

                    <input v-model="search" type="search" name="search"
                        class="text-sm placeholder-gray-400 pl-10 pr-4 rounded-full border border-gray-400 w-full py-2 focus:outline-none"
                        placeholder="Search..." />
                </div>
            </div>
        </div>
        <PlayersList :players="props.players" />

    </BreezeAuthenticatedLayout>
</template>