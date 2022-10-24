<script setup>
import { ref } from 'vue';
import BreezeApplicationLogo from '@/Components/ApplicationLogo.vue';
import BreezeNavLink from '@/Components/NavLink.vue';
import BreezeResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import BreezeButton from '@/Components/Button.vue'
import { Link } from '@inertiajs/inertia-vue3';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <nav class="sticky top-0 bg-slate-200/50 border-b border-gray-100">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <!-- Logo -->

                    <div class="shrink-0 flex items-center">
                        <Link :href="route('guest')">
                        <BreezeApplicationLogo class="block h-9 w-auto" />
                        </Link>
                        <!-- <h2 class="text-2xl ml-2 text-gray-700 font-semibold">Tara G!</h2> -->
                    </div>
                    <h1 class="text-2xl font-bold ml-3">TARA G!</h1>
                </div>

                <!-- Navigation Links -->
                <div class="flex">


                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <BreezeNavLink :href="route('guest')" :active="route().current('guest')">
                            Home
                        </BreezeNavLink>
                    </div>
                    <!-- <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <BreezeNavLink>
                            News
                        </BreezeNavLink>
                    </div>
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <BreezeNavLink>
                            Download
                        </BreezeNavLink>
                    </div> -->

                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <BreezeNavLink>
                            |
                        </BreezeNavLink>
                    </div>
                    <div v-if="$page.props.auth.user" class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <BreezeNavLink :href="route('dashboard')">
                            <BreezeButton>
                                    Dashboard
                                </BreezeButton>
                        </BreezeNavLink>
                    </div>

                    <div v-else class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">

                            <BreezeNavLink :href="route('login')" :active="route().current('login')">
                                    Log in
                            </BreezeNavLink>
                        <!-- <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <BreezeNavLink :href="route('register')">
                                <BreezeButton>
                                    Register
                                </BreezeButton>
                            </BreezeNavLink>
                        </div> -->
                    </div>

                </div>


                <!-- Hamburger -->
                <!-- <div class="-mr-2 flex items-center sm:hidden">
                    <button @click="showingNavigationDropdown = !showingNavigationDropdown"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path
                                :class="{ 'hidden': showingNavigationDropdown, 'inline-flex': !showingNavigationDropdown }"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path
                                :class="{ 'hidden': !showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div> -->
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <!-- <div :class="{ 'block': showingNavigationDropdown, 'hidden': !showingNavigationDropdown }" class="sm:hidden"> -->
            <!-- <div class="pt-2 pb-3 space-y-1">
                <BreezeResponsiveNavLink :href="route('guest')" :active="route().current('guest')">
                    Home
                </BreezeResponsiveNavLink>
            </div>
            <div class="pt-2 pb-3 space-y-1">
                <BreezeResponsiveNavLink>
                    News
                </BreezeResponsiveNavLink>
            </div>
            <div class="pt-2 pb-3 space-y-1">
                <BreezeResponsiveNavLink>
                    Download
                </BreezeResponsiveNavLink>
            </div> -->

            <!-- Responsive Settings Options -->
            <!-- <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="pt-2 pb-3 space-y-1">
                    <BreezeResponsiveNavLink :href="route('login')" :active="route().current('login')">
                        Login
                    </BreezeResponsiveNavLink>
                </div>
                <div class="pt-2 pb-3 space-y-1">
                    <BreezeResponsiveNavLink :href="route('register')" :active="route().current('register')">
                        Register
                    </BreezeResponsiveNavLink>
                </div>

            </div> -->
        <!-- </div> -->
    </nav>


</template>

<style scoped>

</style>