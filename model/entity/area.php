<?php

class Area {

    private $idArea;
    private $descripcion;
    private $idSede;
    private $indicador;

    function setIdArea($_idArea) {
        $this->idArea = $_idArea;
    }

    function getIdArea() {
        return $this->idArea;
    }
    
    function setDescripcion($_descripcion) {
        $this->descripcion = $_descripcion;
    }
    
    function getDescripcion() {
        return $this->descripcion;
    }
    
    function setIdSede($_idSede) {
        $this->idSede = $_idSede;
    }
    
    function getIdSede() {
        return $this->idSede;
    }
    
    function setIndicador($_indicador) {
        $this->indicador = $_indicador;
    }
    
    function getIndicador() {
        return $this->indicador;
    }

}
