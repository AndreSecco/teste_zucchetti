
<?php 

require __DIR__.'/../../vendor/autoload.php';
include_once __DIR__.'/../../app/includes/header.php';

use \App\Entidades\Produto;

$objProdutos = new Produto;

if($_SERVER['REQUEST_METHOD'] === 'GET'){
    $produtos = $objProdutos->getProdutos();

    echo json_encode($produtos);
    exit;
}

