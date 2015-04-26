<?php

class ModoPago{
    private $idModoPago;
    private $Descripcion;
    private $Indicador;
    
    function getIdModoPago() {
        return $this->idModoPago;
    }

    function getDescripcion() {
        return $this->Descripcion;
    }

    function getIndicador() {
        return $this->Indicador;
    }

    function setIdModoPago($idModoPago) {
        $this->idModoPago = $idModoPago;
    }

    function setDescripcion($Descripcion) {
        $this->Descripcion = $Descripcion;
    }

    function setIndicador($Indicador) {
        $this->Indicador = $Indicador;
    }


}