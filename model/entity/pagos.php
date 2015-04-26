<?php

class Pagos{
    private $idPagos;
    private $idTipoPago;
    private $idModoPago;
    private $TipoComprobante;
    private $NumComprobante;
    private $Pago;
    private $PagoDesc;
    private $Beneficio;
    private $Fecha;
    private $Hora;
    private $idMatricula;
    private $Indicador;
    
    function getIdPagos() {
        return $this->idPagos;
    }

    function getIdTipoPago() {
        return $this->idTipoPago;
    }

    function getIdModoPago() {
        return $this->idModoPago;
    }

    function getTipoComprobante() {
        return $this->TipoComprobante;
    }

    function getNumComprobante() {
        return $this->NumComprobante;
    }

    function getPago() {
        return $this->Pago;
    }

    function getPagoDesc() {
        return $this->PagoDesc;
    }

    function getBeneficio() {
        return $this->Beneficio;
    }

    function getFecha() {
        return $this->Fecha;
    }

    function getHora() {
        return $this->Hora;
    }
    
    function getIdMatricula() {
        return $this->idMatricula;
    }

    function getIndicador() {
        return $this->Indicador;
    }

    function setIdPagos($idPagos) {
        $this->idPagos = $idPagos;
    }

    function setIdTipoPago($idTipoPago) {
        $this->idTipoPago = $idTipoPago;
    }

    function setIdModoPago($idModoPago) {
        $this->idModoPago = $idModoPago;
    }

    function setTipoComprobante($TipoComprobante) {
        $this->TipoComprobante = $TipoComprobante;
    }

    function setNumComprobante($NumComprobante) {
        $this->NumComprobante = $NumComprobante;
    }

    function setPago($Pago) {
        $this->Pago = $Pago;
    }

    function setPagoDesc($PagoDesc) {
        $this->PagoDesc = $PagoDesc;
    }

    function setBeneficio($Beneficio) {
        $this->Beneficio = $Beneficio;
    }

    function setFecha($Fecha) {
        $this->Fecha = $Fecha;
    }

    function setHora($Hora) {
        $this->Hora = $Hora;
    }

    function setIdMatricula($idMatricula) {
        $this->idMatricula = $idMatricula;
    }

    function setIndicador($Indicador) {
        $this->Indicador = $Indicador;
    }


}