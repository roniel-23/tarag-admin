<script setup>

</script>

<template>
    <div class="container container-bg py-10 px-2 text-white">
        <div class="container max-w-7xl mx-auto">
            <h2 class="text-3xl font-bold mb-5">Register your court to <span class="text-orange-500">EARN</span>!</h2>
            <div class="grid grid-rols-1 md:grid-cols-3 justify-between gap-2 md:gap-4">
                <div class="img-01 border p-4 rounded-xl bg-gray-900/70">
                    <h3 class="text-xl font-semibold mb-2">Download Tara G!</h3>
                    <p>Let's begin by downloading TARA G!. Click the link above.</p>
                </div>
                <div class="img-02 border p-4 rounded-xl bg-gray-900/70">
                    <h3 class="text-xl font-semibold mb-2">Register as Court Owner</h3>
                    <p>Write down you information and register as a court owner.</p>
                </div>
                <div class="img-03 border p-4 rounded-xl bg-gray-900/70">
                    <h3 class="text-xl font-semibold mb-2">Setup your Account</h3>
                    <p>Please do put your court information as well the address for easy access of your location.</p>
                </div>
                <div class="img-04 border p-4 rounded-xl bg-gray-900/70">
                    <h3 class="text-xl font-semibold mb-2">Get Verified</h3>
                    <p>Submit a valid ID and wait for your account to get verified.</p>
                </div>
                <div class="img-05 border p-4 rounded-xl bg-gray-900/70">
                    <h3 class="text-xl font-semibold mb-2">Set Court Schedule</h3>
                    <p>Put your court availability and submit to make your court available to players.</p>
                </div>
                <div class="img-06 border p-4 rounded-xl bg-gray-900/70">
                    <h3 class="text-xl font-semibold mb-2">Wait for your Earning!</h3>
                    <p>Here is the best part! Wait for your court to be scheduled and take your EARNING.</p>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.container-bg {
    background-image: linear-gradient(rgba(0, 0, 0, 0.8), rgb(0, 0, 0)), url(../../../../storage/images/how_banner_court.jpg);
    background-size: cover;
}
.img-01{
    background-image: url(../../../../storage/images/01.png);
}
.img-02{
    background-image: url(../../../../storage/images/02.png);
}
.img-03{
    background-image: url(../../../../storage/images/03.png);
}
.img-04{
    background-image: url(../../../../storage/images/04.png);
}
.img-05{
    background-image: url(../../../../storage/images/05.png);
}
.img-06{
    background-image: url(../../../../storage/images/06.png);
}
.img-01, .img-02, .img-03, .img-04, .img-05, .img-06 {
    background-size:contain;
    background-repeat: no-repeat;
    background-blend-mode: overlay;
    background-position: right;
}
</style>