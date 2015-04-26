<?php

require_once __DIR__.'/../config/mysqli.data.php';
require_once __DIR__.'/../entity/equipo.php';

class EquipoDAO {

    public $objEquipo;
    private $task;

    const TABLE = "equipo";

    public function __construct() {
        $this->objEquipo = new Equipo();
        $this->task = new Task();
    }

    public function ExecuteSave($objEquipo) {
        $serie = $objEquipo->getSerie();
        $costo = $objEquipo->getCosto();
        $idTipoEquipo = $objEquipo->getIdTipoEquipo();
        $idModelo = $objEquipo->getIdModelo();
        $indicador = $objEquipo->getIndicador();

        $idEquipo = $this->task->getId(self::TABLE, 'idEquipo');
        $this->task->setTables(self::TABLE);
        $this->task->setFields('idEquipo;serieEquipo;costo;idTipoEquipo;idModelo;indicador');
        $this->task->setValues($serie . ';'. $costo . ';'. $idTipoEquipo . ';'. $idModelo . ';'. $indicador);
        
        $result[0] = $this->task->executeInsert('idEquipo');
        $result[1] = $idEquipo;
        return $result;
    }
    
    public function ExecuteDelete($objEquipo){
        $idEquipo = $objEquipo->getIdEquipo();
        
        $this->task->setTables(self::TABLE);
        $this->task->setWhereFields('idEquipo');
        $this->task->setWhereLogical('=');
        $this->task->setWhereValues($idEquipo);
        return $this->task->executeDelete();
    }

}