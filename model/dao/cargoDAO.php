<?php

require_once __DIR__.'/../config/mysqli.data.php';
require_once __DIR__.'/../entity/cargo.php';

class CargoDAO {

    public $objCargo;
    private $task;

    const TABLA = "cargo";

    public function __construct() {
        $this->objCargo = new Cargo();
        $this->task = new Task();
    }

    public function ExecuteCompleteCombobox() {
        $this->task->setTables(self::TABLA.';grupo');
        $this->task->setFields('idCargo;descripcion');
        $this->task->setIndex('0;0');
        $this->task->setTypeJoin('inner;inner');
        $this->task->setOnJoin('g1.idGrupo=c0.idGrupo');
        $this->task->setWhereFields('c0.indicador');
        $this->task->setWhereLogical('=');
        $this->task->setWhereValues('1');
        $this->task->setOrder('c0.descripcion');
        $this->task->setValuesOrder('asc');
        return $this->task->executeMultiSelect();
    }
}
