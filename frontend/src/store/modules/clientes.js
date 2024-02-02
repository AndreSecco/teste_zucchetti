import api from '@/common/api.js'

/* eslint-disable */
export default {
  namespaced: true,

  state: {
    clientes: [],
    formCliente: {
      id_cliente: '',
      nome_cliente: '',
      cpf: '',
      email: '',
      cep: '',
      endereco: '',
      cidade: '',
      bairro: '',
      numero: '',
      acaoFormulario: 'cadastrar'
    }
  },
  getters: {
    getterClientes: (state) => state.clientes,
    getFormCliente: (state) => state.form
  },
  actions: { 
    async getClientesApi({ commit }) {
      try {
        const response = await api.get('Controllers/clientes/selectCliente.php')

        commit('setClientes', response.data)
      } catch (error) {
        console.log(error)
      }
    },

    async cadastrarCliente({ state, commit }, { data }) {
      try {
        const response = await api.post('Controllers/clientes/cadastroCliente.php', { ...data })

        return response
      } catch (error) {
        console.log(error)
      }
    },

    async editarCliente({ state, commit }, { data }) {
      try {
        const response = await api.put('Controllers/clientes/editarCliente.php', { ...data })

        return response
      } catch (error) {
        console.log(error)
      }
    },

    async excluirCliente({ state, commit }, { data }) {
      try {
        const response = await api.post('Controllers/clientes/excluirCliente.php', { ...data })

        return response
      } catch (error) {
        console.log(error)
      }
    },
  },
  mutations: {
    setClientes(state, clientes) {
      state.clientes = clientes
    },
    setFormCliente(state, cliente) {
      state.formCliente = cliente
    },
    limparCliente(state) {
      state.formCliente.nome_cliente = ''
      state.formCliente.id_cliente = ''
    }
  },
  modules: {
  }
}