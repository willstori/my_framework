<?php

namespace System;

use PDO;
use PDOException;
use PDOStatement;

/**
 * 
 * Classe responsável por instanciar um objeto que realizará consultas no banco de dados
 * 
 * @author Willian Stori
 */
class Database
{
    private $pdo;

    private $_strPrepare;

    private $paramsList;

    function __construct()
    {
        $host = env('DB_HOST');
        $user = env('DB_USER');
        $pass = env('DB_PASS');
        $dbname = env('DB_NAME');

        $dsn = "mysql:host={$host};dbname={$dbname};charset=utf8";

        try {

            $this->pdo = new PDO($dsn, $user, $pass, array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
            ));

        } catch (PDOException $e) {

            echo "Erro ao criar objeto PDO: " . $e->getMessage();
        }

        $this->paramsList = array();
    }

    /**
     * Método utilizado para inserir uma linha na Tabela do banco
     *
     * @param  string $table Nome da tabela que receberá os dados
     * @param  array $data Array de valores que serão adicionados
     * @return void
     */
    public function insert($table, $data)
    {

        $colunas = array_keys($data);

        $valores = array_values($data);

        $jokers = array_fill(0, count($colunas), '?');

        $str_prepare = "INSERT INTO {$table} (" . implode(" , ", $colunas) . ") VALUES (" . implode(" , ", $jokers) . ")";

        $stmt = $this->pdo->prepare($str_prepare);

        if (!$stmt->execute($valores)) {

            echo '<pre>';
            throw new PDOException("Erro ao realizar INSERT.");
            echo '</pre>';
        }
    }

    /**
     * Método utilizado para adicionar a instrução SELECT a consulta
     *
     * @param  string $columns String contendo as colunas que serão listadas
     * @return \System\Database
     */
    public function select($columns)
    {
        $this->_strPrepare = "SELECT " . $columns;

        return $this;
    }

    /**
     * Método utilizado para adicionar a instrução UPDATE a consulta
     *
     * @param  string $table Nome da tabela que sera alterada
     * @param  array $data Colunas com seus respectivos valores que serão alterados
     * @return \System\Database
     */
    public function update($table, $data)
    {

        $columns = array_keys($data);

        $strSet = "";

        foreach ($columns as $column) {

            $strSet .= $column . ' = :' . $column . ", ";
        }

        $strSet = rtrim($strSet, ", ");

        $this->_strPrepare = "UPDATE {$table} SET {$strSet}";

        $this->paramsList = array_merge($this->paramsList, $data);

        return $this;
    }
    
    /**
     * Método utilizado para adicionar a instrução DELETE a consulta 
     *
     * @param  string $table Nome da tabela que sofrerá o delete
     * @return \System\Database
     */
    public function delete($table)
    {
        $this->_strPrepare = "DELETE FROM {$table}";

        return $this;
    }

    /**
     * Método utilizado para adicionar a instrução FROM a consulta
     *
     * @param  string $table Nome da tabela adicionada a consulta
     * @return \System\Database
     */
    public function from($table)
    {
        $this->_strPrepare .= " FROM " . $table;

        return $this;
    }

    /**
     * Método utilizado para adicionar a instrução JOIN a consulta
     *
     * @param  string $table Nome da tabela que será anexada a consulta
     * @param  string $condition Condição para execução do comando
     * @return \System\Database
     */
    public function join($table, $condition)
    {
        $this->_strPrepare .= " JOIN {$table} ON {$condition}";

        return $this;
    }

    /**
     * Método utilizado para adicionar a instrução INNER JOIN a consulta
     *
     * @param  string $table Nome da tabela que será anexada a consulta
     * @param  string $condition Condição para execução do comando
     * @return \System\Database
     */
    public function innerJoin($table, $condition)
    {
        $this->_strPrepare .= " INNER JOIN {$table} ON {$condition}";

        return $this;
    }

    /**
     * Método utilizado para adicionar a instrução LEFT JOIN a consulta
     *
     * @param  string $table Nome da tabela que será anexada a consulta
     * @param  string $condition Condição para execução do comando
     * @return \System\Database
     */
    public function leftJoin($table, $condition)
    {
        $this->_strPrepare .= " LEFT JOIN {$table} ON {$condition}";

        return $this;
    }

    /**
     * Método utilizado para adicionar a instrução RIGHT JOIN a consulta
     *
     * @param  string $table Nome da tabela que será anexada a consulta
     * @param  string $condition Condição para execução do comando
     * @return \System\Database
     */
    public function rightJoin($table, $condition)
    {
        $this->_strPrepare .= " RIGHT JOIN {$table} ON {$condition}";

        return $this;
    }

    /**
     * Método utilizado para adicionar a instrução WHERE a consulta
     *
     * @param  string $where String com coringas (:coluna) para realização do where
     * @param  array $params Lista de parametros que serão utilizados no where
     * @return \System\Database
     */
    public function where($where, $params)
    {
        $this->_strPrepare .= " WHERE " . $where;

        $this->paramsList = array_merge($this->paramsList, $params);

        return $this;
    }

    /**
     * Método utilizado para adicionar a instrução ORDER BY a consulta
     *
     * @param  string $order String contendo as colunas junto com o sentido que serão ordenadas.
     * @return \System\Database
     */
    public function orderBy($order)
    {
        $this->_strPrepare .= " ORDER BY " . $order;

        return $this;
    }

    /**
     * Método utilizado para adicionar a instrução LIMIT a consulta
     *
     * @param int $offset Posição da linha do resultado da consulta
     * @param int $max Quantidade maxima de linhas que serão buscadas do resultado da consulta
     * @return \System\Database
     */
    public function limit($offset, $max)
    {
        $this->_strPrepare .= " LIMIT {$offset}, {$max}";

        return $this;
    }

    /**
     * Método utilizado para adicionar a instrução GROUP BY a consulta
     *
     * @param string $group String Contendo a lista de colunas separadas por virgulas que serão agrupadas
     * @return \System\Database
     */
    public function groupBy($group)
    {
        $this->_strPrepare .= " GROUP BY " . $group;

        return $this;
    }

    /**
     * Método utilizado para executar uma consulta
     *
     * @return PDOStatement
     */
    public function exec()
    {
        try {

            $stmt = $this->pdo->prepare($this->_strPrepare);

            if (!empty($this->paramsList)) {

                foreach ($this->paramsList as $param => $value) {
                    $stmt->bindValue(":" . $param, $value);
                }
            }

            if (!$stmt->execute()) {

                throw new PDOException("Erro ao executar consulta.");
            }

        } catch (PDOException $e) {

            echo "Erro ao realizar consulta: " . $e->getMessage() . "<br>";            

            echo "Arquivo: " . $e->getFile() . "<br>";

            echo "Linha: " . $e->getLine() . "<br>";
        }

        $this->_strPrepare = "";

        $this->paramsList = array();

        return $stmt;
    }

    /**
     * Método utilizado para retornar todas as linhas da consulta
     *
     * @return array
     */
    public function getAll()
    {
        $stmt = $this->exec();

        if ($stmt != null) {

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        return array();
    }

    /**
     * Método utilizado para retornar apenas uma linha da consulta
     *
     * @return array
     */
    public function get()
    {
        $stmt = $this->exec();

        if ($stmt != null) {

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        return array();
    }
    
    /**
     * Método utilizado para retornar a string de consulta 
     *
     * @return string
     */
    public function getStringPrepare()
    {
        return $this->_strPrepare;
    }
}
