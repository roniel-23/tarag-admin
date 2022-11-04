<script setup>
import { ref } from 'vue';
import BreezeApplicationLogo from '@/Components/ApplicationLogo.vue';
import BreezeResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/inertia-vue3';

const showingNavigationDropdown = ref(false);

</script>
    
<template>
    <nav class="bg-white border-b border-gray-100 w-64 h-screen fixed">
        <!-- Primary Navigation Menu -->
        <div class="">
            <div class="flex justify-between  py-2 pl-3">
                <!-- Logo -->
                <div class="shrink-0">
                    <Link class="flex items-center gap-3" :href="route('dashboard')">
                    <BreezeApplicationLogo class="block h-9 w-auto" />
                    <h2 class="text-xl font-bold">TARA G!</h2>
                    </Link>
                </div>
                <!-- Hamburger -->
                <div class="flex items-center sm:hidden">
                    <button @click="showingNavigationDropdown = ! showingNavigationDropdown"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path
                                :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path
                                :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

            </div>

            <div class="h-1 bg-gradient-to-l from-blue-500 to-amber-500"></div>

            <!-- Navigation Links -->
            <div class="hidden md:block">
                <div>
                    <div class="pt-2 pb-3 space-y-1">
                        <BreezeResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                            <i class="w-8 fa-solid fa-gauge"></i>
                            Dashboard
                        </BreezeResponsiveNavLink>
                    </div>
                    <div class="pt-2 pb-3 space-y-1">
                        <BreezeResponsiveNavLink :href="route('players')" :active="route().current('players')">
                            <i class="w-8 fa-solid fa-users-rectangle"></i>
                            G! Players
                        </BreezeResponsiveNavLink>
                    </div>
                    <div class="pt-2 pb-3 space-y-1">
                        <BreezeResponsiveNavLink :href="route('courts')" :active="route().current('courts')">
                            <i class="w-8 fa-solid fa-user-tie"></i>
                            Court Owner
                        </BreezeResponsiveNavLink>
                    </div>
                    <!-- <div class="pt-2 pb-3 space-y-1">
                        <BreezeResponsiveNavLink :href="route('aboutus')" :active="route().current('aboutus')">
                            <i class="w-8 fa-solid fa-chalkboard-user"></i>
                            Game Master
                        </BreezeResponsiveNavLink>
                    </div> -->
                    <div class="pt-2 pb-3 space-y-1">
                        <BreezeResponsiveNavLink :href="route('rooms')" :active="route().current('rooms')">
                            <i class="w-8 fa-solid fa-chalkboard-user"></i>
                            Rooms
                        </BreezeResponsiveNavLink>
                    </div>
                    <div class="pt-2 pb-3 space-y-1">
                        <BreezeResponsiveNavLink :href="route('gcointransaction')" :active="route().current('gcointransaction')">
                            <i class="w-8 fa-solid fa-coins"></i>
                            G! Coin
                        </BreezeResponsiveNavLink>
                    </div>
                    <div class="pt-2 pb-3 space-y-1">
                        <BreezeResponsiveNavLink :href="route('location')" :active="route().current('location')">
                            <i class="w-8 fa-solid fa-location-dot"></i>
                            Location
                        </BreezeResponsiveNavLink>
                    </div>
                    <div class="pt-2 pb-3 space-y-1">
                        <BreezeResponsiveNavLink :href="route('settings')" :active="route().current('settings')">
                            <i class="w-8 fa-solid fa-gears"></i>
                            Settings
                        </BreezeResponsiveNavLink>
                    </div>
                </div>

                <!-- Responsive Settings Options -->

                <div class="absolute bottom-0 pb-1 border-t border-gray-200 w-full">
                    <div class="px-4">
                        <div class="font-medium text-base text-gray-800">{{ $page.props.auth.user.name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <BreezeResponsiveNavLink :href="route('logout')" method="post" as="button">
                            Log Out
                        </BreezeResponsiveNavLink>
                    </div>
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <!-- <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
                <BreezeResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                    Dashboard
                </BreezeResponsiveNavLink>
            </div>

            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ $page.props.auth.user.name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <BreezeResponsiveNavLink :href="route('logout')" method="post" as="button">
                        Log Out
                    </BreezeResponsiveNavLink>
                </div>
            </div>
        </div> -->
    </nav>


</template>