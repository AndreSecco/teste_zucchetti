<template>
    <div class="mt-4">
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
                <tr v-for="(produto, index) in getProdutos" :key="index">
                    <th scope="row">{{ produto.id_produto }}</th>
                    <td>{{ produto.nome_produto }}</td>
                    <td>{{ produto.quantidade }}</td>
                    <td>{{ produto.preco }}</td>
                    <td>
                        <button @click="editarProduto(produto)" class="btn">
                            <i class="fa-solid fa-pen"></i>
                        </button>
                        <button @click="excluirProduto(produto)" class="btn">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
export default {
    name: 'ListaProdutos',

    computed: {
        getProdutos() {
            const produtos = this.$store.getters['Produtos/getterProdutos']

            return produtos
        }
    },

    methods: {
        getProdutosApi() {
            this.$store.dispatch('Produtos/getProdutosApi')
        },

        editarProduto(produto) {
            produto.acaoFormulario = 'editar'

            this.$store.state.Produtos.formProduto = produto
        },

        excluirProduto(produto) {
            this.$swal.fire({
                'title': 'Excluir produto',
                'text': 'Deseja realmente excluir este registro?',
                'icon': 'warning',
                showCancelButton: true,
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Confirmar'
            })
                .then(result => {
                    if (result.isConfirmed) {
                        this.$store.dispatch('Produtos/excluirProduto', { data: produto }).then(() => {
                            this.$swal.fire({
                                'title': 'Sucesso',
                                'text': 'Produto excluído com sucesso!',
                                'icon': 'success',
                                'timer': 1500
                            })

                            this.$store.dispatch('Produtos/getProdutosApi')

                        })
                    }
                })
        }

    },

    created() {
        this.getProdutosApi()
    },
}
</script>