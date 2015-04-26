<?php

class ProyectoEquipo{
    private $idProyectoEquipo;
    private $idProyecto;
    private $idEquipo;
    
    public function getIdProyectoEquipo() {
        return $this->idProyectoEquipo;
    }

    public function getIdProyecto() {
        return $this->idProyecto;
    }

    public function getIdEquipo() {
        return $this->idEquipo;
    }

    public function setIdProyectoEquipo($idProyectoEquipo) {
        $this->idProyectoEquipo = $idProyectoEquipo;
    }

    public function setIdProyecto($idProyecto) {
        $this->idProyecto = $idProyecto;
    }

    public function setIdEquipo($idEquipo) {
        $this->idEquipo = $idEquipo;
    }


}