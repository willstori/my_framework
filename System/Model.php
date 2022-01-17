<?php

namespace System;

use Exception;
use System\Database;

/**
 * Classe responsável por instanciar um prover os métodos basicos para manipulação de modelos
 */
class Model
{
    protected $_table;

    protected $_fillable;

    protected $_id;

    protected $db;

    function __construct()
    {
        $this->db = new Database();
    }
    
    /**
     * Método responsável por buscar uma linha na tabela
     *
     * @param  int $id Id da linha que será retornada
     * @return array
     */
    public function find($id)
    {
        $this->db->select("*");
        $this->db->from($this->_table);
        $this->db->where("{$this->_id} = :id", array('id' => $id));

        return $this->db->get();
    }
    
    /**
     * Método responsável por retornar todas as linha da tabela
     *
     * @param  string $order Colunas que serão ordenadas e o sentido da ordenação
     * @return array
     */
    public function all($order = null)
    {
        $this->db->select("*");
        $this->db->from($this->_table);
        $this->db->orderBy($order != '' ? $order : $this->_id . " ASC");

        return $this->db->getAll();
    }
    
    /**
     * Método responsável por contar todas as linhas da tabela
     *
     * @return int
     */
    public function count()
    {
        $this->db->select("COUNT(*)");
        $this->db->from($this->_table); 

        return $this->db->get();       
    }
    
    /**
     * Método responsável por adicionar ou alterar uma linha da tabela
     *
     * @param  array $data Dados que serão inseridos ou alterados
     * @param  int $id Id da linha que será alterada
     * @return void
     */
    public function save($data, $id = null)
    {

        $atributos = array_keys($data);

        foreach($atributos as $atributo){

            if(!in_array($atributo, $this->_fillable)){

                throw new Exception("O atributo {$atributo} não faz parte do modelo {$this->_table}.");

                return ;
            }
        }

        if($id == null){

            $this->db->insert($this->_table, $data);

        }else{

            $this->db->update($this->_table, $data);

            $this->db->where("{$this->_id} = :id", array('id' => $id));

            $this->db->exec();

        }
        
    }
    
    /**
     * Método responsável por eliminar uma linha da tabela
     *
     * @param  int $id Id da linha que será eliminada
     * @return void
     */
    public function delete($id)
    {
        $this->db->delete($this->_table);
        $this->db->where("{$this->_id} = :id", array('id' => $id));
        $this->db->exec();
    }
}
