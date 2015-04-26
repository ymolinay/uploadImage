<?php

class MatriculaDetalle{
    private $idMatriculaDetalle;
    private $idMatricula;
    private $idPlanEstudio;
    private $indicador;
    
    function getIdMatriculaDetalle() {
        return $this->idMatriculaDetalle;
    }

    function getIdMatricula() {
        return $this->idMatricula;
    }

    function getIdPlanEstudio() {
        return $this->idPlanEstudio;
    }

    function getIndicador() {
        return $this->indicador;
    }

    function setIdMatriculaDetalle($idMatriculaDetalle) {
        $this->idMatriculaDetalle = $idMatriculaDetalle;
    }

    function setIdMatricula($idMatricula) {
        $this->idMatricula = $idMatricula;
    }

    function setIdPlanEstudio($idPlanEstudio) {
        $this->idPlanEstudio = $idPlanEstudio;
    }

    function setIndicador($indicador) {
        $this->indicador = $indicador;
    }


}