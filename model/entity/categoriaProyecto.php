<?php

class CategoriaProyecto {

    private $idCategoriaProyecto;
    private $descripcion;
    private $indicador;

    public function getIdCategoriaProyecto() {
        return $this->idCategoriaProyecto;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getIndicador() {
        return $this->indicador;
    }

    public function setIdCategoriaProyecto($idCategoriaProyecto) {
        $this->idCategoriaProyecto = $idCategoriaProyecto;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function setIndicador($indicador) {
        $this->indicador = $indicador;
    }


}
