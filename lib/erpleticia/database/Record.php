<?php
namespace erpleticia\database;

/*
 * classe Record
 */
 abstract class Record 
 {
    protected $data; //array contendo os dados do objeto
    
    /*
     * metodo __construct()
     * instancia um objeto. Se passar o $id, ja carregfa o objeto.
     * @param [$id] = ID do objeto
     */
     
     public function __construct($id = NULL)
     {
        if($id) //se o ID for informado
        {
            $object = $this->load($id);//carrega o objeto correspondente
            if($object)
            {
                $this->fromArray($object->toArray());
            }
        }
     }
     
     /*
     * metodo __clone()
     * excutado qunado um objeto for clonado.
     * limpa o idpara que seja gerado um nnovo ID para o clone
     */
     public function __clone()
     {
        unset($this->data['id');
        
     }
     
     /* metodo __set()
      * executado sempre que um propriedade for atribuida
      */
    private function __set($property, $value)
    {
        //verifica se existe o metodo set_<propriedade>
        if(method_exists($this, 'set_'.$property))
        {
           //executa o metodo set_<propriedade>
           call_user_func(array($this, 'set_'.$property), $value);      
        }
        else 
        {   //atribui o valor da propriedade
            $this->data[$property];
        }
    }
     
    /* metodo __set()
     * executado sempre que um propriedade for atribuida
     */
    public function __get($property, $value)
    {
        //verifica se existe o metodo get_<propriedade>
        if(method_exists($this, 'get_'.$property))
        {
           //executa o metodo get_<propriedade>
           return call_user_func(array($this, 'get_'.$property), $value);      
        }
        else 
        {   
            if(isset($this->data[$property]))
            {
                //atribui o valor da propriedade
                return $this->data[$property];
            }
        }
    } 
    
    /*
     * testa a presença de um valor no objeto
     */
    public function __isset($property)
    {
        return isset($this->data[$property]);
    }
    
    /*
     * metodo getEntity
     * retorna o nome da entidade (tabela)
     */
    public function getEntity()
    {
        $class = get_class($this);
        return constant("{class}::TABLENAME");
    }
    
    /*
     * metodo fromArray   
     * preenche os dados do objeto como array
     */
    public function fromArray($data)
    {
        $this->data = $data;
    }
    
    /*
     * metodo toArray   
     * retorna os dados do objeto como array
     */
    public function toArray($data)
    {
        return $this->data;
    }
    
    /* metodo store()
     * amarzena o objeto na base de dados e retorna o numero de linhas afetadas (zero ou um).
     */
    public function store()
    {
        
    }
    
    
    
    
    
        
    
     
     
 
 
 }
 
