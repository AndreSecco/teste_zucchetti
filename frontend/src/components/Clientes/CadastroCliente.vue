<template>
    <div>
        <div class="row col-12 mb-4">
            <div class="col-3">
                <input v-model="form.nome_cliente" class="form-control input-form" type="text" placeholder="Nome"
                    name="nome_cliente" required>
            </div>
            <div class="col-3">
                <input v-model="form.cpf" class="form-control input-form" type="number" placeholder="CPF" name="cpf_cliente"
                    required>
            </div>
            <div class="col-3">
                <input v-model="form.email" class="form-control input-form" type="text" placeholder="E-mail"
                    name="email_cliente" required>
            </div>
            <div class="col-2">
                <input v-model="form.cep" class="form-control input-form" type="number" placeholder="CEP" name="cep_cliente"
                    required>
            </div>
            <div class="col-1">
                <button @click="pesquisarCep" class="btn btn-secondary btn-form"><i
                        class="fa-solid fa-magnifying-glass"></i></button>
            </div>
        </div>

        <div class="row col-12 mb-4">
            <div class="col-3">
                <input v-model="form.endereco" class="form-control input-form" type="text" placeholder="Endereço"
                    name="endereco_cliente" required>
            </div>
            <div class="col-3">
                <input v-model="form.cidade" class="form-control input-form" type="text" placeholder="Cidade"
                    name="cidade_cliente" required>
            </div>
            <div class="col-3">
                <input v-model="form.bairro" class="form-control input-form" type="text" placeholder="Bairro"
                    name="bairro_cliente" required>
            </div>
            <div class="col-3">
                <input v-model="form.numero" class="form-control input-form" type="text" placeholder="Número"
                    name="numero_cliente" required>
            </div>
        </div>
        <div class="col-12">
            <button v-if="acaoFormulario == 'cadastrar'" class="btn btn-success btn-cadastrar" type="submit"
                @click="cadastrarCliente">Cadastrar</button>
            <button v-if="acaoFormulario == 'editar'" class="btn btn-primary btn-editar" type="submit"
                @click="editarCliente">Editar</button>
            <button v-if="acaoFormulario == 'editar'" class="btn btn-primary btn-cancelar" type="submit"
                @click="limparCampos">Cancelar</button>
        </div>
    </div>
</template>
<script>
export default {
    name: 'CadastroCliente',

    computed: {
        form() {
            const formCliente = this.$store.state.Clientes.formCliente

            return { ...formCliente }
        },

        acaoFormulario() {
            return this.$store.state.Clientes.formCliente.acaoFormulario
        }
    },

    methods: {
        cadastrarCliente() {
            this.setFormCliente()

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

        setFormCliente() {
            this.$store.commit('Clientes/setFormCliente', { ...this.form })
        },

        editarCliente() {
            if (this.validarDados()) {
                this.setFormCliente()
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
            this.$store.state.Clientes.formCliente = {
                nome: '',
                cpf: '',
                email: '',
                cep: '',
                endereco: '',
                cidade: '',
                bairro: '',
                numero: '',
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

        pesquisarCep() {
            this.setFormCliente()

            const cep = this.$store.state.Clientes.formCliente.cep

            fetch(`https://viacep.com.br/ws/${cep}/json/`).then(response => {
                response.json()
                    .then(data => {
                        this.$store.state.Clientes.formCliente.endereco = data.logradouro
                        this.$store.state.Clientes.formCliente.cidade = data.localidade
                        this.$store.state.Clientes.formCliente.bairro = data.bairro
                    })
            })
                .catch(error => console.error('Erro na requisição:', error));
        }

    },


}
</script>
<style src="./style.css" >