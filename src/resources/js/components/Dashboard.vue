<template>
  <div id="app">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="#">Meu Projeto</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav-collapse" aria-controls="nav-collapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nav-collapse">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <router-link class="nav-link" to="/">Dashboard</router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" to="/detalhes">Detalhes</router-link>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container-fluid">
      <div class="row mt-3">
        <div class="col-md-7">
          <div class="card">
            <div class="card-header">
              Vendas por Situação
            </div>
            <div class="card-body">
              <PieChart :data="chartVendaSituacaoData" />
            </div>
          </div>
        </div>
        <div class="col-md-5">
          <div class="card">
            <div class="card-header">
              Filtros
            </div>
            <div class="card-body">
              <form @submit.prevent="fetchSales">
                <div class="mb-3">
                  <label for="cidade" class="form-label">Cidade:</label>
                  <input type="text" class="form-control" id="cidade" v-model="filters.cidade">
                </div>
                <div class="mb-3">
                  <label for="rastreio" class="form-label">Rastreio:</label>
                  <input type="text" class="form-control" id="rastreio" v-model="filters.rastreio">
                </div>
                <div class="mb-3">
                  <label for="nome_cliente" class="form-label">Nome do Cliente:</label>
                  <input type="text" class="form-control" id="nome_cliente" v-model="filters.nome_cliente">
                </div>
                <div class="mb-3">
                  <label for="id_venda" class="form-label">ID da Venda:</label>
                  <input type="text" class="form-control" id="id_venda" v-model="filters.id_venda">
                </div>
                <button type="submit" class="btn btn-primary">Filtrar</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              Total por Cliente
            </div>
            <div class="card-body">
              <DoughnutChart :data="chartCountClienteData" />
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              Vendas por Cliente
            </div>
            <div class="card-body">
              <PolarAreaChart :data="chartVendaClienteData" />
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              Vendas por Dia
            </div>
            <div class="card-body">
              <BarChart :data="chartVendaPorDiaData" />
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              Vendas por Cidade
            </div>
            <div class="card-body">
              <LineChart :data="chartVendaCidadeData" />
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              Vendas por Dia da Semana
            </div>
            <div class="card-body">
              <HeatmapChart :data="chartVendaHeatmapData" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import PieChart from './PieChart.vue';
import BarChart from './BarChart.vue';
import LineChart from './LineChart.vue';
import HeatmapChart from './HeatmapChart.vue';
import DoughnutChart from './DoughnutChart.vue';
import PolarAreaChart from './PolarAreaChart.vue';

import 'bootstrap/dist/js/bootstrap.bundle.min.js';

export default {
  components: {
    PieChart,
    BarChart,
    LineChart,
    HeatmapChart,
    DoughnutChart,
    PolarAreaChart
  },
  data() {
    return {
      filters: {
        cidade: '',
        rastreio: '',
        nome_cliente: '',
        id_venda: ''
      },
      chartVendaSituacaoData: [],
      chartVendaClienteData: [],
      chartVendaCidadeData: [],
      chartVendaPorDiaData: [],
      chartVendaHeatmapData: [],
      chartCountClienteData: []

    };
  },
  mounted() {
    this.fetchSales();
  },
  methods: {
    async fetchSales() {
      try {
        const response = await axios.get('/api/chart', {
          params: this.filters
        });
        if (response.data) {
          this.chartVendaSituacaoData = response.data.vendasituacao || [];
          this.chartVendaClienteData = response.data.vendacliente || [];
          this.chartVendaCidadeData = response.data.vendacidade || [];
          this.chartVendaPorDiaData = response.data.vendapordia || [];
          this.chartVendaHeatmapData = response.data.vendaheatmap || {};
          this.chartCountClienteData = response.data.countcliente || {};
        }
      } catch (error) {
        console.error('Erro ao buscar vendas:', error);
      }
    }
  }
};
</script>

<style scoped>
#app {
  min-height: 100vh;
}
</style>
