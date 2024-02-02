<?php

namespace App\Entidades;

use App\DB\Database;
use PDO;

class FormasPagamento
{

    public $id_forma_pagamento;

    public $nome_forma_pagamento;

    public $parcelas;

    public function validaDados($dados) 
    {
        if($dados['nome_forma_pagamento'] !== "" && $dados['parcelas'] !== ""){
            return true;
        } else {
            return false;
        }
    }

    public function cadastrar() 
    {
        $objDataBase = new Database('forma_pagamento');

        $this->id_forma_pagamento = $objDataBase->insert([
            'nome_forma_pagamento' => $this->nome_forma_pagamento,
            'parcelas'             => $this->parcelas,
        ]);

        return true;
    }

    public function getFormasPagamento($where = null, $order = null, $limit = null)
    {
        return (new Database('forma_pagamento'))->select($where, $order, $limit)
                                         ->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public function atualizar()
    {
        return (new Database('forma_pagamento'))->atualizar('id_forma_pagamento = '.$this->id_forma_pagamento, [
            'nome_forma_pagamento' => $this->nome_forma_pagamento,
            'parcelas'             => $this->parcelas,
        ]);
    }

    public function excluir()
    {
        return (new Database('forma_pagamento'))->delete('id_forma_pagamento = ' . $this->id_forma_pagamento);
    }
}
