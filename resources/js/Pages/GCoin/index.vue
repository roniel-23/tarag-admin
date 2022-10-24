<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import NoData from "@/Components/NoData.vue";
import Swal from 'sweetalert2';
import TransactionCard from '@/Components/GCoin/TransactionCard.vue'
import ReceiptModal from '@/Components/GCoin/ReceiptModal.vue'
import { Head, useForm } from "@inertiajs/inertia-vue3";
import { defineProps, ref, watch, onMounted, onUpdated } from "vue";
import { useUserNameGetterStore } from '@/Stores/UserNameGetterStore'
import { storeToRefs } from "pinia";
import { Inertia } from "@inertiajs/inertia";
import DoughnutGraph from '@/Components/DoughnutGraph.vue'

const { user, loading, error } = storeToRefs(useUserNameGetterStore());
const { fetchUserName } = useUserNameGetterStore();

let event = ref('');
let filter = ref(null);
let date_to = ref(null);
let date_from = ref(null);
const chartData = ref({});
let modalTransaction = ref({});
let showReceipt = ref(false);
let amountValue = ref([
    100, 250, 500, 1000
])

const props = defineProps({
    transactions: Object,
    players_total_gcoin: String,
    courts_total_gcoin: String,
    gcoin: Object,
    auth: Object
})

const form = useForm({
    userID: '',
    amount: '',
    adminID: ''
});

form.adminID = props.auth.user.id

function showModalTransaction(transaction){
    showReceipt.value = true;
    modalTransaction.value = transaction;
    // console.log(transaction);
}

function showPlayerInfoView() {
    fetchUserName(form.userID)
}

function changeValue(value) {
    form.amount = value
}
function reset() {
    form.userID = ''
    form.amount = ''
    fetchUserName(0)
}

function getGraphData() {
    chartData.value = {
        labels: ['Players', 'Court Owners', 'Tara G!'],
        datasets: [
            {
                label: 'Players',
                backgroundColor: ['#0047b3', '#00b300', '#ff751a'],
                data: [props.players_total_gcoin, props.courts_total_gcoin, props.gcoin.gcoin]
            },
        ]
    }
}

const chartOptions = {
    responsive: true
}

onMounted(() => {
    getGraphData()
})

onUpdated(() => {
    getGraphData()
})

const submit = () => {
    Swal.fire({
        title: ` ${form.amount} G! Coin will be sent?`,
        icon: 'info',
        showCancelButton: true,
        confirmButtonText: 'Yes, Send G! Coin'
    }).then((result) => {
        if (result.isConfirmed) {
            form.post(route('gcointransaction.sendtoplayer'));
            Swal.fire('Success', '', 'success');
            reset();
        }
    })
};

watch([event, filter, date_from, date_to], ([event_value, filter_value, date_from_value, date_to_value]) => {
    Inertia.get('/gcointransaction', { event: event_value, filter: filter_value, date_from: date_from_value, date_to: date_to_value }, {
        preserveState: true,
        replace: true,
        preserveScroll: true,
    });
});

</script>
        
<template>

    <Head title="G! Coin" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                G! Coin Transaction
            </h2>
        </template>
        <div class="flex justify-around gap-3 my-3 items-center">
            <div class="grid gap-5 text-white w-72">
                <div class="bg-blue-800 py-4 shadow-lg border-gray-100 border-2 rounded-lg">
                    <div class="text-center text-2xl font-bold">
                        {{ players_total_gcoin }}.00
                    </div>
                    <div class="text-center text-xs uppercase">Players Total G! Coin</div>
                </div>
                <div class="bg-green-600 py-4 shadow-lg border-gray-100 border-2 rounded-lg">
                    <div class="text-center text-2xl font-bold">
                        {{ courts_total_gcoin }}.00
                    </div>
                    <div class="text-center text-xs uppercase">Courts Total G! Coin</div>
                </div>
                <div class="bg-orange-500 py-4 shadow-lg border-gray-100 border-2 rounded-lg">
                    <div class="text-center text-2xl font-bold">
                        {{ gcoin.gcoin }}.00
                    </div>
                    <div class="text-center text-xs uppercase">System G! Coin</div>
                </div>
                <div class="bg-red-600 py-4 shadow-lg border-gray-100 border-2 rounded-lg">
                    <div class="text-center text-2xl font-bold">
                        {{ gcoin.gcoin_payback }}
                    </div>
                    <div class="text-center text-xs uppercase">Payback</div>
                </div>
            </div>
            <div class="bg-white rounded-b-lg h-full shadow-lg p-3 w-96">
                <div class="font-semibold border-b pb-2">
                    <i class="text-blue-500 fa-solid fa-chart-pie mr-1"></i>
                    GCoin Specification
                </div>
                <div class="py-3 ">
                    <DoughnutGraph :chartData="chartData" :chartOptions="chartOptions" />
                </div>
            </div>
            <div class="w-96">
                <div class="text-xl font-semibold bg-white p-2 rounded-t-lg shadow-lg">
                    Send G! Coin
                </div>
                <div class="text-start mt-2 rounded-b-lg p-4 bg-white shadow-lg">
                    <div>
                        <div class="border border-gray-200 p-4 pt-2">
                            <div class="h-10 mb-4">
                                <div v-if="!user" class="text-center gap-3 border-b">
                                    <div v-if="error">
                                        <small class="text-gray-500">No user available in this user ID.</small>
                                    </div>
                                    <div v-else>
                                        <small class="text-gray-500">Player information will be shown here. <br>
                                            Type
                                            the user ID and click validate below.</small>
                                    </div>
                                </div>
                                <div v-if="user" class="flex justify-center items-center gap-3 border-b pb-2">

                                    <img class="h-10 shadow-lg rounded-lg"
                                        :src="$imageURL+'/uploads/'+user.photo.split(',')[0]">
                                    <div class="text-xl font-bold">{{ user.first_name }} {{ user.last_name }}</div>
                                </div>
                            </div>
                            <form @submit.prevent="submit">
                                <div class="grid gap-5 content-end">
                                    <div class="grid justify-center">
                                        <label for="userID" class="text-xs text-gray-900 mb-1">USER ID</label>
                                        <input v-model="form.userID"
                                            class="rounded-full border-gray-500 text-center w-60 font-bold"
                                            type="number" name="userID" placeholder="Player User ID" :disabled="user"
                                            required>
                                    </div>
                                    <div class="grid justify-center">
                                        <label for="amount" class="text-xs text-gray-900 mb-1">AMOUNT</label>
                                        <input v-model="form.amount" class="rounded-full text-center w-60 font-bold"
                                            type="number" name="amount" placeholder="Input Amount" step="5" required
                                            :disabled="!user">
                                    </div>
                                    <div class="grid grid-cols-4 gap-2 text-white font-semibold text-center mt-2">
                                        <p v-if="user" v-for="value in amountValue" :key="value.id"
                                            @click="changeValue(value)"
                                            class="cursor-pointer bg-amber-500 rounded-lg ring-2 ring-gray-300 hover:ring-blue-900">
                                            {{ value }}
                                        </p>
                                    </div>
                                    <div class="grid grid-cols-2 gap-2 text-white mt-2">
                                        <div v-if="!user" @click="showPlayerInfoView"
                                            class="cursor-pointer bg-blue-900 rounded-full uppercase text-center py-1 hover:scale-110">
                                            <small>Validate</small>
                                        </div>
                                        <button v-if="user"
                                            class="bg-blue-900 rounded-full uppercase py-1 hover:scale-110"
                                            :disabled="form.processing">
                                            <small>Send G! Coin</small>
                                        </button>
                                        <button @click="reset"
                                            class="bg-red-700 rounded-full uppercase py-1 shadow-lg hover:scale-110">
                                            <small>Clear</small>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="text-end">
                        <small class="text-xs text-gray-500 italic">*Note: Please Clear Input before editing the
                            User
                            ID.</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="fixed-div-height bg-white px-2 pt-5">
            <div class="flex justify-between items-center">
                <div class="text-xl uppercase font-bold">
                    Transaction History
                </div>
                <div class="flex gap-3 font-semibold text-gray-700 items-center">
                    <fieldset class="border border-gray-300 p-2 rounded-lg bg-stone-50/75">
                        <legend class="flex text-xs text-blue-800 items-center">
                            <div>
                                date range
                            </div>
                            <button v-if="date_from != null" @click="{date_from = null; date_to = null}"
                                class="rounded-full ml-1 px-1 text-white bg-red-500">
                                clear
                            </button>
                        </legend>
                        <div class="flex gap-1">
                            <div class="flex items-center gap-1">
                                <label for="from" class="text-sm text-gray-500">from:</label>
                                <div class="relative">
                                    <input name="from" type="date" date_topicker="" date_topicker-autohide=""
                                        v-model="date_from"
                                        class="bg-gray-50 border border-gray-300 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-full pl-3 p-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </div>
                            </div>

                            <div class="flex items-center gap-1">
                                <label for="to" class="text-sm text-gray-500">to: </label>
                                <div class="relative">
                                    <input name="to" type="date" date_topicker="" date_topicker-autohide=""
                                        v-model="date_to"
                                        class="bg-gray-50 border border-gray-300 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-full pl-3 p-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="border border-gray-300 p-2 rounded-lg bg-stone-50/75">
                        <legend class="text-xs text-blue-800">
                            search and events
                        </legend>
                        <div class="flex gap-1">
                            <div class="flex justify-between gap-2 items-center">
                                <div class="relative">
                                    <div
                                        class="inline-flex items-center justify-center absolute left-0 top-0 h-full w-10 text-gray-600">
                                        <i class="fa-solid fa-search"></i>
                                    </div>
                                    <input type="search" name="search" v-model="filter"
                                        class="bg-gray-50 text-sm placeholder-gray-400 pl-10 pr-4 rounded-xl border border-gray-300 block w-full py-1 focus:outline-none"
                                        placeholder="search..." />
                                </div>
                            </div>

                            <div class="w-40">
                                <select id="transaction" v-model="event" placeholder="Select Transaction"
                                    class="bg-gray-50 border border-gray-300 text-sm text-gray-600 rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-full p-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected="" value="">All Transaction</option>
                                    <option value="Payment">Payment</option>
                                    <option value="Transfer">G! Coin Transfer</option>
                                    <option value="leave">Players Leave</option>
                                </select>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
            <div class="flex flex-col block my-2">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="fixed-table-height overflow-y-auto">
                            <table class="w-full text-center">
                                <thead class="border-b bg-gray-900 sticky top-0">
                                    <tr class="text-xs font-medium text-white">
                                        <th scope="col" class="px-6 py-2">
                                            DATE
                                        </th>
                                        <th scope="col" class="px-6 py-2">
                                            TRANSACTION TYPE
                                        </th>
                                        <th scope="col" class="px-6 py-2">
                                            AMOUNT
                                        </th>
                                        <th scope="col" class="px-6 py-2">
                                            SENDER
                                        </th>
                                        <th scope="col" class="px-6 py-2">
                                            RECEIVED BY
                                        </th>
                                        <th scope="col" class="px-6 py-2">
                                            REFERENCE NUMBER
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="bg-white border-b text-sm" v-for="transaction in transactions"
                                        :key="transaction.id">
                                        <TransactionCard :transaction="transaction" @transaction="showModalTransaction(transaction)" />
                                    </tr>
                                </tbody>
                            </table>
                            <div v-if="!transactions.length" class="flex justify-center">
                                <NoData />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <ReceiptModal v-show="showReceipt" :transaction="modalTransaction" @close="showReceipt = false" />
    </BreezeAuthenticatedLayout>
</template>

<style scoped>
.fixed-table-height {
    height: 80vh;
}

.fixed-div-height {
    height: 100vh;
}
</style>
