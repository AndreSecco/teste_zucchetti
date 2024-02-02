import api from '@/common/api.js'

/* eslint-disable */
export default {
  namespaced: true,

  state: {
    getVendas: [],
    produtosPesquisados: [],
    listaProdutosLancados: [],
    totalVenda: 0.00,
    formVenda: {
      id_venda: '',
      cliente_venda: '',
      produto_venda: '',
      forma_pagamento_venda: '',
      parcelas: '',
      acaoFormulario: 'cadastrar'
    }
  },
  getters: {
    getterFormaPagamento: (state) => state.formasPagamento,
    getterProdutosPesquisados: (state) => state.produtosPesquisados,
    getterProdutosLancados: (state) => state.listaProdutosLancados,
    getterTotalVenda: (state) => state.totalVenda,
    getterVendas: (state) => state.getVendas,

  },
  actions: { 
    async getVendasApi({ state, commit }){
      try {
        const response = await api.get('Controllers/vendas/selectVendas.php')

        commit('setVendas', response.data)
        return response
      } catch (error) {
        console.log(error)
      }
    },

    async pesquisaProdutoVenda({ state, commit }, { data }) {
      try {
        const response = await api.post('Controllers/vendas/selectProdutoVenda.php', { ...data })

        commit('setProdutosVenda', response.data)
      } catch (error) {
        console.log(error)
      }
    },

    exlcuirProdutoVenda({ state, commit }, { data }) {
      const produtosLancados = state.listaProdutosLancados

      produtosLancados.splice(data.index, 1)
      commit('atualizaTotal')
    },

    async finalizarVenda({ state, commit }){
      const venda = {
        cliente_venda: state.formVenda.cliente_venda,
        forma_pagamento_venda: state.formVenda.forma_pagamento_venda,
        parcelas: state.formVenda.parcelas,
        itens: state.listaProdutosLancados,
        total_venda: state.totalVenda
      }

      const response = await api.post('Controllers/vendas/finalizarVenda.php', { ...venda })
    },

    async getVendasClinte({ state, commit }, { data }) {
      try {
        const response = await api.get('Controllers/vendas/selectVendasCliente.php?id_cliente=' + data)

        commit('setVendas', response.data)
      } catch (error) {
        console.log(error)
      }
    },

    async excluirVenda({ state, commit }, { data }) {
      const response = await api.post('Controllers/vendas/excluirVenda.php', { ...data })
      
      return response
    }
   
  },
  mutations: {
    setVendas(state, vendas) {
      state.getVendas = vendas
    },

    setFormVenda(state, venda) {
      state.formVenda = venda
    },

    setProdutosVenda(state, listaProdutos){
      state.produtosPesquisados = listaProdutos
    },

    adicionaProdutoVenda(state, produto){
      produto.index = state.listaProdutosLancados.length
      state.listaProdutosLancados.push(produto)

      state.totalVenda = state.listaProdutosLancados.reduce((total, produto) => {
        return total += parseFloat(produto.preco)
      }, 0).toFixed(2)
    },

    atualizaTotal(state){
      state.totalVenda = state.listaProdutosLancados.reduce((total, produto) => {
        return total += parseFloat(produto.preco)
      }, 0).toFixed(2)
    },

    limparVenda(state){

      state.listaProdutosLancados = [],
      state.totalVenda = 0.00,
      state.formVenda = {
        id_venda: '',
        cliente_venda: '',
        produto_venda: '',
        forma_pagamento_venda: '',
        parcelas: '',
        acaoFormulario: 'cadastrar'
      }
    }
  },
  modules: {
  }
}