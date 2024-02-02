<template>
    <div class="m-4 clientes-view">
        <h2>Cadastro de Clientes</h2>
        <hr>
        <cadastro-cliente></cadastro-cliente>
        <lista-clientes></lista-clientes>
    </div>
</template>
<script>
import CadastroCliente from '@/components/Clientes/CadastroCliente.vue'
import ListaClientes from '@/components/Clientes/ListaClientes.vue'

export default {
    components: {
        CadastroCliente,
        ListaClientes
    }
}
</script>
<style src="./style.css" scoped>