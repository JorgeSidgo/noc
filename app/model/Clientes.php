<?php

class Clientes extends ModeloBase
{
    private $codigoCliente;
    private $nombreCliente;
    private $direccion;
    private $telefono;
    private $codigo;

    public function __construct()
    {
        
    }

    public function getCodigoCliente()
    {
        return $this->codigoCliente;
    }

    /**
     * @return self
     */
    

    public function setCodigoCliente($codigoCliente)
    {

        $this->codigoCliente = $codigoCliente;

        return $this;
    }

    public function getNombreCliente()
    {
        return $this-> nombreCliente;
    }

     /**
     * @return self
     */
    

    public function setNombreCliente($nombreCliente)
    {

        $this ->nombreCliente = $nombreCliente;
        return $this;
    }


    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * @return self
     */
    

    public function setDireccion($direccion)
    {
        $this ->direccion = $direccion;
        return $this;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * @return self
     */
    
   
    public function setTelefono($telefono)
    {
        $this -> telefono = $telefono;
        return $this;
    }


    /**
     * Get the value of codigo
     */ 
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set the value of codigo
     *
     * @return  self
     */ 
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }
}

?>