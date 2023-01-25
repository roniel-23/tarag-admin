<script setup>
import { ref } from 'vue'
const props = defineProps({
    id: String
})

const degree = ref(0)
const scale = ref(0)

function rotateImageClockWise() {
    degree.value = degree.value + 90;
    var myImage = document.getElementById("myImage");
    myImage.style.transform = 'rotate(' + degree.value + 'deg)';
}

function zoomInImage() {
    scale.value = scale.value + 1;
    var myImage = document.getElementById("myImage");
    myImage.style.transform = 'rotate(' + degree.value + 'deg)';
    myImage.style.transform = 'scale(' + scale.value + ')';
}

function zoomOutImage() {
    scale.value = scale.value - 1;
    var myImage = document.getElementById("myImage");
    myImage.style.transform = 'rotate(' + degree.value + 'deg)';
    myImage.style.transform = 'scale(' + scale.value + ')';
}

</script>

<template>
    <div class="relative z-10" aria-labelledby="full_id" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-black bg-opacity-95 transition-opacity"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="fixed top-0 right-0">
                <button @click="$emit('close')"><i class="m-5 fa-solid fa-xmark text-white"></i></button>
            </div>
            <div class="flex min-h-full justify-center">
                <div class="h-screen">
                    <div class="flex items-center">
                        <img id="myImage" class="h-screen" :src="id" alt="Submitted ID">
                    </div>
                </div>
            </div>
            <div class="fixed bottom-0 left-1/2 mb-5 text-white">
                <div class="flex gap-4">
                    <button @click="zoomOutImage"><i class="fa-solid fa-magnifying-glass-minus"></i></button>
                    <button @click="zoomInImage"><i class="fa-solid fa-magnifying-glass-plus"></i></button>
                    <button @click="rotateImageClockWise"><i class="fa-solid fa-rotate"></i></button>
                </div>
            </div>
        </div>
    </div>
</template>