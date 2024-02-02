<template>
    <div class="col-12 nav-bar">
        <div class="row">
            <div class="col-3 col-logo d-flex align-items-center">
                <img src="https://andrecode.com.br/teste_zucchetti/logo.png" width="250" height="85" alt="">
            </div>
            <div class="col-9 col-menus">
                <div class="div-title-nav">
                    <i class="fa-solid fa-user"></i><router-link class="title-nav-menu" to="/clientes">
                        Clientes</router-link>
                </div>
                <div class="div-title-nav">
                    <i class="fa-solid fa-box"></i><router-link class="title-nav-menu" to="/produtos">
                        Produtos</router-link>
                </div>
                <div class="div-title-nav">
                    <i class="fa-solid fa-credit-card"></i><router-link class="title-nav-menu" to="/formas_pagamento">
                        Formas de Pagamentos</router-link>
                </div>
                <div class="div-title-nav">
                    <i class="fa-solid fa-dollar-sign"></i><router-link class="title-nav-menu" to="/vendas">
                        Vendas</router-link>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'NavBar',
    computed: {
    }
}
</script>

<style src="./style.css" />
