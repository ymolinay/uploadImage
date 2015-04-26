<?php

class Sede {

    private $idSede;
    private $sdeNombre;
    private $sdeDireccion;
    private $sdeIndicador;

    function getIdSede() {
        return $this->idSede;
    }

    function getSdeNombre() {
        return $this->sdeNombre;
    }

    function getSdeDireccion() {
        return $this->sdeDireccion;
    }

    function getSdeIndicador() {
        return $this->sdeIndicador;
    }

    function setIdSede($idSede) {
        $this->idSede = $idSede;
    }

    function setSdeNombre($sdeNombre) {
        $this->sdeNombre = $sdeNombre;
    }

    function setSdeDireccion($sdeDireccion) {
        $this->sdeDireccion = $sdeDireccion;
    }

    function setSdeIndicador($sdeIndicador) {
        $this->sdeIndicador = $sdeIndicador;
    }



}
