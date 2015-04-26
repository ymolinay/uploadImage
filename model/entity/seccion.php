<?php

class Seccion {

    private $idSeccion;
    private $descripcion;
    private $cantMaxima;
    private $inicio;
    private $fin;
    private $anioCreacion;
    private $idTurno;
    private $idCarrera;
    private $idCiclo;
    private $indicador;

    function getIdSeccion() {
        return $this->idSeccion;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getCantMaxima() {
        return $this->cantMaxima;
    }

    function getInicio() {
        return $this->inicio;
    }

    function getFin() {
        return $this->fin;
    }

    function getAnioCreacion() {
        return $this->anioCreacion;
    }

    function getIdTurno() {
        return $this->idTurno;
    }

    function getIdCarrera() {
        return $this->idCarrera;
    }

    function getIdCiclo() {
        return $this->idCiclo;
    }

    function getIndicador() {
        return $this->indicador;
    }

    function setIdSeccion($idSeccion) {
        $this->idSeccion = $idSeccion;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setCantMaxima($cantMaxima) {
        $this->cantMaxima = $cantMaxima;
    }

    function setInicio($inicio) {
        $this->inicio = $inicio;
    }

    function setFin($fin) {
        $this->fin = $fin;
    }

    function setAnioCreacion($anioCreacion) {
        $this->anioCreacion = $anioCreacion;
    }

    function setIdTurno($idTurno) {
        $this->idTurno = $idTurno;
    }

    function setIdCarrera($idCarrera) {
        $this->idCarrera = $idCarrera;
    }

    function setIdCiclo($idCiclo) {
        $this->idCiclo = $idCiclo;
    }

    function setIndicador($indicador) {
        $this->indicador = $indicador;
    }



}
