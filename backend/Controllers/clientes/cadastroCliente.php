<?php 

require __DIR__.'/../../vendor/autoload.php';
include_once __DIR__.'/../../app/includes/header.php';

use \App\Entidades\Cliente;

$objCliente = new Cliente;

if($objCliente->validaDados($data) && $_SERVER['REQUEST_METHOD'] === 'POST'){
    
    $objCliente->nome_cliente = $data['nome_cliente'];
    $objCliente->cpf          = $data['cpf'];
    $objCliente->email        = $data['email'];
    $objCliente->endereco     = $data['endereco'];
    $objCliente->cep          = $data['cep'];
    $objCliente->bairro       = $data['bairro'];
    $objCliente->cidade       = $data['cidade'];
    $objCliente->numero       = $data['numero'];

    $objCliente->cadastrar();

    exit;
}
