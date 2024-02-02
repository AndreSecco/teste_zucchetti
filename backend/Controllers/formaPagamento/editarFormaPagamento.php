<?php 

require __DIR__.'/../../vendor/autoload.php';
include_once __DIR__.'/../../app/includes/header.php';

use \App\Entidades\FormasPagamento;

$objFormaPagamento = new FormasPagamento;

if(!isset($data['id_forma_pagamento'])){
    echo json_encode('error') ;

    exit;
}

if($objFormaPagamento->validaDados($data)){
    
    $objFormaPagamento->id_forma_pagamento    = $data['id_forma_pagamento'];
    $objFormaPagamento->nome_forma_pagamento  = $data['nome_forma_pagamento'];
    $objFormaPagamento->parcelas              = $data['parcelas'];

    $objFormaPagamento->atualizar();

    exit;
}