<script setup>

</script>

<template>
    <div class="container container-bg py-10 text-white">
        <div class="container max-w-7xl mx-auto px-2">
            <h2 class="text-3xl font-bold mb-5">How to be a <span class="text-orange-500"> G! Player</span>?</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 justify-between  gap-2 md:gap-4">
                <div class="img-01 border p-4 rounded-xl bg-gray-900/90">
                    <h3 class="text-xl font-semibold mb-2">Download Tara G!</h3>
                    <p class="text-center">We won't be going too far if won't download Tara G!. Hit on download now!</p>
                </div>
                <div class="img-02 border p-4 rounded-xl bg-gray-900/90">
                    <h3 class="text-xl font-semibold mb-2">Register as G! Player</h3>
                    <p class="text-center">Get us some time, fill up the form and you're ready to go!</p>
                </div>
                <div class="img-03 border p-4 rounded-xl bg-gray-900/90">
                    <h3 class="text-xl font-semibold mb-2">Get verified</h3>
                    <p class="text-center">Yes, you'll be waiting for us to verify your account. Worry not, it will be on in a flash!</p>
                </div>
                <div class="img-04 border p-4 rounded-xl bg-gray-900/90">
                    <h3 class="text-xl font-semibold mb-2">Join a game near you!</h3>
                    <p class="text-center">That's it! Join teams to play or create your own room and reserve a court near you!</p>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.container-bg {
    background-image: linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0,0.8)), url(../../../../storage/images/how_banner.jpg);
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
.img-01, .img-02, .img-03, .img-04 {
    background-size:contain;
    background-repeat: no-repeat;
    background-blend-mode: overlay;
    background-position: right;
}
</style>