<?php
Class EstadoMatricula{
    private $idEstadoMatricula;
    private $descripcion;
    private $indicador;
    
    function getIdEstadoMatricula() {
        return $this->idEstadoMatricula;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getIndicador() {
        return $this->indicador;
    }

    function setIdEstadoMatricula($idEstadoMatricula) {
        $this->idEstadoMatricula = $idEstadoMatricula;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setIndicador($indicador) {
        $this->indicador = $indicador;
    }


}