<?php

class Ubigeo{
    
    private $idUbigeo;
    private $idDepartamento;
    private $departamento;
    private $idProvincia;
    private $provincia;
    private $idDistrito;
    private $distrito;
    
    public function setIdUbigeo($_idUbigeo) {
        $this->idUbigeo = $_idUbigeo;
    }
    
    public function getIdUbigeo() {
        return $this->idUbigeo;
    }
    
    public function setIdDepartamento($_idDepartamento) {
        $this->idDepartamento = $_idDepartamento;
    }
    
    public function getIdDepartamento() {
        return $this->idDepartamento;
    }
    
    public function setDepartamento($_departamento) {
        $this->departamento = $_departamento;
    }
    
    public function getDepartamento() {
        return $this->departamento;
    }
    
    public function setIdProvincia($_idProvincia) {
        $this->idProvincia = $_idProvincia;
    }
    
    public function getIdProvincia() {
        return $this->idProvincia;
    }
    
    public function setProvincia($_provincia) {
        $this->provincia = $_provincia;
    }
    
    public function getProvincia() {
        return $this->provincia;
    }
    
    public function setIdDistrito($_idDistrito) {
        $this->idDistrito = $_idDistrito;
    }
    
    public function getIdDistrito() {
        return $this->idDistrito;
    }
    
    public function setDistrito($_distrito) {
        $this->distrito = $_distrito;
    }
    
    public function getDistrito() {
        return $this->distrito;
    }
    
}
