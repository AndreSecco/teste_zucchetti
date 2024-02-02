<?php

namespace App\Entidades;

use App\DB\Database;
use PDO;

class Cliente
{

    public $id_cliente;

    public $nome_cliente;

    public $cpf;

    public $email;

    public $endereco;

    public $cep;

    public $bairro;

    public $cidade;

    public $numero;

    public function validaDados($dados) 
    {
        if($dados['nome'] !== "" && $dados['cpf'] !== "" && $dados['email'] !== ""){
            return true;
        } else {
            return false;
        }
    }

    public function cadastrar() 
    {
        $objDataBase = new Database('clientes');

        $this->id_cliente = $objDataBase->insert([
            'nome_cliente' => $this->nome_cliente,
            'cpf'          => $this->cpf,
            'email'        => $this->email,
            'endereco'     => $this->endereco,
            'cep'          => $this->cep,
            'bairro'       => $this->bairro,
            'cidade'       => $this->cidade,
            'numero'       => $this->numero,
        ]);

        return true;
    }

    public function getClientes($where = null, $order = null, $limit = null)
    {
        return (new Database('clientes'))->select($where, $order, $limit)
                                         ->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public function getCliente($id)
    {
        return (new Database('clientes'))->select('id_cliente ='.$id)
                                         ->fetchObject(self::class);
    }

    public function atualizar()
    {
        return (new Database('clientes'))->atualizar('id_cliente = '.$this->id_cliente, [
            'nome_cliente' => $this->nome_cliente,
            'cpf'          => $this->cpf,
            'email'        => $this->email,
            'endereco'     => $this->endereco,
            'cep'          => $this->cep,
            'bairro'       => $this->bairro,
            'cidade'       => $this->cidade,
            'numero'       => $this->numero,
        ]);
    }

    public function excluir()
    {
        return (new Database('clientes'))->delete('id_cliente = ' . $this->id_cliente);
    }
}
