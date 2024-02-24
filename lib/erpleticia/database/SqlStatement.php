<?php
namespace erpleticia\database;

use erpleticia\database\Criteria;

/**
 * Provides an abstract Interface to create a SQL statement
 *
 */
abstract class TSqlStatement
{
    protected $sql;         // stores the SQL instruction
    protected $criteria;    // stores the select criteria
    protected $entity;
    
    /**
     * defines the database entity name
     * @param $entity Name of the database entity
     */
    final public function setEntity($entity)
    {
        $this->entity = $entity;
    }
    
    /**
     * Returns the database entity name
     */
    final public function getEntity()
    {
        return $this->entity;
    }
    
    /**
     * Define a select criteria
     * @param $criteria  An TCriteria object, specifiyng the filters
     */
    public function setCriteria(TCriteria $criteria)
    {
        $this->criteria = $criteria;
    }
    
    /**
     * Returns a random parameter
     */
    protected function getRandomParameter()
    {
        return mt_rand(1000000000, 1999999999);
    }
    
    // force method rewrite in child classes
    abstract function getInstruction();
}

