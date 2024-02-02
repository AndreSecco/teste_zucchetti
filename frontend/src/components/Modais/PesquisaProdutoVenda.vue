<template>
    <div>
        <b-modal id="modalPesquisaProdutoVenda" size="xl" title="Resultado da pesquisa" centered scrollable>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nome Produto</th>
                        <th scope="col">Quantidade</th>
                        <th scope="col">Preço</th>
                        <th scope="col">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(produto, index) in produtosPesquisados" :key="index">
                        <th scope="row">{{ produto.id_produto }}</th>
                        <td>{{ produto.nome_produto }}</td>
                        <td>{{ produto.quantidade }}</td>
                        <td>{{ produto.preco }}</td>
                        <td>
                            <button @click="selecionaProduto(produto)" class="btn btn-success">
                                <i class="fa-solid fa-share"></i> Selecionar
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <template #modal-footer="{ cancel }">
                <b-button size="sm" variant="secondary" @click="cancel()">
                    Cancelar
                </b-button>
            </template>
        </b-modal>
    </div>
</template>
<script>
export default {
    name: 'PesquisaProdutovenda',

    computed: {
        produtosPesquisados() {
            const produtos = this.$store.getters['Vendas/getterProdutosPesquisados']

            return produtos
        }
    },

    methods: {
        selecionaProduto(produto) {
            produto.produto_venda = produto.nome_produto
            this.$store.state.Vendas.formVenda = produto
            this.$bvModal.hide('modalPesquisaProdutoVenda')
            // this.$refs['modalPesquisaProdutoVenda'].hide()
        }

    }
}
</script>