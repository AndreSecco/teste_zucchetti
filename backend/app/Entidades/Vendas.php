<?php

namespace App\Entidades;

use App\DB\Database;
use App\Entidades\Produto;
use PDO;

class Vendas
{

    public $id_venda;

    public $cliente_venda;

    public $produto_venda;

    public $forma_pagamento_venda;

    public $parcelas;

    public $data_venda;

    public $total_venda;

    public $itens_venda;

    public function validaDados($dados)
    {
        if ($dados['nome_forma_pagamento'] !== "" && $dados['parcelas'] !== "") {
            return true;
        } else {
            return false;
        }
    }

    public function cadastrar()
    {
        $objDataBase = new Database('vendas');

        $this->id_venda = $objDataBase->insert([
            'cliente_venda'         => $this->cliente_venda,
            'id_venda'              => $this->id_venda,
            'forma_pagamento_venda' => $this->forma_pagamento_venda,
            'parcelas'              => $this->parcelas,
            'total_venda'           => $this->total_venda,
        ]);

        return true;
    }

    public function cadastrarItens()
    {
        $objDataBase = new Database('itens_venda');

        $itens_venda = $this->itens_venda;
        
        foreach ($itens_venda as $item) {
            $objDataBase->insert([
                'id_produto'    => $item['id_produto'],
                'quantidade'    => $item['quantidade'],
                'preco'         => $item['preco'],
                'id_venda'      => $this->id_venda
            ]);

            $this->baixaEstoque($item);
        }
    }

    public function baixaEstoque($item)
    {
        $quantidade_produto = (new Database('produtos'))->select("id_produto = " . $item['id_produto'])
        ->fetchObject(Produto::class);

        $quantidade_produto->quantidade -= $item['quantidade'];

        return (new Database('produtos'))->atualizar(' id_produto = ' . $item['id_produto'], [
            'quantidade' => $quantidade_produto->quantidade,
        ]);
    }

    public function getVendas($where = null, $order = null, $limit = null, $join = null)
    {
        return (new Database('vendas'))->select($where, $order, $limit, 'clientes on vendas.cliente_venda = clientes.id_cliente')
            ->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public function getVendasCliente($where = null, $order = null, $limit = null, $join = null)
    {
        return (new Database('vendas'))->select('vendas.cliente_venda = '.$this->cliente_venda, $order, $limit, 
                                                'clientes on vendas.cliente_venda = clientes.id_cliente')
            ->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public function getProdutoVenda()
    {
        return (new Database('produtos'))->select("nome_produto LIKE '%" . $this->produto_venda . "%'")
            ->fetchAll(PDO::FETCH_CLASS, Produto::class);
    }

    public function excluir()
    {
        return (new Database('vendas'))->delete('id_venda = ' . $this->id_venda);
    }
}
