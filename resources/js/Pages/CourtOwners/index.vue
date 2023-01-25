<script setup>
    import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
    import BreezeButton from '@/Components/Button.vue'
    import CourtsList from "@/Components/CourtOwners/CourtsList.vue";
    import Spinner from '@/Components/Spinner.vue'
    import { Head } from "@inertiajs/inertia-vue3";
    import { defineProps, ref, watch } from "vue";
    import { Link } from '@inertiajs/inertia-vue3';
    import {Inertia} from "@inertiajs/inertia";
    import { useCourtsCountStore } from '@/Stores/CourtsCountStore'
    import { storeToRefs } from "pinia";
    
    const { count, loading, error } = storeToRefs(useCourtsCountStore());
    const { fetchCourtsCount } = useCourtsCountStore();
    
    fetchCourtsCount();
    
    const props = defineProps({
        courts: Object,
        filter: String
    })
    let search = ref(props.filter);
    
    // console.log(props.filter)
    
    watch(search, value => {
      Inertia.get('/courtowners', { search: value }, {
        preserveState: true,
        replace: true
      });
    });
    
    </script>
    
    <template>
    
        <Head title="Court Owners" />
    
        <BreezeAuthenticatedLayout>
            <template #header>
                <div class="grid grid-cols-2 justify-between">
                    <h2 class="text-xl font-semibold leading-tight text-gray-800">
                        Court Owners
                    </h2>
                    <div v-if="loading">
                        <Spinner />
                    </div>
                    <div v-if="error">
                        {{ error.message }}
                    </div>
                    <div v-if="count" class="flex justify-around">
                        <div>
                            <span class="text-xl font-bold">{{ count.all_courts }}</span>
                            <span class="text-xs text-gray-500"> Total Courts</span>
                        </div>
                        <div>
                            <span class="text-xl font-bold">{{ count.verified_courts }}</span>
                            <span class="text-xs text-gray-500"> Verified Courts</span>
                        </div>
                        <div>
                            <span class="text-xl font-bold">{{ count.unverified_courts }}</span>
                            <span class="text-xs text-gray-500"> Unverified Courts</span>
                        </div>
    
                    </div>
                </div>
    
            </template>
    
            <div class="flex justify-between my-2 items-center font-semibold">
                <div class="grid grid-cols-4 gap-2 text-sm font-semibold text-white text-center items-center">
                    <Link :href="route('courts')">
                        <BreezeButton class="justify-center w-full">COURTS</BreezeButton>
                    </Link>
                    <Link :href="route('courts.verified')">
                        <BreezeButton class="justify-center w-full">VERIFIED COURTS</BreezeButton>
                    </Link>
                    <Link :href="route('courts.unverified')">
                        <BreezeButton class="justify-center w-full">UNVERIFIED COURTS</BreezeButton>
                    </Link>
                    <Link :href="route('courts.bin')"
                        class="w-fit bg-gray-800 px-4 py-1.5 rounded-lg border border-gray-800 hover:bg-gray-700">
                        <button class="justify-center">
                            <i class="fa-solid fa-trash"></i> 
                        </button>
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
            <CourtsList :courts="props.courts" />
    
        </BreezeAuthenticatedLayout>
    </template>