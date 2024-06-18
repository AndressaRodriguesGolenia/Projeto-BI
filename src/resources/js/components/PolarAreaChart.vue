<template>
  <div>
    <PolarArea :data="chartVendaClienteData" :options="chartOptions" />
  </div>
</template>

<script>
import { PolarArea } from 'vue-chartjs';
import { Chart, registerables } from 'chart.js';
import ChartDataLabels from 'chartjs-plugin-datalabels';

Chart.register(...registerables, ChartDataLabels);

export default {
  name: 'PolarAreaChart',
  components: {
    PolarArea
  },
  props: {
    data: {
      type: Array,
      required: true
    }
  },
  computed: {
    chartVendaClienteData() {
      const labels = this.data.map(item => item.nome_cliente);
      const counts = this.data.map(item => item.total_vendas);
      const backgroundcolors = this.data.map(() => '#' + Math.floor(Math.random() * 16777215).toString(16));

      return {
        labels,
        datasets: [
          {
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
