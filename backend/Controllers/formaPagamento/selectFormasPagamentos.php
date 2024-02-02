<?php 

require __DIR__.'/../../vendor/autoload.php';
include_once __DIR__.'/../../app/includes/header.php';

use \App\Entidades\FormasPagamento;

$objFormasPagamento = new FormasPagamento;

if($_SERVER['REQUEST_METHOD'] === 'GET'){
    $clientes = $objFormasPagamento->getFormasPagamento();

    echo json_encode($clientes);
    exit;
}