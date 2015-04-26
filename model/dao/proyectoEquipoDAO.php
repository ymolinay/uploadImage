<?php

require_once __DIR__.'/../config/mysqli.data.php';
require_once __DIR__.'/../entity/proyectoEquipo.php';

class ProyectoEquipoDAO {

    public $objProyectoEquipo;
    private $task;

    const TABLE = 'proyectoequipo';

    public function __construct() {
        $this->objProyectoEquipo = new ProyectoEquipo();
        $this->task = new Task();
    }

    public function ExecuteSave($objProyectoEquipo) {
        
        
        $idProyecto = $objProyectoEquipo->getIdProyecto();
        $idEquipo = $objProyectoEquipo->getIdEquipo();

        $this->task->setTables(self::TABLE);
        $this->task->setFields('idProyectoEquipo;idProyecto;idEquipo');
        $this->task->setValues($idProyecto . ';' . $idEquipo);
        
        return $this->task->executeInsert('idProyectoEquipo');
    }

    public function ExecuteSelect($objProyectoEquipo){
        $idProyecto = $objProyectoEquipo->getIdProyecto();
        
        $this->task->setTables(self::TABLE . ';equipo');
        $this->task->setFields('idProyectoEquipo;idProyecto;idEquipo;serieEquipo;costo;idTipoEquipo;idModelo');
        $this->task->setIndex('0;0;0;1;1;1;1');
        $this->task->setTypeJoin('inner');
        $this->task->setOnJoin('p0.idEquipo=e1.idEquipo');
        $this->task->setWhereFields('p0.idProyecto');
        $this->task->setWhereLogical('=');
        $this->task->setWhereValues($idProyecto);
        
        return $this->task->executeMultiSelect();
        
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
