<?php 

require __DIR__.'/../../vendor/autoload.php';
include_once __DIR__.'/../../app/includes/header.php';

use \App\Entidades\Cliente;

$objCliente = new Cliente;

if(!isset($data['id_cliente'])){
    echo json_encode('error') ;

    exit;
}

if($objCliente->validaDados($data)){
    
    $objCliente->id_cliente   = $data['id_cliente'];
    $objCliente->nome_cliente = $data['nome_cliente'];
    $objCliente->cpf          = $data['cpf'];
    $objCliente->email        = $data['email'];
    $objCliente->endereco     = $data['endereco'];
    $objCliente->cep          = $data['cep'];
    $objCliente->bairro       = $data['bairro'];
    $objCliente->cidade       = $data['cidade'];
    $objCliente->numero       = $data['numero'];

    $objCliente->atualizar();

    exit;
}