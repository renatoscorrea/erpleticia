<?php
namespace library\erpleticia\gateway;

/*
 * classe RowGateway
 */
abstract class RowGateway
{
    
    public function getTable()
    {
        
    }
    
    public function save()
    {
    }
    
    public function load()
    {
    }
    
    public function delete()
    {
    }
    
    public static function find($id)
    {
    }
    
    /*
     * Verifica se o registro é novo (ainda não foi salvo).
     */
    public function isNew() 
    {
    }
    
    /*
     * Verifica se o registro foi modificado desde a última vez que foi salvo.
     */
    public function isDirty()
    {
    }
    
    /*
     * Retorna os dados do registro como um array.
     */
    public function toArray()
    {
    }
    
    /*
     *  Retorna os dados do registro como um array associativo.
     */
    public function toAssocArray()
    {
    }
    
}
