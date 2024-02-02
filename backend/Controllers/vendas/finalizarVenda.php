<?php 

require __DIR__.'/../../vendor/autoload.php';
include_once __DIR__.'/../../app/includes/header.php';

use \App\Entidades\Vendas;

$objVenda = new Vendas;

if($objVenda->validaDados($data) && $_SERVER['REQUEST_METHOD'] === 'POST'){

    $objVenda->cliente_venda         = $data['cliente_venda'];
    $objVenda->forma_pagamento_venda = $data['forma_pagamento_venda'];
    $objVenda->parcelas              = $data['parcelas'];
    $objVenda->total_venda           = $data['total_venda'];
    $objVenda->itens_venda           = $data['itens'];
    $objVenda->data_venda            = date('Y:m:d H:i:s');

    $objVenda->cadastrar();

    $objVenda->cadastrarItens();

    exit;
}
