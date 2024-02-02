<template>
    <div class="m-4 produtos-view">
        <h2>Cadastro de Produtos</h2>
        <hr>
        <cadastro-produto></cadastro-produto>
        <lista-produtos></lista-produtos>
    </div>
</template>
<script>
import CadastroProduto from '../../components/Produtos/CadastroProduto.vue';
import ListaProdutos from '../../components/Produtos/ListaProdutos.vue';

export default {
    components: {
        CadastroProduto,
        ListaProdutos
    }
}
</script>
<style src="./style.css" scoped>