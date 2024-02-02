import api from '@/common/api.js'

/* eslint-disable */
export default {
  namespaced: true,

  state: {
    formasPagamento: [],
    formFormaPagamento: {
      id_forma_pagamento: '',
      nome_forma_pagamento: '',
      parcelas: '',
      acaoFormulario: 'cadastrar'
    }
  },
  getters: {
    getterFormaPagamento: (state) => state.formasPagamento,
  },
  actions: { 
    async getFormasPagamentosApi({ commit }) {
      try {
        const response = await api.get('Controllers/formaPagamento/selectFormasPagamentos.php')

        commit('setFormasPagamentos', response.data)
      } catch (error) {
        console.log(error)
      }
    },

    async cadastrarFormaPagamento({ state, commit }, { data }) {
      try {
        const response = await api.post('Controllers/formaPagamento/cadastroFormaPagamento.php', { ...data })

        return response
      } catch (error) {
        console.log(error)
      }
    },

    async editarFormaPagamento({ state, commit }, { data }) {
      try {
        const response = await api.put('Controllers/formaPagamento/editarFormaPagamento.php', { ...data })

        return response
      } catch (error) {
        console.log(error)
      }
    },

    async excluirFormaPagamento({ state, commit }, { data }) {
      try {
        const response = await api.post('Controllers/formaPagamento/excluirFormaPagamento.php', { ...data })

        return response
      } catch (error) {
        console.log(error)
      }
    },
  },
  mutations: {
    setFormasPagamentos(state, formasPagamento) {
      state.formasPagamento = formasPagamento
    },
    setFormFormaPagamento(state, formasPagamento) {
      state.formFormaPagamento = formasPagamento
    },
    limparFormaPagamento(state) {
      state.formFormaPagamento = {
        id_forma_pagamento: '',
        nome_forma_pagamento: '',
        parcelas: '',
        acaoFormulario: 'cadastrar'
      }
    }
  },
  modules: {
  }
}