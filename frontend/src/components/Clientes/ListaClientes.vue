<template>
    <div class="mt-4">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">CPF</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Endereço</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(cliente, index) in getClientes" :key="index">
                    <th scope="row">{{ cliente.id_cliente }}</th>
                    <td>{{ cliente.nome_cliente }}</td>
                    <td>{{ cliente.cpf }}</td>
                    <td>{{ cliente.email }}</td>
                    <td>{{ cliente.endereco }}</td>
                    <td>
                        <button @click="editarCliente(cliente)" class="btn">
                            <i class="fa-solid fa-pen"></i>
                        </button>
                        <button @click="excluirCliente(cliente)" class="btn">
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
    name: 'ListaClientes',

    computed: {
        getClientes() {
            const clientes = this.$store.getters['Clientes/getterClientes']

            return clientes
        }
    },

    methods: {
        getClientesApi() {
            this.$store.dispatch('Clientes/getClientesApi')
        },

        editarCliente(cliente) {
            cliente.acaoFormulario = 'editar'

            this.$store.state.Clientes.formCliente = cliente
        },
        
        excluirCliente(cliente) {
            this.$swal.fire({
                'title': 'Excluir cliente',
                'text': 'Deseja realmente excluir este registro?',
                'icon': 'warning',
                showCancelButton: true,
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Confirmar'
            })
                .then(result => {
                    if (result.isConfirmed) {
                        this.$store.dispatch('Clientes/excluirCliente', { data: cliente }).then(() => {
                            this.$swal.fire({
                                'title': 'Sucesso',
                                'text': 'Cliente excluído com sucesso!',
                                'icon': 'success',
                                'timer': 1500
                            })

                            this.$store.dispatch('Clientes/getClientesApi')

                        })
                    }
                })


        }

    },

    created() {
        this.getClientesApi()
    },
}
</script>