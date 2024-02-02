<?php 

require __DIR__.'/../../vendor/autoload.php';
include_once __DIR__.'/../../app/includes/header.php';

use \App\Entidades\Produto;

$objProduto = new Produto;

if(!isset($data['id_produto'])){
    echo json_encode('error') ;

    exit;
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $objProduto->id_produto = $data['id_produto'];
    
    $objProduto->excluir();

    exit;
}