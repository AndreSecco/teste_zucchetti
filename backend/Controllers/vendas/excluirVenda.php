<?php 

require __DIR__.'/../../vendor/autoload.php';
include_once __DIR__.'/../../app/includes/header.php';

use \App\Entidades\Vendas;

$objVenda = new Vendas;

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $objVenda->id_venda = $data['id_venda'];

    $objVenda->excluir();

    exit;
}
