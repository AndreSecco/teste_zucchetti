<?php 

require __DIR__.'/../../vendor/autoload.php';
include_once __DIR__.'/../../app/includes/header.php';

use \App\Entidades\Produto;

$objProduto = new Produto;

if($objProduto->validaDados($data) && $_SERVER['REQUEST_METHOD'] === 'POST'){
    
    $objProduto->nome_produto = $data['nome_produto'];
    $objProduto->quantidade   = $data['quantidade'];
    $objProduto->preco        = $data['preco'];

    $objProduto->cadastrar();

    exit;
}
