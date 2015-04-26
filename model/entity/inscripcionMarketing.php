<?php

class InscripcionMarketing{
    
    private $idInscripcionMarketing	;
    private $insObservacion;
    private $idMarketing;
    private $idInscripcion;
    
    public function setIdInscripcionMarketing($idInscripcionMarketing) {
        $this->idInscripcionMarketing = $idInscripcionMarketing;
    }
    
    public function getIdInscripcionMarketing() {
        return $this->idInscripcionMarketing;
    }
    
    public function setInsObservacion($insObservacion) {
        $this->insObservacion = $insObservacion;
    }
    
    public function getInsObservacion() {
        return $this->insObservacion;
    }
    
    public function setIdMarketing($idMarketing) {
        $this->idMarketing = $idMarketing;
    }
    
    public function getIdMarketing() {
        return $this->idMarketing;
    }
    
    public function setIdInscripcion($idInscripcion) {
        $this->idInscripcion = $idInscripcion;
    }
    
    public function getIdInscripcion() {
        return $this->idInscripcion;
    }
    
}
