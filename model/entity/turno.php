<?php

class Turno {

    private $idTurno;
    private $descripcion;
    private $indicador;

    function getIdTurno() {
        return $this->idTurno;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getIndicador() {
        return $this->indicador;
    }

    function setIdTurno($idTurno) {
        $this->idTurno = $idTurno;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setIndicador($indicador) {
        $this->indicador = $indicador;
    }

}
