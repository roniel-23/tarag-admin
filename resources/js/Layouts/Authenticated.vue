<script setup>
import NavigationAdmin from '../Components/Navigation/NavigationAdmin.vue'
import Logo from '@/Components/ApplicationLogo.vue'

</script>

<template>
    <div>
        <div class="lg:hidden">
            <div class="h-screen grid justify-center text-center place-content-center">
                <Logo class="w-40 mx-auto m-2" />
                <h2 class="text-amber-500 text-4xl font-bold">TARA G!</h2>
                <p class="text-gray-600 mt-5">Sorry for the inconvenience. <br> Admin page is not available on mobile
                    view.</p>

                <div class="h-1 bg-gradient-to-r from-blue-500 to-amber-500 mt-5"></div>
            </div>
        </div>

        <div class="hidden lg:block">
            <NavigationAdmin />
            <div class="ml-64 min-h-screen bg-gray-100">
                <!-- Page Heading -->
                <header class="bg-white shadow" v-if="$slots.header">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <slot name="header" />
                    </div>
                </header>

                <!-- Page Content -->
                <main class="max-w-6xl mx-auto">
                    <slot />
                </main>
            </div>
        </div>
    </div>
</template>

