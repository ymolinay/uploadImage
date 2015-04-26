<?php

class Cuenta {

    private $idCuenta;
    private $razonSocial;
    private $nombreComercial;
    private $direccion;
    private $ruc;
    private $telefono;
    private $indicador;

    public function getIdCuenta() {
        return $this->idCuenta;
    }

    public function getRazonSocial() {
        return $this->razonSocial;
    }

    public function getNombreComercial() {
        return $this->nombreComercial;
    }

    public function getDireccion() {
        return $this->direccion;
    }

    public function getRuc() {
        return $this->ruc;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function getIndicador() {
        return $this->indicador;
    }

    public function setIdCuenta($idCuenta) {
        $this->idCuenta = $idCuenta;
    }

    public function setRazonSocial($razonSocial) {
        $this->razonSocial = $razonSocial;
    }

    public function setNombreComercial($nombreComercial) {
        $this->nombreComercial = $nombreComercial;
    }

    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    public function setRuc($ruc) {
        $this->ruc = $ruc;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    public function setIndicador($indicador) {
        $this->indicador = $indicador;
    }

}
