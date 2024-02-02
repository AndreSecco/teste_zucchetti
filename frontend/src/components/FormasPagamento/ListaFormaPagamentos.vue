<template>
    <div class="mt-4">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Forma Pagamento</th>
                    <th scope="col">Parcelas</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(formaPagamento, index) in getFormasPagamento" :key="index">
                    <th scope="row">{{ formaPagamento.id_forma_pagamento }}</th>
                    <td>{{ formaPagamento.nome_forma_pagamento }}</td>
                    <td>{{ formaPagamento.parcelas }}</td>
                    <td>
                        <button @click="editarFormaPagamento(formaPagamento)" class="btn">
                            <i class="fa-solid fa-pen"></i>
                        </button>
                        <button @click="excluirFormaPagamento(formaPagamento)" class="btn">
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
    name: 'ListaFormaPagamentos',

    computed: {
        getFormasPagamento() {
            const formasPagamentos = this.$store.getters['FormasPagamento/getterFormaPagamento']

            return formasPagamentos
        }
    },

    methods: {
        getFormaPagamentoApi() {
            this.$store.dispatch('FormasPagamento/getFormasPagamentosApi')
        },

        editarFormaPagamento(formaPagamento) {
            formaPagamento.acaoFormulario = 'editar'

            this.$store.state.FormasPagamento.formFormaPagamento = formaPagamento
        },

        excluirFormaPagamento(formaPagamento) {
            this.$swal.fire({
                'title': 'Excluir Forma de Pagamento',
                'text': 'Deseja realmente excluir este registro?',
                'icon': 'warning',
                showCancelButton: true,
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Confirmar'
            })
                .then(result => {
                    if (result.isConfirmed) {
                        this.$store.dispatch('FormasPagamento/excluirFormaPagamento', { data: formaPagamento }).then(() => {
                            this.$swal.fire({
                                'title': 'Sucesso',
                                'text': 'Forma de Pagamento excluído com sucesso!',
                                'icon': 'success',
                                'timer': 1500
                            })

                            this.$store.dispatch('FormasPagamento/getFormasPagamentosApi')

                        })
                    }
                })
        }

    },

    created() {
        this.getFormaPagamentoApi()
    },
}
</script>