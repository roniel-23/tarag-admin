<script setup>
import { Doughnut } from 'vue-chartjs'
import {
    Chart as ChartJS, Title, Tooltip, Legend, ArcElement, CategoryScale
} from 'chart.js'
import { defineProps } from "vue";

ChartJS.register(Title, Tooltip, Legend, ArcElement, CategoryScale)

const props = defineProps({
    chartId: {
      type: String,
      default: 'doughnut-chart'
    },
    width: {
      type: Number,
      default: 350
    },
    height: {
      type: Number,
      default: 350
    },
    cssClasses: {
      default: '',
      type: String
    },
    styles: {
        type: Object,
        default: () => { }
    },
    plugins: {
        type: Object,
        default: () => { }
    },
    chartData: {
        type: Object,
        required: true
    },
    chartOptions: {
        type: Object,
        default: () => { }
    }
})


</script>

<template>
    <Doughnut :chart-options="chartOptions" :chart-data="chartData" :chart-id="chartId"
        :plugins="plugins" :css-classes="cssClasses" :styles="styles" :width="width" :height="height" />
</template>