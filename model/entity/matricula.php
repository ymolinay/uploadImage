<?php

class Matricula{
    private $idMatricula;
    private $Fecha;
    private $Hora;
    private $idUsuarioCarrera;
    private $idCiclo;
    private $idSeccion;
    private $idSede;
    private $idTipoBeneficio;
    private $idEstadoMatricula;
    private $Indicador;
    
    function getIdMatricula() {
        return $this->idMatricula;
    }

    function getFecha() {
        return $this->Fecha;
    }

    function getHora() {
        return $this->Hora;
    }

    function getIdUsuarioCarrera() {
        return $this->idUsuarioCarrera;
    }

    function getIdCiclo() {
        return $this->idCiclo;
    }

    function getIdSeccion() {
        return $this->idSeccion;
    }

    function getIdSede() {
        return $this->idSede;
    }

    function getIdTipoBeneficio() {
        return $this->idTipoBeneficio;
    }

    function getIdEstadoMatricula() {
        return $this->idEstadoMatricula;
    }

    function getIndicador() {
        return $this->Indicador;
    }

    function setIdMatricula($idMatricula) {
        $this->idMatricula = $idMatricula;
    }

    function setFecha($Fecha) {
        $this->Fecha = $Fecha;
    }

    function setHora($Hora) {
        $this->Hora = $Hora;
    }

    function setIdUsuarioCarrera($idUsuarioCarrera) {
        $this->idUsuarioCarrera = $idUsuarioCarrera;
    }

    function setIdCiclo($idCiclo) {
        $this->idCiclo = $idCiclo;
    }

    function setIdSeccion($idSeccion) {
        $this->idSeccion = $idSeccion;
    }

    function setIdSede($idSede) {
        $this->idSede = $idSede;
    }

    function setIdTipoBeneficio($idTipoBeneficio) {
        $this->idTipoBeneficio = $idTipoBeneficio;
    }

    function setIdEstadoMatricula($idEstadoMatricula) {
        $this->idEstadoMatricula = $idEstadoMatricula;
    }

    function setIndicador($Indicador) {
        $this->Indicador = $Indicador;
    }


}