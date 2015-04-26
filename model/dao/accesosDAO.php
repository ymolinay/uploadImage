<?php

require_once __DIR__.'/../config/mysqli.data.php';
require_once __DIR__.'/../entity/accesos.php';

class AccesosDAO {

    public $objAcceso;
    private $task;

    const TABLA = "acceso";

    public function __construct() {
        $this->objAcceso = new Accesos();
        $this->task = new Task();
    }
    //registra el acceso del usuario
    public function ExecuteLogin($objAcceso) {
        $idAcesso = $this->task->getId(self::TABLA, 'idAcceso');
        $HICliente = $objAcceso->getHICliente();
        $FICliente = $objAcceso->getFICliente();
        $HSCliente = $objAcceso->getHSCliente();
        $FSCliente = $objAcceso->getFSCliente();
        $HIServer = $objAcceso->getHIServer();
        $FIServer = $objAcceso->getFIServer();
        $HSServer = $objAcceso->getHSServer();
        $FSServer = $objAcceso->getFSServer();
        $idUsuario = $objAcceso->getIdUsuario();
        $indicador = $objAcceso->getIndicador();
        $this->task->setTables(self::TABLA);
        $this->task->setFields('idAcceso;aesHICliente;aesFICliente;aesHSCliente;aesFSCliente;aesHIServer;aesFIServer;aesHSServer;aesFSServer;idUsuario;aesIndicador');
        $this->task->setValues($HICliente.';'.$FICliente.';'.$HSCliente.';'.$FSCliente.';'.$HIServer.';'.$FIServer.';'.$HSServer.';'.$FSServer.';'.$idUsuario.';'.$indicador);
        $res[0] = $this->task->executeInsert("idAcceso");
        $res[1] = $idAcesso;
        return $res;
    }
    
    public function ExecuteLogout($objAcceso){
        $idAcesso = $objAcceso->getIdAcceso();
        $HSCliente = $objAcceso->getHSCliente();
        $FSCliente = $objAcceso->getFSCliente();
        $HSServer = $objAcceso->getHSServer();
        $FSServer = $objAcceso->getFSServer();
        $idUsuario = $objAcceso->getIdUsuario();
        $this->task->setTables(self::TABLA);
        $this->task->setFields('aesHSCliente;aesFSCliente;aesHSServer;aesFSServer');
        $this->task->setValues($HSCliente.';'.$FSCliente.';'.$HSServer.';'.$FSServer);
        $this->task->setWhereFields('idAcceso');
        $this->task->setWhereLogical('=');
        $this->task->setWhereValues($idAcesso);
        
        return $this->task->executeUpdate();
    }
}
