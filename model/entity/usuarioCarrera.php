<?php

class UsuarioCarrera{
    private $idUsuarioCarrera;
    private $idCarrera;
    private $idUsuario;
    //private $idTipoBeneficio;
    private $fecha;
    private $hora;
    private $indicador;

    function getIdUsuarioCarrera() {
        return $this->idUsuarioCarrera;
    }

    function getIdCarrera() {
        return $this->idCarrera;
    }

    function getIdUsuario() {
        return $this->idUsuario;
    }

//    function getIdTipoBeneficio() {
//        return $this->idTipoBeneficio;
//    }

    function getFecha() {
        return $this->fecha;
    }

    function getHora() {
        return $this->hora;
    }

    function getIndicador() {
        return $this->indicador;
    }

    function setIdUsuarioCarrera($idUsuarioCarrera) {
        $this->idUsuarioCarrera = $idUsuarioCarrera;
    }

    function setIdCarrera($idCarrera) {
        $this->idCarrera = $idCarrera;
    }

    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

//    function setIdTipoBeneficio($idTipoBeneficio) {
//        $this->idTipoBeneficio = $idTipoBeneficio;
//    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setHora($hora) {
        $this->hora = $hora;
    }

    function setIndicador($indicador) {
        $this->indicador = $indicador;
    }



}