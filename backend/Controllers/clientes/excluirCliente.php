<?php 

require __DIR__.'/../../vendor/autoload.php';
include_once __DIR__.'/../../app/includes/header.php';

use \App\Entidades\Cliente;

$objCliente = new Cliente;

if(!isset($data['id_cliente'])){
    echo json_encode('error') ;

    exit;
}

$cliente = $objCliente->getCliente($data['id_cliente']);

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $objCliente->id_cliente = $data['id_cliente'];
    
    $objCliente->excluir();

    exit;
}