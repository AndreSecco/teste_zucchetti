<template>
    <div class="m-4 vendas-view row">
        <div class="col-4">
            <h2>Lançar Item</h2>
            <hr>
            <lancar-item-venda></lancar-item-venda>
            
            <h2>Selecione um Cliente</h2>
            <hr>
            <selecionar-cliente></selecionar-cliente>
        </div>
        <div class="col-8">
            <div class="row">
                <div class="col">
                    <h2>Itens Lançados</h2>
                </div>
                <div class="col d-flex justify-content-end">
                    <b-button v-b-modal.modalPesquisaVenda class="btn btn-filtrar"><i class="fa-solid fa-filter"></i> Filtrar Venda</b-button>
                </div>
            </div>
            <hr>
            <lista-itens-venda></lista-itens-venda>
        </div>

        <pesquisa-venda></pesquisa-venda>
    </div>
</template>
<script>
import PesquisaVenda from '@/components/Modais/PesquisaVenda.vue'
import LancarItemVenda from '@/components/Vendas/LancarItemVenda.vue'
import ListaItensVenda from '@/components/Vendas/ListaItensVenda.vue'
import SelecionarCliente from '@/components/Vendas/SelecionarCliente.vue'

export default {
    components: {
        LancarItemVenda,
        ListaItensVenda,
        SelecionarCliente,
        PesquisaVenda
    }
}
</script>
<style src="./style.css" scoped>