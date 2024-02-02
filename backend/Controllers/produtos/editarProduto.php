<?php 

require __DIR__.'/../../vendor/autoload.php';
include_once __DIR__.'/../../app/includes/header.php';

use \App\Entidades\Produto;

$objProduto = new Produto;

if(!isset($data['id_produto'])){
    echo json_encode('error') ;

    exit;
}

if($objProduto->validaDados($data)){
    
    $objProduto->id_produto   = $data['id_produto'];
    $objProduto->nome_produto = $data['nome_produto'];
    $objProduto->quantidade   = $data['quantidade'];
    $objProduto->preco        = $data['preco'];

    $objProduto->atualizar();

    exit;
}