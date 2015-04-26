<?php

require_once __DIR__.'/../config/mysqli.data.php';
require_once __DIR__.'/../entity/turno.php';

class TurnoDAO {
    
    public $objTurno;
    private $task;
    
    const TABLE = "turno";
    
    public function __construct() {
        $this->objTurno = new Turno();
        $this->task = new Task();
    }

    public function SearchAllData() {
        $this->task->setTables(self::TABLE);
        $this->task->setFields('idTurno;troDescripcion');
        $this->task->setWhereFields('troIndicador');
        $this->task->setWhereLogical('=');
        $this->task->setWhereValues('1');
        $this->task->setOrder('idTurno');
        $this->task->setValuesOrder('asc');
        return $this->task->executeSelect();
    }
    
}