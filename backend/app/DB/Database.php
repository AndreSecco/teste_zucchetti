<?php

namespace App\DB;

use PDOException;
use \PDO;

class Database
{
    private $HOST;

    private $NAME;

    private $USER;

    private $PASS;

    private $table;
    private $connection;

    public function __construct($table = null)
    {
        $this->table = $table;
        $this->setConfigBD();
        $this->setConnection();
    }

    public function setConfigBD()
    {
        if($_SERVER['HTTP_HOST'] == 'andrecode.com.br'){
            
            // Configuração do banco em produção

            $this->HOST = 'mysql742.umbler.com';

            $this->NAME = 'teste_zucchetti';
        
            $this->USER = 'root_andre';
        
            $this->PASS = 'andre2023';

        } else {

            //Configuração do banco localhost

            $this->HOST = 'localhost';

            $this->NAME = 'teste_zucchetti';
        
            $this->USER = 'root';
        
            $this->PASS = '';
        }
    }

    private function setConnection()
    {
        try {
            $this->connection = new PDO('mysql:host=' . $this->HOST . ';dbname=' . $this->NAME, $this->USER, $this->PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function executar($query, $params = [])
    {
        try {
            $query_execucao = $this->connection->prepare($query);
            $query_execucao->execute($params);

            return $query_execucao;
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function insert($valores)
    {
        $campos = array_keys($valores);
        $dados = array_pad([], count($campos), '?');

        $query = 'INSERT INTO ' . $this->table . ' (' . implode(',', $campos) . ') VALUES (' . implode(',', $dados) . ')';

        $this->executar($query, array_values($valores));

        return $this->connection->lastInsertId();
    }

    public function select($where = null, $order = null, $limit = null, $join = null, $fields = '*')
    {
        $where = strlen($where) ? 'WHERE ' . $where : '';
        $order = strlen($order) ? 'ORDER BY ' . $order : '';
        $limit = strlen($limit) ? 'LIMIT ' . $limit : '';
        $join  = strlen($join)  ? 'JOIN ' . $join : '';

        $query = 'SELECT ' . $fields . ' FROM ' . $this->table . ' ' . $join . ' ' . $where . ' ' . $order . ' ' . $limit;
        // echo "<pre>"; print_r($query); echo "</pre>"; exit;

        return $this->executar($query);
    }

    public function atualizar($where, $valores)
    {
        $fields = array_keys($valores);

        $query = 'UPDATE ' . $this->table . ' SET ' . implode('=?,', $fields) . '=? WHERE ' . $where;

        $this->executar($query, array_values($valores));

        return true;
    }

    public function delete($where)
    {
        $query = 'DELETE FROM ' . $this->table . ' WHERE ' . $where;

        $this->executar($query);

        return true;
    }
}
