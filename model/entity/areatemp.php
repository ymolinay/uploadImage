<?php

class AreaTemp {
    
    private $idAreaTemp;
    private $idArea;
    private $descripcion;
    private $idSedeTemp;
    private $idAcceso;
    private $indicador;
    
    public function setIdAreaTemp($_idAreaTemp) {
        $this->idAreaTemp = $_idAreaTemp;
    }
    
    public function getIdAreaTemp() {
        return $this->idAreaTemp;
    }
    
    public function setIdArea($_idArea) {
        $this->idArea = $_idArea;
    }
    
    public function getIdArea() {
        return $this->idArea;
    }
    
    public function setDescripcion($_descripcion) {
        $this->descripcion = $_descripcion;
    }
    
    public function getDescripcion() {
        return $this->descripcion;
    }
    
    public function setIdSedeTemp($_idSedeTemp) {
        $this->idSedeTemp = $_idSedeTemp;
    }
    
    public function getIdSedeTemp() {
        return $this->idSedeTemp;
    }
    
    public function setIdAcceso($_idAcceso) {
        $this->idAcceso = $_idAcceso;
    }
    
    public function getIdAcceso() {
        return $this->idAcceso;
    }
 
    public function setIndicador($_indicador) {
        $this->indicador = $_indicador;
    }
    
    public function getIndicador() {
        return $this->indicador;
    }
    
    
}

