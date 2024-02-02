
<?php 

require __DIR__.'/../../vendor/autoload.php';
include_once __DIR__.'/../../app/includes/header.php';

use \App\Entidades\Vendas;

$objVenda = new Vendas;

if($_SERVER['REQUEST_METHOD'] === 'GET'){

    $objVenda->cliente_venda = $_GET['id_cliente'];

    $venda = $objVenda->getVendasCliente();

    echo json_encode($venda);
    exit;
}

