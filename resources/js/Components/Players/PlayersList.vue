<script setup>
import PlayerCard from '../../Components/Players/PlayerCard.vue'
import Paginator from '../../Components/Paginator.vue'
import Nodata from '@/Components/NoData.vue'
import { defineProps } from "vue";

defineProps({
    players: Object
})

</script>

<template>
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-sm">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Name
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Details
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    G! Coin
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Player ID
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="player in players.data" :key="player.id">
                                <PlayerCard :player="player" />
                            </tr>
                        </tbody>
                    </table>
                    <Nodata v-if="players.total == 0" />
                </div>
            </div>
        </div>
        <div class="flex justify-end mt-2">
            <Paginator :links="players.links" />
        </div>
    </div>
</template>

<style scoped>

</style>