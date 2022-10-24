<script setup>
    import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
    import { Head } from "@inertiajs/inertia-vue3";
    import { defineProps } from 'vue';
    import CourtProfile from '@/Components/CourtOwners/CourtProfile.vue'
    
    defineProps({
        court: Object,
    })
    
    </script>
        
    <template>
    
        <Head title="Court Info" />
    
        <BreezeAuthenticatedLayout>
            <template #header>
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Court Information
                </h2>
            </template>
            <div class="mt-5">
                <CourtProfile :court="court" />
            </div>
    
        </BreezeAuthenticatedLayout>
    </template>