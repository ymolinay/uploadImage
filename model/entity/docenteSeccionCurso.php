<?php

class DocenteSeccionCurso {
    private $idDocenteSeccionCurso;
    private $idSeccion;
    private $idUsuario;
    private $idPlanEstudio;
    private $indicador;
    
    function getIdDocenteSeccionCurso() {
        return $this->idDocenteSeccionCurso;
    }

    function getIdSeccion() {
        return $this->idSeccion;
    }

    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getIdPlanEstudio() {
        return $this->idPlanEstudio;
    }

    function getIndicador() {
        return $this->indicador;
    }

    function setIdDocenteSeccionCurso($idDocenteSeccionCurso) {
        $this->idDocenteSeccionCurso = $idDocenteSeccionCurso;
    }

    function setIdSeccion($idSeccion) {
        $this->idSeccion = $idSeccion;
    }

    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    function setIdPlanEstudio($idPlanEstudio) {
        $this->idPlanEstudio = $idPlanEstudio;
    }

    function setIndicador($indicador) {
        $this->indicador = $indicador;
    }


}
