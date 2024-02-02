<template>
    <div class="col-12 row">
        <div class="col-6">
            <div class="div-total-venda">
                <p class="desc-total-venda">Total: R${{ totalVenda }}</p>
            </div>
        </div>
        <div class="col-6">
            <div class="forma-pagamento-venda row col-12">
                <div class="col-6">
                    <p>Parcelas:</p>
                    <input v-model="parcelas" type="text" class="form-control mt-2" name="parcelas" placeholder="Parcelas">
                </div>
                <div class="col-6">
                    <p>Forma de Pagamento:</p>
                    <v-select class="mb-1" :options="getFormasPagamentos" @input="preencheParcela"
                        placeholder="Forma de Pagamento">
                    </v-select>
                </div>
            </div>
            <div class="botoes-venda d-flex justify-content-end">
                <button class="btn btn-danger m-2" @click="limparVenda">Cancelar</button>
                <button class="btn btn-success m-2" @click="finalizarVenda">Finalizar Venda</button>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            parcelas: ''
        }
    },

    computed: {
        form() {
            const finalizacaoVenda = this.$store.state.Vendas.formVenda

            return { ...finalizacaoVenda }
        },

        totalVenda() {
            const totalVenda = this.$store.getters['Vendas/getterTotalVenda']

            return totalVenda
        },


        getFormasPagamentos() {
            const formasPagamentos = this.$store.getters['FormasPagamento/getterFormaPagamento']

            if (!formasPagamentos) {
                this.$store.dispatch('FormasPagamento/getFormasPagamentosApi')
                return []
            }

            return formasPagamentos.map(pagamento => {
                return {
                    ...formasPagamentos,
                    id_forma_pagamento: pagamento.id_forma_pagamento,
                    parcela: pagamento.parcelas,
                    label: pagamento.nome_forma_pagamento
                }
            })
        }
    },

    methods: {
        preencheParcela(formaPagamento) {
            this.parcelas = formaPagamento.parcela
            this.$store.state.Vendas.formVenda.forma_pagamento_venda = formaPagamento.id_forma_pagamento
            this.$store.state.Vendas.formVenda.parcelas = formaPagamento.parcela
        },
        finalizarVenda() {
            this.$store.state.Vendas.formVenda.parcelas = this.parcelas
            this.$store.dispatch('Vendas/finalizarVenda').then(() => {
                this.$swal.fire({
                    title: 'Sucesso!',
                    text: 'Venda cadastrada com sucesso',
                    icon: 'success',
                    timer: 1500,
                })
            })
            this.limparVenda()
        },

        limparVenda() {
            window.location.reload()
        },
    },


    created() {
        this.$store.dispatch('FormasPagamento/getFormasPagamentosApi')

    }
}
</script>