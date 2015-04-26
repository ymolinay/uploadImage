<?php

class EstadoProyecto{
    private $idEstadoProyecto;
    private $descripcion;
    private $indicador;
    
    public function getIdEstadoProyecto() {
        return $this->idEstadoProyecto;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getIndicador() {
        return $this->indicador;
    }

    public function setIdEstadoProyecto($idEstadoProyecto) {
        $this->idEstadoProyecto = $idEstadoProyecto;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function setIndicador($indicador) {
        $this->indicador = $indicador;
    }


}