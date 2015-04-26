<?php

class Sede {

    private $idSede;
    private $descripcion;
    private $direccion;
    private $idCuenta;
    private $idUbigeo;
    private $indicador;

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
    
    public function setIdCuenta($_idCuenta) {
        $this->idCuenta = $_idCuenta;
    }
    
    public function getIdCuenta() {
        return $this->idCuenta;
    }
    
    public function setIdUbigeo($_idUbigeo) {
        $this->idUbigeo = $_idUbigeo;
    }
    
    public function getIdUbigeo() {
        return $this->idUbigeo;
    }
    
    public function setIndicador($_indicador) {
        $this->indicador = $_indicador;
    }
    
    public function getIndicador() {
        return $this->indicador;
    }
    
}
