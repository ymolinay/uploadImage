<?php

class Perfil {

    private $idPerfil;
    private $descripcion;
    private $indicador;

    public function getIdPerfil() {
        return $this->idPerfil;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getIndicador() {
        return $this->indicador;
    }

    public function setIdPerfil($idPerfil) {
        $this->idPerfil = $idPerfil;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function setIndicador($indicador) {
        $this->indicador = $indicador;
    }

}
