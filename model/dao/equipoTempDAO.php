<?php

require_once __DIR__.'/../config/mysqli.data.php';
require_once __DIR__.'/../entity/equipoTemp.php';

class EquipoTempDAO {

    public $objEquipoTemp;
    private $task;

    const TABLE = "equipotemp";

    public function __construct() {
        $this->objEquipoTemp = new EquipoTemp();
        $this->task = new Task();
    }

    public function ExecuteSave($objEquipoTemp) {
        $idEquipo = $objEquipoTemp->getIdEquipo();
        $serie = $objEquipoTemp->getSerie();
        $costo = $objEquipoTemp->getCosto();
        $idTipo = $objEquipoTemp->getIdTipoEquipo();
        $idModelo = $objEquipoTemp->getIdModelo();
        $idProyecto = $objEquipoTemp->getIdProyecto();
        $idAcceso = $objEquipoTemp->getIdAcceso();
        $indicador = $objEquipoTemp->getIndicador();

        $this->task->setTables(self::TABLE);
        $this->task->setFields('idEquipoTemp;idEquipo;serieEquipo;costo;idTipoEquipo;idModelo;idProyecto;idAcceso;indicador');
        $this->task->setValues($idEquipo . ';' . $serie . ';' . $costo . ';' . $idTipo . ';' . $idModelo . ';' . $idProyecto . ';' . $idAcceso . ';' . $indicador);
        return $this->task->executeInsert('idEquipoTemp');
    }

    public function ExecuteSelect($objEquipoTemp) {
        $idProyecto = $objEquipoTemp->getIdProyecto();
        $idAcceso = $objEquipoTemp->getIdAcceso();

        $this->task->setTables(self::TABLE);
        $this->task->setFields('idEquipoTemp;idEquipo;serieEquipo;costo;idTipoEquipo;idModelo;idProyecto;idAcceso;indicador');
        $this->task->setWhereFields('idProyecto;idAcceso');
        $this->task->setWhereLogical('=;=');
        $this->task->setWhereValues($idProyecto . ';' . $idAcceso);
        
        return $this->task->executeSelect();
    }

    public function ExecuteDeleteId($objEquipoTemp) {
        $idAcceso = $objEquipoTemp->getIdAcceso();
        $idEquipoTemp = $objEquipoTemp->getIdEquipoTemp();

        $this->task->setTables(self::TABLE);
        $this->task->setWhereFields('idAcceso;idEquipoTemp');
        $this->task->setWhereLogical('=;=');
        $this->task->setWhereValues($idAcceso . ';' . $idEquipoTemp);
        
        return $this->task->executeDelete();
    }
    
    public function ExecuteUpdateIndicador($objEquipoTemp) {
        $idAcceso = $objEquipoTemp->getIdAcceso();
        $idEquipoTemp = $objEquipoTemp->getIdEquipoTemp();
        $indicador = $objEquipoTemp->getIndicador();

        $this->task->setTables(self::TABLE);
        $this->task->setFields('indicador');
        $this->task->setValues($indicador);
        $this->task->setWhereFields('idAcceso;idEquipoTemp');
        $this->task->setWhereLogical('=;=');
        $this->task->setWhereValues($idAcceso . ';' . $idEquipoTemp);
        
        return $this->task->executeUpdate();
    }
    
    public function ExecuteDelete($objEquipoTemp){
        $idAcceso = $objEquipoTemp->getIdAcceso();
        $idProyecto = $objEquipoTemp->getIdProyecto();
        
        $this->task->setTables(self::TABLE);
        $this->task->setWhereFields('idAcceso;idProyecto');
        $this->task->setWhereLogical('=;=');
        $this->task->setWhereValues($idAcceso . ';' . $idProyecto);
        
        return $this->task->executeDelete();
    }
}