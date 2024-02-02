<template>
    <div class="mt-4 ">
        <v-select class="mb-1" :options="getClientes" @input="preencherCliente" placeholder="Selecionar Cliente">
        </v-select>
    </div>
</template>
<script>
export default {
    name: 'SelecinoarCliente',

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

    },

    methods: {
        preencherCliente(cliente) {
            this.$store.state.Vendas.formVenda.cliente_venda = cliente.id_cliente
        },
    },

    created() {
        this.$store.dispatch('Clientes/getClientesApi')
    }

}
</script>