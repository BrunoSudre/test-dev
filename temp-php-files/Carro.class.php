<?php
/**
 * Classe do carro
 * 
 * @author Bruno Sudré <bruninhosudre@gmail.com>
 * @since 05/06/2019
 */

class Carro 
{
    private $_id;
    private $_marca;
    private $_modelo;
    private $_ano;
    
    public function __construct($id, $marca, $modelo, $ano) 
    {
        $this->_id = $id;
        $this->_marca = $marca;
        $this->_modelo = $modelo;
        $this->_ano = $ano;
    }
}

?>