<?php
namespace erpleticia\database;

/*
* classe Expression
* classe abstrata para gerencias expressões
*/

abstract class Expression
{
    // operadores lógicos
    const AND_OPERATOR = 'AND ';
    const OR_OPERATOR  = 'OR ';
    
    // force method rewrite in child classes
    abstract public function dump();
}
 
