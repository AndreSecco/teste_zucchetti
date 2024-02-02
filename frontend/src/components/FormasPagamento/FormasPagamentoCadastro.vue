<template>
    <div>
        <div class="row col-12 mb-4">
            <div class="col-9">
                <input v-model="form.nome_forma_pagamento" class="form-control input-form" type="text" name="forma_pagamento"
                    placeholder="Forma Pagamento" required>
            </div>
            <div class="col-3">
                <input v-model="form.parcelas" class="form-control input-form" type="number" name="parcelas"
                    placeholder="Número Parcelas" required>
            </div>
        </div>
        <div class="col-12">
            <button v-if="acaoFormulario == 'cadastrar'" class="btn btn-success btn-cadastrar" type="submit"
                @click="cadastrarFormaPagamento">Cadastrar</button>
            <button v-if="acaoFormulario == 'editar'" class="btn btn-primary btn-editar" type="submit"
                @click="editarFormaPagamento">Editar</button>
            <button v-if="acaoFormulario == 'editar'" class="btn btn-primary btn-cancelar" type="submit"
                @click="limparCampos">Cancelar</button>
        </div>
    </div>
</template>
<script>
export default {
    name: 'CadastroFormaPagamento',

    computed: {
        form() {
            const formFormaPagamento = this.$store.state.FormasPagamento.formFormaPagamento

            return { ...formFormaPagamento }
        },

        acaoFormulario() {
            return this.$store.state.FormasPagamento.formFormaPagamento.acaoFormulario
        }
    },

    methods: {
        cadastrarFormaPagamento() {
            this.setFormFormaPagamento()

            const dadosFormaPagamento = this.$store.state.FormasPagamento.formFormaPagamento

            if (this.validarDados()) {
                this.$store.dispatch('FormasPagamento/cadastrarFormaPagamento', { data: dadosFormaPagamento }).then(() => {
                    this.$swal.fire({
                        'title': 'Sucesso',
                        'text': 'Forma de pagamento cadastrado com sucesso!',
                        'icon': 'success',
                        'timer': 1500
                    })

                    this.limparCampos()
                    this.$store.dispatch('FormasPagamento/getFormasPagamentosApi')

                })
            }
        },

        setFormFormaPagamento() {
            this.$store.commit('FormasPagamento/setFormFormaPagamento', { ...this.form })
        },

        editarFormaPagamento() {
            if (this.validarDados()) {
                this.setFormFormaPagamento()
                const dadosFormaPagamento = this.$store.state.FormasPagamento.formFormaPagamento

                this.$store.dispatch('FormasPagamento/editarFormaPagamento', { data: dadosFormaPagamento }).then(() => {
                    this.$swal.fire({
                        'title': 'Sucesso',
                        'text': 'Forma de pagamento editado com sucesso!',
                        'icon': 'success',
                        'timer': 1500
                    })

                    this.limparCampos()
                    this.$store.dispatch('FormasPagamento/getFormasPagamentosApi')

                })
            }
        },

        limparCampos() {
            this.$store.state.FormasPagamento.formFormaPagamento = {
                nome_forma_pagamento: '',
                parcelas: '',
                acaoFormulario: 'cadastrar'
            }
        },

        validarDados() {
            if (this.form.nome_forma_pagamento === "" || this.form.parcelas === "") {
                this.$swal.fire({
                    'title': 'Oops!',
                    'text': 'Verifique os campos Forma Pagamento e Parcelas!',
                    'icon': 'warning',
                })

                return false
            }

            return true
        },

    },


}
</script>
<style src="./style.css" >