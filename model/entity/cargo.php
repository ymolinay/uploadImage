<?php
 class Cargo{
    private $idCargo;
    private $descripcion;
    private $idGrupo;
    private $indicador;
    
    public function getIdCargo() {
        return $this->idCargo;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getIdGrupo() {
        return $this->idGrupo;
    }

    public function getIndicador() {
        return $this->indicador;
    }

    public function setIdCargo($idCargo) {
        $this->idCargo = $idCargo;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function setIdGrupo($idGrupo) {
        $this->idGrupo = $idGrupo;
    }

    public function setIndicador($indicador) {
        $this->indicador = $indicador;
    }


 }