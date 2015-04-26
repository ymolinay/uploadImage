<?php

require_once __DIR__.'/../config/mysqli.data.php';
require_once __DIR__.'/../entity/inscripcionMarketing.php';

class InscripcionMarketingDAO {

    public $objInscripcionMarketing;
    private $task;

    const TABLE = "inscripcionmarketing";

    public function __construct() {
        $this->objInscripcionMarketing = new InscripcionMarketing();
        $this->task = new Task();
    }

    public function ExecuteSave($objInscripcionMarketing) {
        $idInscripcionMarketing = $this->task->getId(self::TABLE, 'idInscripcionMarketing');
        $insObservacion = $objInscripcionMarketing->getInsObservacion();
        $idMarketing = $objInscripcionMarketing->getIdMarketing();
        $idInscripcion = $objInscripcionMarketing->getIdInscripcion();

        $this->task->setTables(self::TABLE);
        $this->task->setFields('idInscripcionMarketing;insObservacion;idMarketing;idInscripcion');
        $this->task->setValues($insObservacion . ';' . $idMarketing . ';' . $idInscripcion);
        return $this->task->executeInsert('idInscripcionMarketing');
    }
    /*
    public function ExecuteUpdate($objUsuario){
        $idUsuario = $objUsuario->getIdUsuario();
        $nombre = $objUsuario->getNombre();
        $clave = $objUsuario->getClave();
        $idPerfil = $objUsuario->getIdPerfil();
        $idPersonal = $objUsuario->getIdPersonal();
        $indicador = $objUsuario->getIndicador();
        
        $this->task->setTables(self::TABLE);
        if($clave == md5('C0ntrasen4') || $clave == ''){
            $this->task->setFields('usrNombre;idPersonal;idPerfil;usrIndicador');
            $this->task->setValues($nombre . ';' . $idPersonal . ';' . $idPerfil . ';' . $indicador);
        } else {
            $this->task->setFields('usrNombre;usrClave;idPersonal;idPerfil;usrIndicador');
            $this->task->setValues($nombre . ';' . $clave . ';' . $idPersonal . ';' . $idPerfil . ';' . $indicador);
        }
        
        $this->task->setWhereFields('idUsuario');
        $this->task->setWhereLogical('=');
        $this->task->setWhereValues($idUsuario);
        return $this->task->executeUpdate();        
    }
    
    public function ExecuteDelete($objUsuario){
        $idUsuario = $objUsuario->getIdUsuario();
        $this->task->setTables(self::TABLE);
        $this->task->setWhereFields('idUsuario');
        $this->task->setWhereLogical('=');
        $this->task->setWhereValues($idUsuario);
        
        return $this->task->executeDelete();
    }*/
}