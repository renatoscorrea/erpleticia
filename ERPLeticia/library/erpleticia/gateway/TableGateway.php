<?php
namespace library\erpleticia\gateway;

/*
 * classe TableGateway
 */
abstract class TableGateway
{
    
    public function getTable()
    {  
    }
    
    /*
     * Salva um registro na tabela, seja inserindo ou atualizando.
     */
    public function save()
    {
    }
    
    public function load()
    {
    }
    
    public function delete()
    {
    }
    
    /*
     * Seleciona todos os registros da tabela.
     */
    public function selectAll()
    {
    }

    /*
     *  Exclui um registro da tabela com base em uma condição.
     */
    public function deleteWhere($where)
    {
    }
  
    /*
     * Retorna o número de registros na tabela.
     */
    public function count()
    {
    }
    
    /*
     *  Encontra um registrona tabela por seu ID.
     */
    public function find($id) 
    {
    }
    
    /*
     * Encontra um registro na tabela por um valor específico em uma coluna.
     */
    public function findBy($column, $value)
    {
    }
 
    /*
     *Apaga todos os registros da tabela
     */
    public function truncate() 
    {
    }
    
    /*
     * Inicia uma transação.
     */
    public function beginTransaction()
    {
    }
    
    /*
     * Finaliza uma transação com sucesso.
     */
    public function commit()
    {
    }
    
    /*
     *  Desfaz as alterações feitas em uma transação.
     */
    public function rollback()
    {
    }
    
}
