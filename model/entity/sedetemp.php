<?php

class SedeTemp {
    
    private $idSedeTemp;
    private $idSede;
    private $descripcion;
    private $direccion;
    private $idUbigeo;
    private $idAcceso;
    private $indicador;
    
    public function setIdSedeTemp($_idSedeTemp) {
        $this->idSedeTemp = $_idSedeTemp;
    }
    
    public function getIdSedeTemp() {
        return $this->idSedeTemp;
    }
    
    public function setIdSede($_idSede) {
        $this->idSede = $_idSede;
    }
    
    public function getIdSede() {
        return $this->idSede;
    }
    
    public function setDescripcion($_descripcion) {
        $this->descripcion = $_descripcion;
    }
    
    public function getDescripcion() {
        return $this->descripcion;
    }
    
    public function setDireccion($_direccion) {
        $this->direccion = $_direccion;
    }
    
    public function getDireccion() {
        return $this->direccion;
    }
    
    public function setIdUbigeo($_idUbigeo) {
        $this->idUbigeo = $_idUbigeo;
    }
    
    public function getIdUbigeo() {
        return $this->idUbigeo;
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