<?php

class Usuario {

    private $idUsuario;
    private $nombre;
    private $clave;
    private $idPerfil;
    private $idPersonal;
    private $indicador;

    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getClave() {
        return $this->clave;
    }

    public function getIdPerfil() {
        return $this->idPerfil;
    }

    public function getIdPersonal() {
        return $this->idPersonal;
    }

    public function getIndicador() {
        return $this->indicador;
    }

    public function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setClave($clave) {
        $this->clave = $clave;
    }

    public function setIdPerfil($idPerfil) {
        $this->idPerfil = $idPerfil;
    }

    public function setIdPersonal($idPersonal) {
        $this->idPersonal = $idPersonal;
    }

    public function setIndicador($indicador) {
        $this->indicador = $indicador;
    }


}
