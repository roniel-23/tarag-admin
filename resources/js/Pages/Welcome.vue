<script setup>
import GuestLayout from '../Layouts/Guest.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import SubscribeLayout from '../Components/Home_Components/Subscribe.vue'
import FooterLayout from '../Components/Navigation/Footer.vue'
import RegisterPlayerLayout from '../Components/Home_Components/RegisterPlayer.vue'
import RegisterCourtLayout from '../Components/Home_Components/RegisterCourt.vue'
import CheckAppLayout from '../Components/Home_Components/CheckApp.vue'

defineProps({
    page: Object
})
</script>

<template>



    <!-- <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
        <div v-if="canLogin" class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</Link>

            <template v-else>
                <Link :href="route('login')" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</Link>

                <Link v-if="canRegister" :href="route('register')" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</Link>
            </template>
        </div>
    </div> -->

    <GuestLayout>

        <Head title="Welcome" />

        <div class="container-banner container flex items-center">
            <div
                class="max-w-7xl mx-auto sm:px-6 text-center lg:px-8 md:text-start grid md:grid-cols-2 gap-10 items-center text-white">
                <div class="order-last md:order-first">
                    <h1 class="text-3xl lg:text-6xl">Welcome to <span class="text-orange-500 font-bold">TARA G!</span>
                    </h1>
                    <p>Experience a new league of basketball! Tara G! where you can create your own team, join and
                        reserve the available court where you want to play.</p>
                    <div class="mt-5 items-end">
                        <a href="download/apk">
                            <button class="py-2 px-7 bg-green-700 rounded hover:bg-green-500">Download App</button>
                        </a>
                        <img type="button" class="h-16 cursor-pointer mx-auto md:mx-0"
                            src="../../../storage/images/playstore.png" alt="Play Store">
                    </div>
                </div>
                <div class="w-2/3 mx-auto md:w-full">
                    <img src="../../../storage/images/ball_cover.png" alt="cover">
                </div>
            </div>
        </div>

        <div class="p-2 container text-white">
            <div class="grid lg:grid-cols-3 gap-2">
                <div class="grid grid-rows-2 grid-flow-col bg-blue-500 p-3">
                    <div class="row-span-2">
                        <img class="h-20" src="../../../storage/images/play-game.png" alt="Play Game">
                    </div>
                    <div class="col-span-2">
                        <h3 class="text-2xl font-bold px-10">G! Player</h3>
                    </div>
                    <div class="row-span-1 col-span-2 px-10">
                        <p>Be a G! Player an join teams to play.</p>
                    </div>
                </div>
                <div class="grid grid-rows-2 grid-flow-col bg-green-500 p-3">
                    <div class="row-span-2">
                        <img class="h-20" src="../../../storage/images/select-court.png" alt="Play Game">
                    </div>
                    <div class="col-span-2">
                        <h3 class="text-2xl font-bold px-10">Court Owner</h3>
                    </div>
                    <div class="row-span-1 col-span-2 px-10">
                        <p>Schedule your Court for G! Players to play and EARN.</p>
                    </div>
                </div>
                <div class="grid grid-rows-2 grid-flow-col bg-red-500 p-3">
                    <div class="row-span-2">
                        <img class="h-20" src="../../../storage/images/create-room.png" alt="Play Game">
                    </div>
                    <div class="col-span-2 px-10">
                        <h3 class="text-2xl font-bold">Rooms</h3>
                    </div>
                    <div class="row-span-1 col-span-2 px-10">
                        <p>Create rooms and invite other G! Players to join you.</p>
                    </div>
                </div>
            </div>
        </div>
        <CheckAppLayout :page="page" />
        <RegisterPlayerLayout />
        <div class="container h-1 bg-gradient-to-l from-blue-700 to-red-700"></div>
        <RegisterCourtLayout />
        <SubscribeLayout />
        <FooterLayout />

    </GuestLayout>
</template>

<style scoped>
.container-banner {
    min-height: 80vh;
    background-image: linear-gradient(rgba(4, 9, 30, 0.7), rgba(4, 9, 30, 0.7)), url(../../../storage/images/back_banner_2.jpg);
    background-size: cover;
}
</style>
