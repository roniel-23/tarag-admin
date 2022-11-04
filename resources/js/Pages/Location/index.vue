<script setup>
import { Head, useForm } from "@inertiajs/inertia-vue3";
import { defineProps, ref, watch } from "vue";
import { Inertia } from "@inertiajs/inertia";
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import NoData from "@/Components/NoData.vue";
import Swal from 'sweetalert2';

const props = defineProps({
    provinces: Object,
    municipalities: Object,
    barangays: Object
})

let selectedProvince = ref(null);
let selectedMunicipality = ref(null);
let showAddProvince = ref(false);
let showAddMunicipality = ref(false);
let showAddBarangay = ref(false);
let provinceToAdd = ref('');

const municipalityForm = useForm({
    province_id: '',
    name: '',
});

const barangayForm = useForm({
    province_id: '',
    municipality_id: '',
    name: '',
});

function addProvince() {
    if (provinceToAdd.value.length != 0) {
        Inertia.post('/location/add/province', { province: provinceToAdd.value },
            {
                onSuccess: () => { provinceToAdd.value = ''; showAddProvince.value = false; }
            });
    }
}

function deleteProvince(id) {
    Swal.fire({
        title: 'Are you sure you want to delete?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Confirm'
    }).then((result) => {
        if (result.isConfirmed) {
            Inertia.post('/location/delete/province', { province_id: id });
            Swal.fire('Success', '', 'success');
        }
    })
}

async function updateProvince(province) {
    const {value: name} = await Swal.fire({
        title: 'Edit Province Name',
        input: 'text',
        inputValue: province.name,
        showCancelButton: true,
        inputValidator: (value) => {
            if (!value) {
                return 'Please write correct province!'
            }
        }
    })
    if (name) {
        Inertia.post('/location/edit/province', { id: province.id, name: name },
        { 
            onSuccess: () => { Swal.fire('Success', '', 'success'); } 
        }
        );
    }
}

function addMunicipality() {
    if (selectedProvince.value.id > 0) {
        municipalityForm.province_id = selectedProvince.value.id;
        municipalityForm.post(route('location.add.municipality'),
            {
                preserveState: true,
                replace: true,
                onSuccess: () => { municipalityForm.name = ''; showAddMunicipality.value = false; }
            });
    }
}

function deleteMunicipality(id) {
    Swal.fire({
        title: 'Are you sure you want to delete?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Confirm'
    }).then((result) => {
        if (result.isConfirmed) {
            Inertia.post('/location/delete/municipality', { municipality_id: id },
                {
                    onSuccess: () => { selectedMunicipality.value = null; }
                });
            Swal.fire('Success', '', 'success');
        }
    })
}

async function updateMunicipality(municipality) {
    const {value: name} = await Swal.fire({
        title: 'Edit Municipality Name',
        input: 'text',
        inputValue: municipality.name,
        showCancelButton: true,
        inputValidator: (value) => {
            if (!value) {
                return 'Please write correct municipality!'
            }
        }
    })
    if (name) {
        Inertia.post('/location/edit/municipality', { id: municipality.id, name: name },
        { 
            onSuccess: () => { Swal.fire('Success', '', 'success'); } 
        }
        );
    }
}

function addBarangay() {
    if (selectedMunicipality.value.id > 0) {
        barangayForm.province_id = selectedProvince.value.id;
        barangayForm.municipality_id = selectedMunicipality.value.id;
        barangayForm.post(route('location.add.barangay'),
            {
                preserveState: true,
                replace: true,
                onSuccess: () => { barangayForm.name = ''; showAddBarangay.value = false; }
            });
    }
}

function deleteBarangay(id) {
    Swal.fire({
        title: 'Are you sure you want to delete?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Confirm'
    }).then((result) => {
        if (result.isConfirmed) {
            Inertia.post('/location/delete/barangay', { barangay_id: id });
            Swal.fire('Success', '', 'success');
        }
    })
}

async function updateBarangay(barangay) {
    const {value: name} = await Swal.fire({
        title: 'Edit Barangay Name',
        input: 'text',
        inputValue: barangay.name,
        showCancelButton: true,
        inputValidator: (value) => {
            if (!value) {
                return 'Please write correct municipality!'
            }
        }
    })
    if (name) {
        Inertia.post('/location/edit/barangay', { id: barangay.id, name: name },
        { 
            onSuccess: () => { Swal.fire('Success', '', 'success'); } 
        }
        );
    }
}

watch([selectedProvince, selectedMunicipality], ([province_value, municipality_value]) => {
    Inertia.get('/location', { selectedProvince: province_value.id, selectedMunicipality: municipality_value }, {
        preserveState: true,
        replace: true
    });
});

</script>
    
<template>

    <Head title="Location" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Locations
            </h2>
        </template>

        <div class="max-w-7xl px-8 my-5 pb-5 bg-white">
            <div class="grid grid-cols-3 justify-between gap-5">

                <!-- province -->
                <div class="mt-5 px-2 rounded-lg shadow-lg bg-white">
                    <div
                        class="flex justify-between py-2 pl-2 mt-2 bg-gradient-to-l from-blue-500/10 to-amber-500/10 rounded-lg border-x border-blue-500 items-center">
                        <h3 class="text-blue-700 text-lg font-semibold">
                            Province<span v-if="selectedProvince != null">:
                                <span class="text-red-500 font-bold underline"> {{ selectedProvince.name }}</span>
                            </span>
                        </h3>
                        <i @click="showAddProvince = !showAddProvince"
                            :class="showAddProvince ? 'fa-xmark text-red-500' : 'fa-plus hover:text-green-500'"
                            class="fa-solid mr-2 text-blue-600 cursor-pointer hover:scale-125"></i>
                    </div>

                    <div class="px-3 my-3">
                        <div v-if="showAddProvince" class="flex items-center">
                            <input v-model="provinceToAdd" type="text" placeholder="Add province..."
                                class="p-1.5 w-full font-medium text-left border-blue-500 rounded-y-lg rounded-l-lg my-1 placeholder-gray-400">
                            <button @click="addProvince"
                                class="p-1.5 text-white rounded-r-lg border-y border-r border-green-500 bg-green-500">
                                <i class="px-1 fa-solid fa-check hover:scale-125"></i>
                            </button>
                        </div>
                        <div class="p-2 py-1.5 w-full font-medium text-left border border-blue-500 bg-blue-500 text-white rounded my-1 hover:bg-blue-50 hover:text-blue-700"
                            v-for="province in provinces" :key="provinces.id">
                            <div class="flex justify-between items-center">
                                <button @click="selectedProvince = province, selectedMunicipality = null">
                                    {{ province.name }}
                                </button>
                                <div class="flex gap-1">
                                    <button @click="updateProvince(province)">
                                        <i class="fa-solid fa-edit hover:scale-125 hover:text-green-500"></i>
                                    </button>
                                    <button @click="deleteProvince(province.id)">
                                        <i class="fa-solid fa-trash hover:scale-125 hover:text-red-500"></i>
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


                <!-- municipality -->
                <div class="mt-5 px-2 rounded-lg shadow-lg bg-white">
                    <div
                        class="flex justify-between py-2 pl-2 mt-2 bg-gradient-to-l from-blue-500/10 to-amber-500/10 rounded-lg border-x border-blue-500 items-center">
                        <h3 class="text-blue-700 text-lg font-semibold">
                            Municipality<span v-if="selectedMunicipality != null">:
                                <span class="text-red-500 font-bold underline"> {{ selectedMunicipality.name
                                }}</span>
                            </span>
                        </h3>
                        <i v-if="selectedProvince" @click="showAddMunicipality = !showAddMunicipality"
                            :class="showAddMunicipality ? 'fa-xmark text-red-500' : 'fa-plus hover:text-green-500'"
                            class="fa-solid mr-2 text-blue-600 cursor-pointer hover:scale-125"></i>
                    </div>

                    <div class="px-3 my-3">
                        <div v-if="showAddMunicipality" class="flex items-center">
                            <input v-model="municipalityForm.name" type="text" placeholder="Add municipality..."
                                class="p-1.5 w-full font-medium text-left border-blue-500 rounded-y-lg rounded-l-lg my-1 placeholder-gray-400">
                            <button @click="addMunicipality"
                                class="p-1.5 text-white rounded-r-lg border-y border-r border-green-500 bg-green-500">
                                <i class="px-1 fa-solid fa-check hover:scale-125"></i>
                            </button>
                        </div>
                        <p v-if="municipalities.length == 0" class="italic text-center text-gray-500 text-sm mt-3">
                            <NoData />
                        </p>

                        <div class="p-2 py-1.5 w-full font-medium text-left border border-blue-500 bg-blue-500 text-white rounded my-1 hover:bg-blue-50 hover:text-blue-700"
                            v-for="municipality in municipalities" :key="municipality.id">
                            <div class="flex justify-between items-center">
                                <button @click="selectedMunicipality = municipality">
                                    {{ municipality.name }}
                                </button>
                                <div class="flex gap-1">
                                    <button @click="updateMunicipality(municipality)">
                                        <i class="fa-solid fa-edit hover:scale-125 hover:text-green-500"></i>
                                    </button>
                                    <button @click="deleteMunicipality(municipality.id)">
                                    <i class="px-1 fa-solid fa-trash hover:scale-125 hover:text-red-500"></i>
                                </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- barangay -->
                <div class="mt-5 px-2 rounded-lg shadow-lg bg-white">
                    <div
                        class="flex justify-between py-2 pl-2 mt-2 bg-gradient-to-l from-blue-500/10 to-amber-500/10 rounded-lg border-x border-blue-500 items-center">
                        <h3 class="text-blue-700 text-lg font-semibold">
                            Barangay
                        </h3>
                        <i v-if="selectedMunicipality" @click="showAddBarangay = !showAddBarangay"
                            :class="showAddBarangay ? 'fa-xmark text-red-500' : 'fa-plus hover:text-green-500'"
                            class="fa-solid mr-2 text-blue-600 cursor-pointer hover:scale-125"></i>
                    </div>

                    <div class="px-3 my-3">
                        <div v-if="showAddBarangay && selectedMunicipality" class="flex items-center">
                            <input v-model="barangayForm.name" type="text" placeholder="Add barangay..."
                                class="p-1.5 w-full font-medium text-left border-blue-500 rounded-y-lg rounded-l-lg my-1 placeholder-gray-400">
                            <button @click="addBarangay"
                                class="p-1.5 text-white rounded-r-lg border-y border-r border-green-500 bg-green-500">
                                <i class="px-1 fa-solid fa-check hover:scale-125"></i>
                            </button>
                        </div>
                        <p v-if="barangays.length == 0" class="italic text-center text-gray-500 text-sm mt-3">
                            <NoData />
                        </p>

                        <div class="p-2 py-1.5 w-full font-medium text-left border border-blue-500 bg-blue-500 text-white rounded my-1 hover:bg-blue-50 hover:text-blue-700"
                            v-for="barangay in barangays" :key="barangay.id">
                            <div class="flex justify-between items-center">
                                <p>
                                    {{ barangay.name }}
                                </p>
                                <div class="flex gap-1">
                                    <button @click="updateBarangay(barangay)">
                                        <i class="fa-solid fa-edit hover:scale-125 hover:text-green-500"></i>
                                    </button>
                                    <button @click="deleteBarangay(barangay.id)">
                                    <i class="px-1 fa-solid fa-trash hover:scale-125 hover:text-red-500"></i>
                                </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>