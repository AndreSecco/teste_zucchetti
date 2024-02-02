<template>
    <div>
        <div class="row col-12 mb-4">
            <div class="col-10">
                <input v-model="form.produto_venda" class="form-control input-form" type="text"
                    placeholder="Pesquisar Produto" required>
            </div>
            <div class="col-1">
                <b-button v-b-modal.modalPesquisaProdutoVenda @click="pesquiarProduto" class="btn btn-secondary btn-form"
                    ata-toggle="modal" data-target="#exampleModalCenter"><i
                        class="fa-solid fa-magnifying-glass"></i></b-button>
            </div>
        </div>
        <div class="col-12 row mb-4">
            <div class="col-6">
                <input v-model="form.quantidade" class="form-control input-form" type="text" placeholder="Quantidade"
                    required>
            </div>
            <div class="col-6">
                <input v-model="form.preco" class="form-control input-form" type="text" placeholder="Preço" required>
            </div>
        </div>

        <div class="col-12 row mb-4">
            <button class="btn btn-success btn-lancar-venda" type="submit" @click="lancarItem">Lançar Item</button>
        </div>

        <pesquisa-produto-venda></pesquisa-produto-venda>
    </div>
</template>
<script>
import PesquisaProdutoVenda from '../Modais/PesquisaProdutoVenda.vue'

export default {
    name: 'LancarItemVenda',

    components: { PesquisaProdutoVenda },

    computed: {
        form() {
            const formVenda = this.$store.state.Vendas.formVenda

            return { ...formVenda }
        },

        acaoFormulario() {
            return this.$store.state.Vendas.formVenda.acaoFormulario
        }
    },

    methods: {

        pesquiarProduto() {
            this.setFormVenda()

            const produto_venda = this.$store.state.Vendas.formVenda

            this.$store.dispatch('Vendas/pesquisaProdutoVenda', { data: produto_venda })

        },

        setFormVenda() {
            this.$store.commit('Vendas/setFormVenda', { ...this.form })
        },

        lancarItem() {
            const produto = this.form

            this.$store.commit('Vendas/adicionaProdutoVenda', produto)

            this.limparCampos()
        },

        cadastrarCliente() {
            this.setFormVenda()

            const dadosCliente = this.$store.state.Clientes.formCliente

            if (this.validarDados()) {
                this.$store.dispatch('Clientes/cadastrarCliente', { data: dadosCliente }).then(() => {
                    this.$swal.fire({
                        'title': 'Sucesso',
                        'text': 'Cliente cadastrado com sucesso!',
                        'icon': 'success',
                        'timer': 1500
                    })

                    this.limparCampos()
                    this.$store.dispatch('Clientes/getClientesApi')

                })
            }
        },

        editarCliente() {
            if (this.validarDados()) {
                this.setFormVenda()
                const dadosCliente = this.$store.state.Clientes.formCliente

                this.$store.dispatch('Clientes/editarCliente', { data: dadosCliente }).then(() => {
                    this.$swal.fire({
                        'title': 'Sucesso',
                        'text': 'Cliente editado com sucesso!',
                        'icon': 'success',
                        'timer': 1500
                    })

                    this.limparCampos()
                    this.$store.dispatch('Clientes/getClientesApi')

                })
            }
        },

        limparCampos() {
            this.$store.state.Vendas.formVenda = {
                id_venda: '',
                cliente_venda: '',
                produto_venda: '',
                forma_pagamento_venda: '',
                acaoFormulario: 'cadastrar'
            }
        },

        validarDados() {
            if (this.form.nome_cliente === "" || this.form.cpf === "" || this.form.email === "") {
                this.$swal.fire({
                    'title': 'Oops!',
                    'text': 'Verifique os campos Nome, CPF e E-mail!',
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