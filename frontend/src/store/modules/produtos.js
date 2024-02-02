import api from '@/common/api.js'

/* eslint-disable */
export default {
  namespaced: true,

  state: {
    produtos: [],
    formProduto: {
      id_produto: '',
      nome_produto: '',
      quantidade: '',
      preco: '',
      acaoFormulario: 'cadastrar'
    }
  },
  getters: {
    getterProdutos: (state) => state.produtos,
  },
  actions: { 
    async getProdutosApi({ commit }) {
      try {
        const response = await api.get('Controllers/produtos/selectProdutos.php')

        commit('setProdutos', response.data)
      } catch (error) {
        console.log(error)
      }
    },

    async cadastrarProduto({ state, commit }, { data }) {
      try {
        const response = await api.post('Controllers/produtos/cadastroProduto.php', { ...data })

        return response
      } catch (error) {
        console.log(error)
      }
    },

    async editarProduto({ state, commit }, { data }) {
      try {
        const response = await api.put('Controllers/produtos/editarProduto.php', { ...data })

        return response
      } catch (error) {
        console.log(error)
      }
    },

    async excluirProduto({ state, commit }, { data }) {
      try {
        const response = await api.post('Controllers/produtos/excluirProduto.php', { ...data })

        return response
      } catch (error) {
        console.log(error)
      }
    },
  },
  mutations: {
    setProdutos(state, produtos) {
      state.produtos = produtos
    },
    setFormProduto(state, produtos) {
      state.formProduto = produtos
    }
  },
  modules: {
  }
}