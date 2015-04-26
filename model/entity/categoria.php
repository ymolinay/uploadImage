<?php

class Categoria{
    private $idCategoria;
    private $descripcion;
    private $indicador;
    
    public function getIdCategoria() {
        return $this->idCategoria;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getIndicador() {
        return $this->indicador;
    }

    public function setIdCategoria($idCategoria) {
        $this->idCategoria = $idCategoria;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function setIndicador($indicador) {
        $this->indicador = $indicador;
    }


}