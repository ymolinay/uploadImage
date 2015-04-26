<?php

require_once __DIR__.'/../config/mysqli.data.php';
require_once __DIR__.'/../entity/sede.php';

class SedeDAO{
    public $objSede;
    private $task;
    
    const TABLE = 'sede';
    
    public function __construct() {
        $this->objSede = new Sede();
        $this->task = new Task();
    }
    
    public function ExecuteCompleteCombobox() {
        $this->task->setTables(self::TABLE);
        $this->task->setFields('idSede;sdeNombre;sdeDireccion');
        $this->task->setWhereFields('sdeIndicador');
        $this->task->setWhereLogical('=');
        $this->task->setWhereValues('1');
        $this->task->setOrder('sdeNombre');
        $this->task->setValuesOrder('asc');
        return $this->task->executeSelect();
    }
}