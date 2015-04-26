<?php

class Proyecto{
    private $idProyecto;
    private $codigo;
    private $nombre;
    private $fechaIni;
    private $fechaFin;
    private $jefeProyecto;
    private $supervisorProyecto;
    private $asistenteProyecto;
    private $idCategoriaProyecto;
    private $idCuenta;
    private $idEstadoProyecto;
    private $observacion;
    private $indicador;
    
    public function getIdProyecto() {
        return $this->idProyecto;
    }

    public function getCodigo() {
        return $this->codigo;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getFechaIni() {
        return $this->fechaIni;
    }

    public function getFechaFin() {
        return $this->fechaFin;
    }

    public function getJefeProyecto() {
        return $this->jefeProyecto;
    }

    public function getSupervisorProyecto() {
        return $this->supervisorProyecto;
    }

    public function getAsistenteProyecto() {
        return $this->asistenteProyecto;
    }

    public function getIdCategoriaProyecto() {
        return $this->idCategoriaProyecto;
    }

    public function getIdCuenta() {
        return $this->idCuenta;
    }

    public function getIdEstadoProyecto() {
        return $this->idEstadoProyecto;
    }

    public function getObservacion() {
        return $this->observacion;
    }

    public function getIndicador() {
        return $this->indicador;
    }

    public function setIdProyecto($idProyecto) {
        $this->idProyecto = $idProyecto;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setFechaIni($fechaIni) {
        $this->fechaIni = $fechaIni;
    }

    public function setFechaFin($fechaFin) {
        $this->fechaFin = $fechaFin;
    }

    public function setJefeProyecto($jefeProyecto) {
        $this->jefeProyecto = $jefeProyecto;
    }

    public function setSupervisorProyecto($supervisorProyecto) {
        $this->supervisorProyecto = $supervisorProyecto;
    }

    public function setAsistenteProyecto($asistenteProyecto) {
        $this->asistenteProyecto = $asistenteProyecto;
    }

    public function setIdCategoriaProyecto($idCategoriaProyecto) {
        $this->idCategoriaProyecto = $idCategoriaProyecto;
    }

    public function setIdCuenta($idCuenta) {
        $this->idCuenta = $idCuenta;
    }

    public function setIdEstadoProyecto($idEstadoProyecto) {
        $this->idEstadoProyecto = $idEstadoProyecto;
    }

    public function setObservacion($observacion) {
        $this->observacion = $observacion;
    }

    public function setIndicador($indicador) {
        $this->indicador = $indicador;
    }


}