<?php

require_once __DIR__.'/../config/mysqli.data.php';
require_once __DIR__.'/../entity/ciclo.php';

class CicloDAO{
    public $objCiclo;
    private $task;
    
    const TABLE = 'ciclo';
    
    public function __construct() {
        $this->objCiclo = new Ciclo();
        $this->task = new Task();
    }
    
    public function ExecuteCompleteCombobox() {
        $this->task->setTables(self::TABLE);
        $this->task->setFields('idCiclo;cloDescripcion');
        $this->task->setWhereFields('cloIndicador');
        $this->task->setWhereLogical('=');
        $this->task->setWhereValues('1');
        $this->task->setOrder('idCiclo');
        $this->task->setValuesOrder('asc');
        return $this->task->executeSelect();
    }
    public function ExecuteCompleteComboboxMax($_max) {
        $this->task->setTables(self::TABLE);
        $this->task->setFields('idCiclo;cloDescripcion');
        $this->task->setWhereFields('cloIndicador');
        $this->task->setWhereLogical('=');
        $this->task->setWhereValues('1');
        $this->task->setOrder('idCiclo');
        $this->task->setValuesOrder('asc');
        $this->task->setBeginLimit(0);
        $this->task->setEndLimit($_max);
        return $this->task->executeSelect();
    }
}