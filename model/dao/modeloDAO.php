<?php

require_once __DIR__.'/../config/mysqli.data.php';
require_once __DIR__.'/../entity/modelo.php';

class ModeloDAO{
    public $objModelo;
    private $task;
    
    const TABLE = 'modelo';


    public function __construct() {
        $this->objModelo = new Modelo();
        $this->task = new Task();
    }
    
    public function ExecuteCompleteCombobox() {
        $this->task->setTables(self::TABLE);
        $this->task->setFields('idModelo;descripcionModelo');
        $this->task->setWhereFields('indicador');
        $this->task->setWhereLogical('=');
        $this->task->setWhereValues('1');
        $this->task->setOrder('descripcionModelo');
        $this->task->setValuesOrder('asc');
        return $this->task->executeSelect();
    }
}