import { mount } from '@vue/test-utils';
import Detalhes from '@/components/Detalhes.vue';
import axios from 'axios';
import flushPromises from 'flush-promises';
import DataTable from 'datatables.net-vue3';

jest.mock('axios');

describe('Detalhes.vue', () => {
  let wrapper;

  beforeEach(() => {
    axios.get.mockResolvedValue({
      data: [
        { cidade: 'City1', rastreio: '123', nome_cliente: 'Cliente1', id_venda: 1, valor: 100 },
        { cidade: 'City2', rastreio: '456', nome_cliente: 'Cliente2', id_venda: 2, valor: 200 }
      ]
    });

    wrapper = mount(Detalhes);
  });

  it('renders DataTable component', async () => {
    await flushPromises();
    expect(wrapper.findComponent(DataTable).exists()).toBe(true);
  });

  it('fetches sales data on mount', async () => {
    await flushPromises();
    expect(axios.get).toHaveBeenCalledWith('/api/vendas', { params: {} });
  });

  it('updates table data correctly after fetch', async () => {
    await flushPromises();
    expect(wrapper.vm.salesData).toEqual([
      { cidade: 'City1', rastreio: '123', nome_cliente: 'Cliente1', id_venda: 1, valor: 100 },
      { cidade: 'City2', rastreio: '456', nome_cliente: 'Cliente2', id_venda: 2, valor: 200 }
    ]);
  });

  it('filters sales data correctly', async () => {
    wrapper.setData({
      filters: {
        cidade: 'City1',
        rastreio: '',
        nome_cliente: '',
        id_venda: ''
      }
    });

    await wrapper.find('form').trigger('submit.prevent');
    await flushPromises();

    expect(axios.get).toHaveBeenCalledWith('/api/vendas', { params: { cidade: 'City1', rastreio: '', nome_cliente: '', id_venda: '' } });
  });
});
