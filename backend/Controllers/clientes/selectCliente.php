<?php 

require __DIR__.'/../../vendor/autoload.php';
include_once __DIR__.'/../../app/includes/header.php';

use \App\Entidades\Cliente;

$objCliente = new Cliente;

if($_SERVER['REQUEST_METHOD'] === 'GET'){
    $clientes = $objCliente->getClientes();

    echo json_encode($clientes);
    exit;
}

// echo "<pre>"; print_r($objCliente); echo "</pre>"; exit;