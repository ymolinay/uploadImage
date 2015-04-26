<?php

class Personal {

    private $idPersonal;
    private $nombres;
    private $apellidoPaterno;
    private $apellidoMaterno;
    private $dni;
    private $telefono;
    private $email;
    private $idUbigeo;
    private $direccion;
    private $sexo;
    private $estadoCivil;
    private $fNacimiento;
    private $nacionalidad;
    private $indicador;

    function getIdPersonal() {
        return $this->idPersonal;
    }

    function getNombres() {
        return $this->nombres;
    }

    function getApellidoPaterno() {
        return $this->apellidoPaterno;
    }

    function getApellidoMaterno() {
        return $this->apellidoMaterno;
    }

    function getDni() {
        return $this->dni;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getEmail() {
        return $this->email;
    }

    function getIdUbigeo() {
        return $this->idUbigeo;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getSexo() {
        return $this->sexo;
    }

    function getEstadoCivil() {
        return $this->estadoCivil;
    }

    function getFNacimiento() {
        return $this->fNacimiento;
    }

    function getNacionalidad() {
        return $this->nacionalidad;
    }

    function getIndicador() {
        return $this->indicador;
    }

    function setIdPersonal($idPersonal) {
        $this->idPersonal = $idPersonal;
    }

    function setNombres($nombres) {
        $this->nombres = $nombres;
    }

    function setApellidoPaterno($apellidoPaterno) {
        $this->apellidoPaterno = $apellidoPaterno;
    }

    function setApellidoMaterno($apellidoMaterno) {
        $this->apellidoMaterno = $apellidoMaterno;
    }

    function setDni($dni) {
        $this->dni = $dni;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setIdUbigeo($idUbigeo) {
        $this->idUbigeo = $idUbigeo;
    }

    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    function setEstadoCivil($estadoCivil) {
        $this->estadoCivil = $estadoCivil;
    }

    function setFNacimiento($fNacimiento) {
        $this->fNacimiento = $fNacimiento;
    }

    function setNacionalidad($nacionalidad) {
        $this->nacionalidad = $nacionalidad;
    }

    function setIndicador($indicador) {
        $this->indicador = $indicador;
    }

}
