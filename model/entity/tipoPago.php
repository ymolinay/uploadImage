<?php

class TipoPago{
    private $idTipoPago;
    private $Descripcion;
    private $Monto;
    private $Indicador;
    
    function getIdTipoPago() {
        return $this->idTipoPago;
    }

    function getDescripcion() {
        return $this->Descripcion;
    }

    function getMonto() {
        return $this->Monto;
    }

    function getIndicador() {
        return $this->Indicador;
    }

    function setIdTipoPago($idTipoPago) {
        $this->idTipoPago = $idTipoPago;
    }

    function setDescripcion($Descripcion) {
        $this->Descripcion = $Descripcion;
    }
	
    function setMonto($Monto) {
        $this->Monto = $Monto;
    }

    function setIndicador($Indicador) {
        $this->Indicador = $Indicador;
    }


}