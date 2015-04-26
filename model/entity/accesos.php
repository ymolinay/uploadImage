<?php

class Accesos {

    private $idAcceso;
    private $HICliente;
    private $FICliente;
    private $HSCliente;
    private $FSCliente;
    private $HIServer;
    private $FIServer;
    private $HSServer;
    private $FSServer;
    private $idUsuario;
    private $indicador;

    public function getIdAcceso() {
        return $this->idAcceso;
    }

    public function getHICliente() {
        return $this->HICliente;
    }

    public function getFICliente() {
        return $this->FICliente;
    }

    public function getHSCliente() {
        return $this->HSCliente;
    }

    public function getFSCliente() {
        return $this->FSCliente;
    }

    public function getHIServer() {
        return $this->HIServer;
    }

    public function getFIServer() {
        return $this->FIServer;
    }

    public function getHSServer() {
        return $this->HSServer;
    }

    public function getFSServer() {
        return $this->FSServer;
    }

    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function getIndicador() {
        return $this->indicador;
    }

    public function setIdAcceso($idAcceso) {
        $this->idAcceso = $idAcceso;
    }

    public function setHICliente($HICliente) {
        $this->HICliente = $HICliente;
    }

    public function setFICliente($FICliente) {
        $this->FICliente = $FICliente;
    }

    public function setHSCliente($HSCliente) {
        $this->HSCliente = $HSCliente;
    }

    public function setFSCliente($FSCliente) {
        $this->FSCliente = $FSCliente;
    }

    public function setHIServer($HIServer) {
        $this->HIServer = $HIServer;
    }

    public function setFIServer($FIServer) {
        $this->FIServer = $FIServer;
    }

    public function setHSServer($HSServer) {
        $this->HSServer = $HSServer;
    }

    public function setFSServer($FSServer) {
        $this->FSServer = $FSServer;
    }

    public function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    public function setIndicador($indicador) {
        $this->indicador = $indicador;
    }


}
