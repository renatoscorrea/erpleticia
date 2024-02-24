<?php
namespace erpleticia\database;

use erpleticia\database\Expression;

/*
 * classe Expression
 */
class Criteria extends Expression
{
    private $expressions; // amazena a lista de expressões
    private $operators;   // amazena a lista de operadores
    private $properties;  // propriedades do critério
    private $caseInsensitive;
    
    function __construct()
    {
        $this->expressions = array();
        $this->operators   = array();
        
        $this->properties['order']     = '';
        $this->properties['offset']    = 0;
        $this->properties['direction'] = '';
        $this->properties['group']     = '';

        $this->caseInsensitive = FALSE;
    }
    
    

}
