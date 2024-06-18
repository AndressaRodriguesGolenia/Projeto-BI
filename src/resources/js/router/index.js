import { createRouter, createWebHistory } from 'vue-router';
import Dashboard from '../components/Dashboard.vue';
import Detalhes from '../components/Detalhes.vue';

const routes = [
  {
    path: '/',
    name: 'Dashboard',
    component: Dashboard
  },
  {
    path: '/detalhes',
    name: 'Detalhes',
    component: Detalhes
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
