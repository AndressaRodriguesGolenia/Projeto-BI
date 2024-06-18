<template>
  <div id="detalhes">
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
        <div class="col-12">
          <DataTable :data="sales" :options="dtOptions"></DataTable>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import 'datatables.net-bs5/css/dataTables.bootstrap5.min.css';
import 'datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css';
import DataTable from 'datatables.net-vue3'
import DataTablesLib from 'datatables.net';

DataTable.use(DataTablesLib);


export default {
  name: 'Detalhes',
  components: {
    DataTable
  },
  setup() {
    const filters = ref({
      cidade: '',
      rastreio: '',
      nome_cliente: '',
      id_venda: ''
    });

    const sales = ref([]);
    const isSidebarVisible = ref(false);

    const toggleSidebar = () => {
      isSidebarVisible.value = !isSidebarVisible.value;
    };

    const fetchSales = async () => {
      try {
        const response = await axios.get('/api/vendas', {
          params: filters.value
        });
        if (response.data) {
          sales.value = response.data;
        }
        console.log("Dados retornados!", sales.value);
      } catch (error) {
        console.error('Erro ao buscar vendas:', error);
      }
    };

    onMounted(fetchSales);

    const dtOptions = ref({
      columns: [
        { title: 'ID', data: 'id' },
        { title: 'Cidade', data: 'cidade' },
        { title: 'Rastreio', data: 'rastreio' },
        { title: 'Nome do Cliente', data: 'nome_cliente' },
        { title: 'Data da Venda', data: 'data_venda' },
        { title: 'Valor da Venda', data: 'valor' }
      ],
      dom: 'Bfrtip',
      buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
      ],
      responsive: true
    });

    return {
      filters,
      sales,
      isSidebarVisible,
      toggleSidebar,
      fetchSales,
      dtOptions
    };
  }
};
</script>

<style scoped>
#detalhes {
  min-height: 100vh;
}
</style>
