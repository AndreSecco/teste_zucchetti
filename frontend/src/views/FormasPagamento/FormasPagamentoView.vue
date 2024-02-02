<template>
    <div class="m-4 formas-pagamento-view">
        <h2>Cadastro de Formas de Pagamento</h2>
        <hr>
        <formas-pagamento-cadastro></formas-pagamento-cadastro>
        <lista-forma-pagamentos></lista-forma-pagamentos>
    </div>
</template>
<script>
import FormasPagamentoCadastro from '../../components/FormasPagamento/FormasPagamentoCadastro.vue';
import ListaFormaPagamentos from '../../components/FormasPagamento/ListaFormaPagamentos.vue';

export default {
    components: {
        FormasPagamentoCadastro,
        ListaFormaPagamentos
    }
}
</script>
<style src="./style.css" scoped>