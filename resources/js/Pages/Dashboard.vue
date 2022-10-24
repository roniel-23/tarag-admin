<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import { defineProps, ref, onMounted, watch } from "vue";
import { Inertia } from "@inertiajs/inertia";
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import PlayersView from '@/Components/Dashboard/PlayersView.vue';
import CourtOwnersView from '@/Components/Dashboard/CourtOwnersView.vue';
import RoomsView from '@/Components/Dashboard/RoomsView.vue'
import BarGraph from '@/Components/Dashboard/BarGraphView.vue'
import LineGraph from '@/Components/Dashboard/LineGraphView.vue'

const props = defineProps({
    players: Object,
    court_owners: Object,
    rooms: Object,
    gcoin: Object,
    players_count: Number,
    courts_count: Number,
    rooms_count: Number,
    player_graph: Object,
    player_month_graph: Object,
    court_graph: Object,
    court_month_graph: Object,
    player_years: Object,
    court_years: Object,
    court_year: Number,
    year: Number
})
const courtGraph = ref([])
const courtLabelMonths = ref([])
const courtLabelData = ref([])
const courtChartData = ref({})

const courtMonthGraph = ref([])
const courtLabelDays = ref([])
const courtLabelThisData = ref([])
const courtChartMonthData = ref([])

const graph = ref([])
const labelMonths = ref([])
const labelData = ref([])
const chartData = ref({})

const monthGraph = ref([])
const labelDays = ref([])
const labelThisData = ref([])
const chartMonthData = ref([])

let filterYear = ref(props.year)
let filterCourtYear = ref(props.court_year)
// props.all_years[0].year

function getCourtGraphData() {
    courtGraph.value = [];
    props.court_graph.forEach(month => {
        for (let key in month) {
            courtGraph.value.push(month[key]);
        }
    });
    courtLabelData.value = courtGraph.value.filter(e => typeof e === 'number');
    courtLabelMonths.value = courtGraph.value.filter(e => typeof e === 'string');
    courtChartData.value = {
        labels: courtLabelMonths.value,
        datasets: [
            {
                label: 'Court Owner',
                backgroundColor: '#00e600',
                data: courtLabelData.value
            },
        ]
    }
}

function getCourtMonthGraphData() {
    courtMonthGraph.value = [];
    props.court_month_graph.forEach(month => {
        for (let key in month) {
            courtMonthGraph.value.push(month[key]);
        }
    });
    courtLabelThisData.value = courtMonthGraph.value.filter(e => typeof e === 'number');
    courtLabelDays.value = courtMonthGraph.value.filter(e => typeof e === 'string');
    courtChartMonthData.value = {
        labels: courtLabelDays.value,
        datasets: [
            {
                label: 'Court Owner',
                backgroundColor: '#00e600',
                data: courtLabelThisData.value
            },
        ]
    }
}

function getGraphData() {
    graph.value = [];
    props.player_graph.forEach(month => {
        for (let key in month) {
            graph.value.push(month[key]);
        }
    });
    labelData.value = graph.value.filter(e => typeof e === 'number');
    labelMonths.value = graph.value.filter(e => typeof e === 'string');
    chartData.value = {
        labels: labelMonths.value,
        datasets: [
            {
                label: 'Players',
                backgroundColor: '#0047b3',
                data: labelData.value
            },
        ]
    }
}

function getMonthGraphData() {
    monthGraph.value = [];
    props.player_month_graph.forEach(month => {
        for (let key in month) {
            monthGraph.value.push(month[key]);
        }
    });
    labelThisData.value = monthGraph.value.filter(e => typeof e === 'number');
    labelDays.value = monthGraph.value.filter(e => typeof e === 'string');
    chartMonthData.value = {
        labels: labelDays.value,
        datasets: [
            {
                label: 'Players',
                backgroundColor: '#0047b3',
                data: labelThisData.value
            },
        ]
    }
}

onMounted(() => {
    getGraphData()
    getMonthGraphData()
    getCourtGraphData()
    getCourtMonthGraphData()
})


const chartOptions = {
    responsive: true
}

watch([filterYear, filterCourtYear], ([year_value, court_value]) => {
    Inertia.get('/dashboard', { year: year_value, court_year: court_value}, {
        preserveState: true,
        replace: true,
        preserveScroll: true,
        onSuccess: () => {getGraphData(); getCourtGraphData()}
    });
});

</script>

<template>

    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <!-- <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        This is hello {{ $page.props.auth.user.name }}
                    </div>
                </div>
            </div>
        </div> -->

        <div class="fixed-height no-scrollbar max-w-7xl mx-auto overflow-auto">
            <div class="grid grid-cols-4 gap-4 text-white my-3 mx-2">
                <div class="bg-blue-500 p-2 text-white shadow-md hover:scale-105">
                    <div class="border-b">
                        <i class="fa-solid text-2xl fa-chalkboard-user bg-gray-100/20 p-3"></i>
                        <p class="text-base mt-3">Rooms Due Today</p>
                        <p class="text-4xl font-semibold">{{ rooms_count }}</p>
                    </div>
                    <div class="flex justify-end items-center">
                        <button class="text-xs mt-2 hover:scale-110">
                            <Link :href="route('rooms')">
                            See all rooms
                            <i class="fa-solid fa-arrow-right ml-2"></i>
                            </Link>
                        </button>
                    </div>
                </div>
                <div class="bg-white p-2 text-gray-300 shadow-md hover:scale-105">
                    <div class="border-b">
                        <i class="text-blue-500 fa-solid text-2xl fa-users-rectangle bg-gray-50 p-3"></i>
                        <p class="text-base mt-3 text-gray-500">Total G! Players</p>
                        <p class="text-4xl font-semibold text-black">{{ players_count }}</p>
                    </div>
                    <div class="flex justify-end items-center">
                        <button class="text-xs mt-2 hover:scale-110 hover:text-blue-400">
                            <Link :href="route('players')">
                            See all players
                            <i class="fa-solid fa-arrow-right ml-2"></i>
                            </Link>
                        </button>
                    </div>
                </div>
                <div class="bg-white p-2 text-gray-300 shadow-md hover:scale-105">
                    <div class="border-b">
                        <i class="text-green-400 fa-solid text-2xl fa-user-tie bg-gray-50 p-3 px-4"></i>
                        <p class="text-base mt-3 text-gray-500">Total G! Court Owners</p>
                        <p class="text-4xl font-semibold text-black">{{ courts_count }}</p>
                    </div>
                    <div class="flex justify-end items-center">
                        <button class="text-xs mt-2 hover:scale-110 hover:text-blue-400">
                            <Link :href="route('courts')">
                            See all court owners
                            <i class="fa-solid fa-arrow-right ml-2"></i>
                            </Link>
                        </button>
                    </div>
                </div>
                <div class="bg-white p-2 text-gray-300 shadow-md hover:scale-105">
                    <div class="border-b">
                        <i class="text-orange-500 fa-solid text-2xl fa-coins bg-gray-50 p-3 px-4"></i>
                        <p class="text-base mt-3 text-gray-500">System G! Coin</p>
                        <p class="text-4xl font-semibold text-black">{{ gcoin.gcoin }}.00</p>
                    </div>
                    <div class="flex justify-end items-center">
                        <button class="text-xs mt-2 hover:scale-110 hover:text-blue-400">
                            <Link :href="route('gcointransaction')">
                            Go to G! Coin transactions
                            <i class="fa-solid fa-arrow-right ml-2"></i>
                            </Link>
                        </button>
                    </div>
                </div>
            </div>

            <!-- players -->
            <div class="grid grid-cols-3 gap-4">
                <div class="col-span-2">
                    <div class="bg-white shadow-lg p-3">
                        <div class="flex justify-between text-gray-700">
                            <div class="font-semibold">
                                <i class="text-blue-500 fa-solid fa-chart-simple mr-1"></i>
                                Total Players per Month
                            </div>
                            <div class="flex items-center">
                                <div class="mr-1 font-semibold text-lg">
                                    <small>Year:</small>
                                </div>
                                <select id="year" v-model="filterYear"
                                    class="bg-gray-50 border border-gray-300 text-sm text-gray-600 rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option v-if="props.year.length == 0" :value="props.player_years[0].year">{{ props.player_years[0].year }}</option>
                                    <option v-for="year in player_years" :value="year.year" selected="">{{year.year}}
                                    </option>
                                </select>
                            </div>

                        </div>
                        <BarGraph :chartData="chartData" :chartOptions="chartOptions" />
                    </div>
                    <div class="bg-white shadow-lg p-3 mt-3">
                        <div class="font-semibold">
                            <i class="text-blue-500 fa-solid fa-chart-line mr-1"></i>
                            Total Players per Day
                        </div>
                        <LineGraph :chartData="chartMonthData" :chartOptions="chartOptions" />
                    </div>
                </div>
                <div class="rounded">
                    <PlayersView :players="players" />
                </div>
            </div>

            <!-- court owners -->
            <div class="grid grid-cols-3 gap-4 my-3">
                <div class="col-span-2">
                    <div class="bg-white shadow-lg p-3">
                        <div class="flex justify-between text-gray-700">
                            <div class="font-semibold">
                                <i class="text-green-500 fa-solid fa-chart-simple mr-1"></i>
                                Total Court Owners per Month
                            </div>
                            <div class="flex items-center">
                                <div class="mr-1 font-semibold text-lg">
                                    <small>Year:</small>
                                </div>
                                <select id="year" v-model="filterCourtYear"
                                    class="bg-gray-50 border border-gray-300 text-sm text-gray-600 rounded-md focus:ring-green-500 focus:border-green-500 block w-full py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500">
                                    <option v-if="court_year.length == 0" :value="court_years[0].year">{{ court_years[0].year }}</option>
                                    <option v-for="year in court_years" :value="year.year" selected="">{{year.year}}
                                    </option>
                                </select>
                            </div>

                        </div>
                        <BarGraph :chartData="courtChartData" :chartOptions="chartOptions" />
                    </div>
                    <div class="bg-white shadow-lg p-3 mt-3">
                        <div class="font-semibold">
                            <i class="text-green-500 fa-solid fa-chart-line mr-1"></i>
                            Total Court Owners per Day
                        </div>
                        <LineGraph :chartData="courtChartMonthData" :chartOptions="chartOptions" />
                    </div>
                </div>
                <div class="rounded">
                    <CourtOwnersView :court_owners="court_owners" />
                </div>
            </div>

            <!-- <div class="grid grid-cols-3 gap-5 mt-2">

                <div class="rounded">
                    <RoomsView :rooms="rooms" />
                </div>

                <div class="rounded">
                    <PlayersView :players="players" />
                </div>

                <div class="rounded">
                    <CourtOwnersView :court_owners="court_owners" />
                </div>
            </div> -->
        </div>
    </BreezeAuthenticatedLayout>
</template>

<style scoped>
.fixed-height {
    height: 90vh;
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

