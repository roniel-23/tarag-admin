<script setup>
    import { Link } from '@inertiajs/inertia-vue3';
    import { defineProps } from "vue";

    defineProps({
        links: Array
    })
</script>

<template>
    <div>
      <Component
        :is="link.url ? Link : 'span'"
        v-for="link in links"
        :href="link.url"
        v-html="link.label"
        class="px-3 py-1 border text-sm"
        :class="{ 'text-gray-500': ! link.url, 'font-bold bg-blue-500 text-white' : link.active, 'hover:bg-blue-300' : ! link.active}"
      />
    </div>

  </template>