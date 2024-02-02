<?php 

require __DIR__.'/../../vendor/autoload.php';
include_once __DIR__.'/../../app/includes/header.php';

use \App\Entidades\FormasPagamento;

$objFormaPagamento = new FormasPagamento;

if($objFormaPagamento->validaDados($data) && $_SERVER['REQUEST_METHOD'] === 'POST'){
    
    $objFormaPagamento->nome_forma_pagamento = $data['nome_forma_pagamento'];
    $objFormaPagamento->parcelas             = $data['parcelas'];

    $objFormaPagamento->cadastrar();

    exit;
}
