import Vue from 'vue'
import Vuex from 'vuex'
import Clientes from './modules/clientes'
import Produtos from './modules/produtos'
import FormasPagamento from './modules/formasPagamento'
import Vendas from './modules/vendas'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
  },
  getters: {
  },
  mutations: {
  },
  actions: {
  },
  modules: {
    Clientes,
    Produtos,
    FormasPagamento,
    Vendas
  }
})
