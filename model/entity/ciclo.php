<?php

class Ciclo{
    private $idCiclo;
    private $descripcion;
    private $indicador;
    
    function getIdCiclo() {
        return $this->idCiclo;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getIndicador() {
        return $this->indicador;
    }

    function setIdCiclo($idCiclo) {
        $this->idCiclo = $idCiclo;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setIndicador($indicador) {
        $this->indicador = $indicador;
    }


}