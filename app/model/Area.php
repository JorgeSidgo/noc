<?php 

class Area extends ModeloBase {

    private $codigoArea;
    private $descArea;

    public function __construct() {

    }


    /**
     * Get the value of codigoArea
     */ 
    public function getCodigoArea()
    {
        return $this->codigoArea;
    }

    /**
     * Set the value of codigoArea
     *
     * @return  self
     */ 
    public function setCodigoArea($codigoArea)
    {
        $this->codigoArea = $codigoArea;

        return $this;
    }

    /**
     * Get the value of descArea
     */ 
    public function getDescArea()
    {
        return $this->descArea;
    }

    /**
     * Set the value of descArea
     *
     * @return  self
     */ 
    public function setDescArea($descArea)
    {
        $this->descArea = $descArea;

        return $this;
    }
}