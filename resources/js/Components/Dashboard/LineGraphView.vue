<script setup>
import { Line } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, LineElement, LinearScale, PointElement, CategoryScale } from 'chart.js'
import { defineProps } from "vue";

ChartJS.register(Title, Tooltip, Legend, LineElement, LinearScale, PointElement, CategoryScale)


const props = defineProps({
    chartId: {
      type: String,
      default: 'line-chart'
    },
    width: {
      type: Number,
      default: 400
    },
    height: {
      type: Number,
      default: 100
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
    <Line :chart-options="chartOptions" :chart-data="chartData" :chart-id="chartId"
        :plugins="plugins" :css-classes="cssClasses" :styles="styles" :width="width" :height="height" />
</template>