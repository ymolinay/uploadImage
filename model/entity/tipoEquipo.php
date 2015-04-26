<?php

class TipoEquipo{
    private $idTipoEquipo;
    private $descripcionTipoEquipo;
    private $indicador;
    
    public function getIdTipoEquipo() {
        return $this->idTipoEquipo;
    }

    public function getDescripcionTipoEquipo() {
        return $this->descripcionTipoEquipo;
    }

    public function getIndicador() {
        return $this->indicador;
    }

    public function setIdTipoEquipo($idTipoEquipo) {
        $this->idTipoEquipo = $idTipoEquipo;
    }

    public function setDescripcionTipoEquipo($descripcionTipoEquipo) {
        $this->descripcionTipoEquipo = $descripcionTipoEquipo;
    }

    public function setIndicador($indicador) {
        $this->indicador = $indicador;
    }



}