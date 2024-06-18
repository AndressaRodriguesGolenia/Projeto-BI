<template>
  <div>
    <Bar :data="chartVendaHeatmapData" :options="chartOptions" />
  </div>
</template>

<script>
import { Bar } from 'vue-chartjs';
import { Chart, registerables } from 'chart.js';
import ChartDataLabels from 'chartjs-plugin-datalabels';

Chart.register(...registerables, ChartDataLabels);

export default {
  name: 'HeatmapChart',
  components: {
    Bar
  },
  props: {
    data: {
      type: Array,
      required: true
    }
  },
  computed: {
    chartVendaHeatmapData() {
      const labels = this.data.map(item => item.dayOfMonth);
      const counts = this.data.map(item => item.totalSales);
      const backgroundcolors = this.data.map(() => '#' + Math.floor(Math.random() * 16777215).toString(16));

      return {
        labels,
        datasets: [
          {
            label:"Vendas por dia da Semana",
            data: counts,
            backgroundColor: backgroundcolors          
          }
        ]
      };
    },
    chartOptions() {
      return {
        plugins: {
          datalabels: {
            color: '#fff',
            anchor: 'end',
            align: 'start',
            offset: -10,
            borderRadius: 4,
            backgroundColor: (context) => context.dataset.backgroundColor,
            formatter: (value) => value.toFixed(2)
          }
        },
        responsive: true,
        maintainAspectRatio: false
      };
    }
  }
};
</script>

<style scoped>
/* Estilos opcionais para o canvas do gráfico */

</style>
