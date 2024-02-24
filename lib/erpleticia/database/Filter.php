<?php
namespace erpleticia\database;

use erpleticia\database\Expression;

/*
* classe Filter
* classe provê uma interface para definicção de filtros de seleção
*/

class Filter extends Expression
{
    private $variable; // variavel
    private $operator; // operador
    private $value;    // valor
    private $value2;
    private $preparedVars;
    private $caseInsensitive;

   /** metodo __construct()
    * instancia um novo filtros
    * @param $variable = variavel
    * @param $operator = operador (>, <, =, BETWEEN)
    * @param $value    = valor  
    * @param $value2   = segundo valor para se comparado (BETWEEN)
    */

    function __construct($variable, $operator, $value, $value2 = NULL)
    {
        //amarzena as propriedades
        $this->variable = $variable;
        $this->operator = $operator;
        $this->preparedVars = array();
        
        // transforme o valor de acordo com seu tipo
        $this->value    = $value;
        
        if ($value2)
        {
            $this->value2 = $value2;
        }
        $this->caseInsensitive = FALSE;
    }
    
    /**
    * Transforma o valor de acordo com os tipos PHP
    * antes de envia-los para o banco de dados
    * @param $value    Valor a ser transformado
    * @param $prepared Se o valor for preparado
    * @return       Valor transdormado
    */
    private function transform($value, $prepared = FALSE)
    {
        
        if(is_array($value)) //caso seja um array
        {
            $foo = array();
            
            foreach($value as $x) //percorre os valores
            {
                if(is_numeric($x)) //se o valor é um inteiro
                {
                    if ($prepared)
                    {
                        $preparedVar = ':par_'.$this->getRandomParameter();
                        $this->preparedVars[ $preparedVar ] = $x;
                        $foo[] = $preparedVar;
                    }
                    else
                    {
                        $foo[] = $x;
                    }
                }
                else if(is_string($x)) //se o valor é uma string, adiciona aspa
                {
                    if ($prepared)
                    {
                        $preparedVar = ':par_'.$this->getRandomParameter();
                        $this->preparedVars[ $preparedVar ] = $x;
                        $foo[] = $preparedVar;
                    }
                    else
                    {
                        $foo[] = "'$x'";
                    }
                }
                else if (is_bool($x))
                {
                    $foo[] = ($x) ? 'TRUE' : 'FALSE';
                }
            }
            
            $result = '(' . implode(',', $foo) . ')'; //converte o array em string separada por virgula
        }
        // se o valor for uma subseleção (não deve ser escapado como string)
        else if (substr(strtoupper( (string) $value),0,7) == '(SELECT')
        {
            $value  = str_replace(['#', '--', '/*'], ['', '', ''], $value);
            $result = $value;
        }
        // se o valor não deve ser escapado (NOESC na frente)
        else if (substr( (string) $value,0,6) == 'NOESC:')
        {
            $value  = str_replace(['#', '--', '/*'], ['', '', ''], $value);
            $result = substr($value,6);
        }
        // se o valor é uma string,
        else if (is_string($value))
        {
            if ($prepared)
            {
                $preparedVar = ':par_'.$this->getRandomParameter();
                $this->preparedVars[ $preparedVar ] = $value;
                $result = $preparedVar;
            }
            else
            {
                // adiciona aspas
                $result = "'$value'";
            }
        }
        // se o valor é NULL
        else if (is_null($value))
        {
            // the result is 'NULL'
            $result = 'NULL';
        }
        // se o valor é boolean
        else if (is_bool($value))
        {
            // o resultado é 'TRUE' of 'FALSE'
            $result = $value ? 'TRUE' : 'FALSE';
        }
        // se o valor é Expression object
        else if ($value instanceof Expression)
        {
            // o resultado é o retorno do getInstruction()
            $result = '(' . $value->getInstruction() . ')';
        }
        else
        {
            if ($prepared)
            {
                $preparedVar = ':par_'.$this->getRandomParameter();
                $this->preparedVars[ $preparedVar ] = $value;
                $result = $preparedVar;
            }
            else
            {
                $result = $value;
            }
        }
        // returns the result
        return $result;
    }
    
    /**
     * 
     * Retornar o filtro como uma expressão de string
     * @return Uma string contendo o filtro
     */
    public function dump( $prepared = FALSE )
    {
        $this->preparedVars = array();
        $value = $this->transform($this->value, $prepared);
        if ($this->value2)
        {
            $value2 = $this->transform($this->value2, $prepared);
            
            return "{$this->variable} {$this->operator} {$value} AND {$value2}"; // concatena a expressão
        }
        else
        {
            $variable = $this->variable;
            $operator = $this->operator;

            if ($this->caseInsensitive && stristr(strtolower($operator),'like') !== FALSE)
            {
                $variable = "UPPER({$variable})";
                $value = "UPPER({$value})";
                $operator = 'like';
            }
            return "{$variable} {$operator} {$value}"; // concatena a expressão
        }
    }
    
    /**
     * Retorna o prepared vars
     */
    public function getPreparedVars()
    {
        return $this->preparedVars;
    } 
 
   /**
     * Retorna um parâmetro aleatório
     */
    private function getRandomParameter()
    {
        return mt_rand(1000000000, 1999999999);
    }

    /**
     * Forçar pesquisas sem distinção entre maiúsculas e minúsculas
     */
    public function setCaseInsensitive(bool $value) : void
    {
        $this->caseInsensitive = $value;
    }

    /**
     * Retornar se a distinção entre maiúsculas e minúsculas estiver ativada
     */
    public function getCaseInsensitive() : bool
    {
        return $this->caseInsensitive;
    }
}
 
