<script setup>

defineProps({
    page: Object
})
</script>

<template>
    <div class="container py-10 bg-gradient-to-l from-blue-700 to-red-700">
        <div class="container max-w-7xl mx-auto text-center text-white">
            <h3 class="text-2xl md:text-5xl font-semibold mb-8">Check out our Mobile App</h3>
            <div class="grid md:grid-cols-3 items-center">
                <div class="md:col-span-2 flex flex-row justify-center gap-1 items-end">
                    <img class="h-40 md:h-80" src="../../../../storage/images/tara.png" alt="tarag phone">
                    <img class="h-60 md:h-96" src="../../../../storage/images/front.png" alt="tarag phone">
                    <img class="h-40 md:h-80" src="../../../../storage/images/courts.png" alt="tarag phone">
                </div>
                <div class="mt-8">
                    <p class="px-8 text-xl md:px-0">
                        {{ page.app_description }}
                    </p>
                </div>
            </div>


        </div>
    </div>

</template>

<style scoped>
</style>