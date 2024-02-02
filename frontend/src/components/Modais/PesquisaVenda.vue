<template>
    <div>
        <b-modal id="modalPesquisaVenda" size="xl" title="Todas as Vendas" centered scrollable>
            <div class="col-12 row mb-3">
                <div class="col-11">
                    <p>Filtrar por cliente:</p>
                    <v-select class="mb-1" :options="getClientes" @input="preencherCliente"
                        placeholder="Selecionar Cliente">
                    </v-select>
                </div>

                <div class="col-1 d-flex align-items-end">
                    <button class="btn" @click="limparFiltro"><i class="fa-solid fa-xmark"></i></button>
                </div>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Cliente Venda</th>
                        <th scope="col">Data Venda</th>
                        <th scope="col">Total</th>
                        <th scope="col">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(venda, index) in getVendas" :key="index">
                        <th scope="row">{{ venda.id_venda }}</th>
                        <td>{{ venda.nome_cliente }}</td>
                        <td>{{ venda.data_venda }}</td>
                        <td>{{ venda.total_venda }}</td>
                        <td>
                            <!-- <button @click="editarVenda(venda)" class="btn">
                                <i class="fa-solid fa-pen"></i>
                            </button> -->
                            <button @click="excluirVenda(venda)" class="btn">
                                <i class="fa-solid fa-trash"></i>
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
        getClientes() {
            const clientes = this.$store.getters['Clientes/getterClientes']

            if (!clientes) {
                this.$store.dispatch('Clientes/getClientesApi')
                return []
            }

            return clientes.map(cliente => {
                return {
                    ...cliente,
                    id_cliente: cliente.id_cliente,
                    label: cliente.nome_cliente
                }
            })
        },

        getVendas() {
            const vendas = this.$store.getters['Vendas/getterVendas']

            return vendas
        }
    },

    methods: {
        limparFiltro() {
            this.$store.dispatch('Vendas/getVendasApi')
        },

        selecionaProduto(produto) {
            produto.produto_venda = produto.nome_produto
            this.$store.state.Vendas.formVenda = produto
            this.$bvModal.hide('modalPesquisaProdutoVenda')
        },

        preencherCliente(cliente) {
            this.$store.dispatch('Vendas/getVendasClinte', { data: cliente.id_cliente })
        },

        excluirVenda(venda) {
            this.$swal.fire({
                'title': 'Excluir venda?',
                'text': 'Deseja realmente excluir este registro?',
                'icon': 'warning',
                showCancelButton: true,
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Confirmar'
            })
                .then(result => {
                    if (result.isConfirmed) {
                        this.$store.dispatch('Vendas/excluirVenda', { data: venda }).then(() => {
                            this.$swal.fire({
                                'title': 'Sucesso',
                                'text': 'Venda excluída com sucesso!',
                                'icon': 'success',
                                'timer': 1500
                            })

                            this.$store.dispatch('Vendas/getVendasApi')
                        })

                    }
                })


        },

    },

    created() {
        this.$store.dispatch('Vendas/getVendasApi')
        this.$store.dispatch('Clientes/getClientesApi')

    }
}
</script>