<script setup>
import { ref } from 'vue';
import NoData from '@/Components/NoData.vue';

const active = ref(true);

</script>

<template>
    <div class="grid grid-cols-2 text-center text-white font-bold text-xs">
        <div @click="active=!active" :class="active ? 'bg-gray-900': 'bg-white text-gray-900'"
            class="border border-gray-900 py-2 cursor-pointer hover:bg-gray-900 hover:text-white">
            CAREER STATS
        </div>
        <div @click="active=!active" :class="!active ? 'bg-gray-900': 'bg-white text-gray-900'"
            class="border border-gray-900 py-2 cursor-pointer hover:bg-gray-900 hover:text-white">
            GAME LOG
        </div>
    </div>
    <div v-if="active" class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full text-center">
                        <thead class="border-b bg-gray-900">
                            <tr class="text-xs font-medium text-white">
                                <th scope="col" class="px-6 py-2">
                                    YEAR
                                </th>
                                <th scope="col" class="px-6 py-2">
                                    PTS
                                </th>
                                <th scope="col" class="px-6 py-2">
                                    REB
                                </th>
                                <th scope="col" class="px-6 py-2">
                                    AST
                                </th>
                                <th scope="col" class="px-6 py-2">
                                    BLK
                                </th>
                                <th scope="col" class="px-6 py-2">
                                    STL
                                </th>
                                <th scope="col" class="px-6 py-2">
                                    FLS
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white border-b">
                                <!-- <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">1</td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            Mark
                                        </td> -->
                            </tr>
                        </tbody>
                    </table>
                    <NoData />
                </div>
            </div>
        </div>
    </div>
    <div v-if="!active" class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full text-center">
                        <thead class="border-b bg-gray-900">
                            <tr class="text-xs font-medium text-white">
                                <th scope="col" class="px-6 py-2">
                                    DATE
                                </th>
                                <th scope="col" class="px-6 py-2">
                                    PTS
                                </th>
                                <th scope="col" class="px-6 py-2">
                                    REB
                                </th>
                                <th scope="col" class="px-6 py-2">
                                    AST
                                </th>
                                <th scope="col" class="px-6 py-2">
                                    BLK
                                </th>
                                <th scope="col" class="px-6 py-2">
                                    STL
                                </th>
                                <th scope="col" class="px-6 py-2">
                                    FLS
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    <NoData />
                </div>
            </div>
        </div>
    </div>

</template>

<style scoped>

</style>