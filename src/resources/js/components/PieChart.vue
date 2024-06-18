<template>
  <div>
    <Pie :data="chartVendaSituacaoData"  :options="chartOptions" />
  </div>
</template>

<script>
import { Pie } from 'vue-chartjs';
import { Chart, registerables } from 'chart.js';
import ChartDataLabels from 'chartjs-plugin-datalabels';

Chart.register(...registerables, ChartDataLabels);

export default {
  name: 'PieChart',
  components: {
    Pie
  },
  props: {
    data: {
      type: Array,
      required: true
    }
  },
  computed: {
    chartVendaSituacaoData() {
      const labels = this.data.map(item => item.status);
      const counts = this.data.map(item => item.count);

      return {
        labels,
        datasets: [
          {
            data: counts,
            backgroundColor: this.data.map(() => `rgba(${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, 0.5)`)
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
            backgroundColor: (context) => context.dataset.backgroundColor
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

</style>
