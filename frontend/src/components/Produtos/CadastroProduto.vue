<template>
    <div>
        <div class="row col-12 mb-4">
            <div class="col-6">
                <input v-model="form.nome_produto" class="form-control input-form" type="text" name="nome_produto"
                    placeholder="Nome Produto" required>
            </div>
            <div class="col-3">
                <input v-model="form.quantidade" class="form-control input-form" type="number" name="quantidade_produto"
                    placeholder="Quantidade" required>
            </div>
            <div class="col-3">
                <input v-model="form.preco" class="form-control input-form" type="text" placeholder="Preco" name="preco"
                    required>
            </div>
        </div>
        <div class="col-12">
            <button v-if="acaoFormulario == 'cadastrar'" class="btn btn-success btn-cadastrar" type="submit"
                @click="cadastrarProduto">Cadastrar</button>
            <button v-if="acaoFormulario == 'editar'" class="btn btn-primary btn-editar" type="submit"
                @click="editarProduto">Editar</button>
            <button v-if="acaoFormulario == 'editar'" class="btn btn-primary btn-cancelar" type="submit"
                @click="limparCampos">Cancelar</button>
        </div>
    </div>
</template>
<script>
export default {
    name: 'CadastroProduto',

    computed: {
        form() {
            const formProduto = this.$store.state.Produtos.formProduto

            return { ...formProduto }
        },

        acaoFormulario() {
            return this.$store.state.Produtos.formProduto.acaoFormulario
        }
    },

    methods: {
        cadastrarProduto() {
            this.setFormProduto()

            const dadosProduto = this.$store.state.Produtos.formProduto

            if (this.validarDados()) {
                this.$store.dispatch('Produtos/cadastrarProduto', { data: dadosProduto }).then(() => {
                    this.$swal.fire({
                        'title': 'Sucesso',
                        'text': 'Produto cadastrado com sucesso!',
                        'icon': 'success',
                        'timer': 1500
                    })

                    this.limparCampos()
                    this.$store.dispatch('Produtos/getProdutosApi')

                })
            }
        },

        setFormProduto() {
            this.$store.commit('Produtos/setFormProduto', { ...this.form })
        },

        editarProduto() {
            if (this.validarDados()) {
                this.setFormProduto()
                const dadosProduto = this.$store.state.Produtos.formProduto

                this.$store.dispatch('Produtos/editarProduto', { data: dadosProduto }).then(() => {
                    this.$swal.fire({
                        'title': 'Sucesso',
                        'text': 'Produto editado com sucesso!',
                        'icon': 'success',
                        'timer': 1500
                    })

                    this.limparCampos()
                    this.$store.dispatch('Produtos/getProdutosApi')

                })
            }
        },

        limparCampos() {
            this.$store.state.Produtos.formProduto = {
                nome_produto: '',
                quantidade: '',
                preco: '',
                acaoFormulario: 'cadastrar'
            }
        },

        validarDados() {
            if (this.form.nome_produto === "" || this.form.quantidade === "" || this.form.preco === "") {
                this.$swal.fire({
                    'title': 'Oops!',
                    'text': 'Verifique os campos Nome de Produto, Quantidade e Preço!',
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