<?php

namespace App\Entidades;

use App\DB\Database;
use PDO;

class Produto
{

    public $id_produto;

    public $nome_produto;

    public $quantidade;

    public $preco;

    public function validaDados($dados) 
    {
        if($dados['nome_produto'] !== "" && $dados['quantidade'] !== "" && $dados['preco'] !== ""){
            return true;
        } else {
            return false;
        }
    }

    public function cadastrar() 
    {
        $objDataBase = new Database('produtos');

        $this->id_produto = $objDataBase->insert([
            'nome_produto' => $this->nome_produto,
            'quantidade'   => $this->quantidade,
            'preco'        => $this->preco
        ]);

        return true;
    }

    public function getProdutos($where = null, $order = null, $limit = null)
    {
        return (new Database('produtos'))->select($where, $order, $limit)
                                         ->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public function getProduto($id)
    {
        return (new Database('produtos'))->select('id_produto ='.$id)
                                         ->fetchObject(self::class);
    }

    public function atualizar()
    {
        return (new Database('produtos'))->atualizar('id_produto = '.$this->id_produto, [
            'nome_produto' => $this->nome_produto,
            'quantidade'   => $this->quantidade,
            'preco'        => $this->preco
        ]);
    }

    public function excluir()
    {
        return (new Database('produtos'))->delete('id_produto = ' . $this->id_produto);
    }
}
