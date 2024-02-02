<template>
    <div class="mt-4 div-itens-lancados">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Produto</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Preço</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(produto, index) in getProdutosLancados" :key="index">
                    <th scope="row">{{ produto.index }}</th>
                    <td>{{ produto.nome_produto }}</td>
                    <td>{{ produto.quantidade }}</td>
                    <td>{{ produto.preco }}</td>
                    <td>
                        <button @click="excluirProduto(produto)" class="btn">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>

        <finalizar-venda></finalizar-venda>        
    </div>
</template>
<script>
import FinalizarVenda from './FinalizarVenda.vue'
export default {
    name: 'ListaProdutosVendas',

    computed: {
        getProdutosLancados() {
            const produtosLancados = this.$store.getters['Vendas/getterProdutosLancados']

            return produtosLancados
        },

    },

    methods: {

        excluirProduto(produto) {
            this.$store.dispatch('Vendas/exlcuirProdutoVenda', { data: produto })
        }
    },

    components: {
        FinalizarVenda
    }
}
</script>