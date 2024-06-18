import { mount, shallowMount } from '@vue/test-utils';
import Dashboard from '@/components/Dashboard.vue';
import PieChart from '@/components/PieChart.vue';
import DoughnutChart from '@/components/DoughnutChart.vue';
import PolarAreaChart from '@/components/PolarAreaChart.vue';
import BarChart from '@/components/BarChart.vue';
import LineChart from '@/components/LineChart.vue';
import HeatmapChart from '@/components/HeatmapChart.vue';
import axios from 'axios';
import flushPromises from 'flush-promises';

jest.mock('axios');

describe('Dashboard.vue', () => {
  let wrapper;

  beforeEach(() => {
    axios.get.mockResolvedValue({
      data: {
        vendasituacao: [],
        vendacliente: [],
        vendacidade: [],
        vendapordia: [],
        vendaheatmap: {},
        countcliente: {}
      }
    });

    wrapper = shallowMount(Dashboard);
  });

  it('renders PieChart component', async () => {
    await flushPromises();
    expect(wrapper.findComponent(PieChart).exists()).toBe(true);
  });

  it('renders DoughnutChart component', async () => {
    await flushPromises();
    expect(wrapper.findComponent(DoughnutChart).exists()).toBe(true);
  });

  it('renders PolarAreaChart component', async () => {
    await flushPromises();
    expect(wrapper.findComponent(PolarAreaChart).exists()).toBe(true);
  });

  it('renders BarChart component', async () => {
    await flushPromises();
    expect(wrapper.findComponent(BarChart).exists()).toBe(true);
  });

  it('renders LineChart component', async () => {
    await flushPromises();
    expect(wrapper.findComponent(LineChart).exists()).toBe(true);
  });

  it('renders HeatmapChart component', async () => {
    await flushPromises();
    expect(wrapper.findComponent(HeatmapChart).exists()).toBe(true);
  });

  it('fetches sales data on mount', async () => {
    await flushPromises();
    expect(axios.get).toHaveBeenCalledWith('/api/chart', { params: {} });
  });

  it('updates charts data correctly after fetch', async () => {
    axios.get.mockResolvedValueOnce({
      data: {
        vendasituacao: [1, 2, 3],
        vendacliente: [4, 5, 6],
        vendacidade: [7, 8, 9],
        vendapordia: [10, 11, 12],
        vendaheatmap: { a: 1, b: 2 },
        countcliente: [13, 14, 15]
      }
    });

    wrapper = mount(Dashboard);
    await flushPromises();

    expect(wrapper.vm.chartVendaSituacaoData).toEqual([1, 2, 3]);
    expect(wrapper.vm.chartVendaClienteData).toEqual([4, 5, 6]);
    expect(wrapper.vm.chartVendaCidadeData).toEqual([7, 8, 9]);
    expect(wrapper.vm.chartVendaPorDiaData).toEqual([10, 11, 12]);
    expect(wrapper.vm.chartVendaHeatmapData).toEqual({ a: 1, b: 2 });
    expect(wrapper.vm.chartCountClienteData).toEqual([13, 14, 15]);
  });

  it('toggles sidebar visibility when button is clicked', async () => {
    const button = wrapper.find('button');
    await button.trigger('click');
    expect(wrapper.vm.isSidebarVisible).toBe(true);

    await button.trigger('click');
    expect(wrapper.vm.isSidebarVisible).toBe(false);
  });
});
