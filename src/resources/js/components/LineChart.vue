<template>
  <div>
    <Line :data="chartVendaCidadeData" :options="chartOptions" />
  </div>
</template>

<script>
import { Line } from 'vue-chartjs';
import { Chart, registerables } from 'chart.js';
import ChartDataLabels from 'chartjs-plugin-datalabels';

Chart.register(...registerables, ChartDataLabels);

export default {
  name: 'LineChart',
  components: {
    Line
  },
  props: {
    data: {
      type: Array,
      required: true
    }
  },
  computed: {
    chartVendaCidadeData() {
      const labels = this.data.map(item => item.cidade);
      const counts = this.data.map(item => item.total_vendas);

      return {
        labels,
        datasets: [
          {
            label: "Vendas por Cidade",
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
            backgroundColor: (context) => context.dataset.backgroundColor,
            formatter: (value) => value.toFixed(2)
          }
        },
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          y: {
            beginAtZero: true
          }
        }
      };
    }
  }
};
</script>

<style scoped>
/* Estilos opcionais para o canvas do gráfico */

</style>
