<?php

class Curso {

    private $idCurso;
    private $nombre;
    private $indicador;

    function getIdCurso() {
        return $this->idCurso;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getIndicador() {
        return $this->indicador;
    }

    function setIdCurso($idCurso) {
        $this->idCurso = $idCurso;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setIndicador($indicador) {
        $this->indicador = $indicador;
    }



}
