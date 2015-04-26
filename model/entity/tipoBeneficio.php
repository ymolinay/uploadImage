<?php

class TipoBeneficio{
    private $idTipoBeneficio;
    private $descripcion;
    private $pagoMatricula;
    private $pagoMensual;
    private $descuentoPorcentaje;
    private $paMatriculaDesc;
    private $paMensualDesc;
    private $indicador;
    
    function getIdTipoBeneficio() {
        return $this->idTipoBeneficio;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getPagoMatricula() {
        return $this->pagoMatricula;
    }

    function getPagoMensual() {
        return $this->pagoMensual;
    }

    function getDescuentoPorcentaje() {
        return $this->descuentoPorcentaje;
    }

    function getPaMatriculaDesc() {
        return $this->paMatriculaDesc;
    }

    function getPaMensualDesc() {
        return $this->paMensualDesc;
    }

    function getIndicador() {
        return $this->indicador;
    }

    function setIdTipoBeneficio($idTipoBeneficio) {
        $this->idTipoBeneficio = $idTipoBeneficio;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setPagoMatricula($pagoMatricula) {
        $this->pagoMatricula = $pagoMatricula;
    }

    function setPagoMensual($pagoMensual) {
        $this->pagoMensual = $pagoMensual;
    }

    function setDescuentoPorcentaje($descuentoPorcentaje) {
        $this->descuentoPorcentaje = $descuentoPorcentaje;
    }

    function setPaMatriculaDesc($paMatriculaDesc) {
        $this->paMatriculaDesc = $paMatriculaDesc;
    }

    function setPaMensualDesc($paMensualDesc) {
        $this->paMensualDesc = $paMensualDesc;
    }

    function setIndicador($indicador) {
        $this->indicador = $indicador;
    }


}