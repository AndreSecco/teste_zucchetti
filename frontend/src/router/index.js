import Vue from 'vue'
import VueRouter from 'vue-router'
import VendasView from '../views/VendasView/VendasView.vue'
import ClientesView from '../views/ClientesView/ClientesView.vue'
import ProdutosView from '../views/ProdutosView/ProdutosView.vue'
import FormasPagamentoView from '../views/FormasPagamento/FormasPagamentoView.vue'

Vue.use(VueRouter)

const baseUrl = () => {
  const currentHost = window.location.hostname

  if (currentHost == 'localhost') { return '' }
  if (currentHost.includes('andrecode.com.br')) { return '/teste_zucchetti/frontend' }
}

const routes = [
  {
    path: '/',
    name: '/',
    component: VendasView
  },
  {
    path: '/clientes',
    name: 'clientes',
    component: ClientesView
  },
  {
    path: '/produtos',
    name: 'produtos',
    component: ProdutosView
  },
  {
    path: '/formas_pagamento',
    name: 'formas_pagamento',
    component: FormasPagamentoView
  },
  {
    path: '/vendas',
    name: 'vendas',
    component: VendasView
  },
]

const router = new VueRouter({
  mode: 'history',
  base: baseUrl(),
  routes
})

export default router
