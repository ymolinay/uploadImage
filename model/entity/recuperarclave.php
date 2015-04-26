<?php

class RecuperarClave{
    private $idRecuperarClave;
    private $code1;
    private $code2;
    private $idPersonal;
    private $indicador;
    
    public function getIdRecuperarClave() {
        return $this->idRecuperarClave;
    }

    public function getCode1() {
        return $this->code1;
    }

    public function getCode2() {
        return $this->code2;
    }

    public function getIdPersonal() {
        return $this->idPersonal;
    }

    public function getIndicador() {
        return $this->indicador;
    }

    public function setIdRecuperarClave($idRecuperarClave) {
        $this->idRecuperarClave = $idRecuperarClave;
    }

    public function setCode1($code1) {
        $this->code1 = $code1;
    }

    public function setCode2($code2) {
        $this->code2 = $code2;
    }

    public function setIdPersonal($idPersonal) {
        $this->idPersonal = $idPersonal;
    }

    public function setIndicador($indicador) {
        $this->indicador = $indicador;
    }


}