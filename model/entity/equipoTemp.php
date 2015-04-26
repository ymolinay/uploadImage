<?php

class EquipoTemp {

    private $idEquipoTemp;
    private $idEquipo;
    private $serie;
    private $costo;
    private $idTipoEquipo;
    private $idModelo;
    private $idProyecto;
    private $idAcceso;
    private $indicador;

    public function getIdEquipoTemp() {
        return $this->idEquipoTemp;
    }

    public function getIdEquipo() {
        return $this->idEquipo;
    }

    public function getSerie() {
        return $this->serie;
    }

    public function getCosto() {
        return $this->costo;
    }

    public function getIdTipoEquipo() {
        return $this->idTipoEquipo;
    }

    public function getIdModelo() {
        return $this->idModelo;
    }

    public function getIdProyecto() {
        return $this->idProyecto;
    }

    public function getIdAcceso() {
        return $this->idAcceso;
    }

    public function getIndicador() {
        return $this->indicador;
    }

    public function setIdEquipoTemp($idEquipoTemp) {
        $this->idEquipoTemp = $idEquipoTemp;
    }

    public function setIdEquipo($idEquipo) {
        $this->idEquipo = $idEquipo;
    }

    public function setSerie($serie) {
        $this->serie = $serie;
    }

    public function setCosto($costo) {
        $this->costo = $costo;
    }

    public function setIdTipoEquipo($idTipoEquipo) {
        $this->idTipoEquipo = $idTipoEquipo;
    }

    public function setIdModelo($idModelo) {
        $this->idModelo = $idModelo;
    }

    public function setIdProyecto($idProyecto) {
        $this->idProyecto = $idProyecto;
    }

    public function setIdAcceso($idAcceso) {
        $this->idAcceso = $idAcceso;
    }

    public function setIndicador($indicador) {
        $this->indicador = $indicador;
    }


}
