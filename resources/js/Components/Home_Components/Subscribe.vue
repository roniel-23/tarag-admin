<script setup>

</script>

<template>
    <div class="container bg-black text-white pt-7 pb-5 px-2">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-x-20">
            <div>
                <h3 class="text-4xl font-semibold">About Us</h3>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-center my-4 px-4 py-3">
                    <div class="order-last md:order-first md:col-span-3 text-center">
                        <p>Don't know what to do whenever you are near Don't know what to say, my heart is floating in
                            tears
                            When you pass by, I could fly!</p>
                        <br>
                        <p>- Lawrence -</p>
                    </div>
                    <div class="md:col-span-1">
                        <img class="rounded-full border-4 border-white mx-auto w-40 md:w-full"
                            src="../../../../storage/images/bruss.jpg"
                            alt="Lawrence Baylon">
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-center my-4 px-4 py-3">
                    <div class="order-last md:order-first md:col-span-3 text-center">
                        <p>I wanna spend the rest of my life With you by my side Forever and ever Every little thing
                            that you do Baby, I'm amazed by you</p>
                        <br>
                        <h4>- Giovanne -</h4>
                    </div>
                    <div class="col-span-1">
                        <img class="rounded-full border-4 border-white mx-auto w-40 md:w-full"
                            src="../../../../storage/images/gio.jpg"
                            alt="Giovanne">
                    </div>
                </div>
            </div>
            <div>
                <p class="text-2xl italic">We would like to hear from you!</p>
                <form>
                    <div class="mt-4">
                        <label for="name">Name</label>
                        <input class="w-full rounded-xl text-black" type="text" name="name" placeholder="Enter name" required>
                    </div>
                    <div class="mt-4">
                        <label for="email">Email Adress</label>
                        <input class="w-full rounded-xl text-black" type="email" name="email" placeholder="Enter email" required>
                    </div>
                    <div class="mt-4">
                        <label for="message">
                            Message
                        </label>
                        <textarea class="w-full rounded-xl text-black" name="message" cols="30" rows="5" placeholder="Type your message here."></textarea>
                    </div>
                    <div class="mt-4">
                        <button class="w-full bg-green-500 rounded-xl py-2 hover:bg-green-700" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</template>

<style scoped>
</style>