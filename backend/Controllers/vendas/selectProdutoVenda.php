
<?php 

require __DIR__.'/../../vendor/autoload.php';
include_once __DIR__.'/../../app/includes/header.php';

use \App\Entidades\Vendas;

$objVenda = new Vendas;

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $objVenda->produto_venda = $data['produto_venda'];

    $venda = $objVenda->getProdutoVenda();

    echo json_encode($venda);
    exit;
}

