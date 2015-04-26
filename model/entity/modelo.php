<?php
class Modelo{
    private $idModelo;
    private $descripcion;
    private $indicador;
    
    public function getIdModelo() {
        return $this->idModelo;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getIndicador() {
        return $this->indicador;
    }

    public function setIdModelo($idModelo) {
        $this->idModelo = $idModelo;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function setIndicador($indicador) {
        $this->indicador = $indicador;
    }


}