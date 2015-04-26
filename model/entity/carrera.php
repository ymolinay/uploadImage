<?php

class Carrera {

    private $idCarrera;
    private $descripcion;
    private $periodos;
    private $meses;
    private $idCosto;

    function getIdCarrera() {
        return $this->idCarrera;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getPeriodos() {
        return $this->periodos;
    }

    function getMeses() {
        return $this->meses;
    }

    function getIdCosto() {
        return $this->idCosto;
    }

    function setIdCarrera($idCarrera) {
        $this->idCarrera = $idCarrera;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setPeriodos($periodos) {
        $this->periodos = $periodos;
    }

    function setMeses($meses) {
        $this->meses = $meses;
    }

    function setIdCosto($idCosto) {
        $this->idCosto = $idCosto;
    }

}
