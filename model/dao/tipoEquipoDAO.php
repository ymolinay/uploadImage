<?php

require_once __DIR__.'/../config/mysqli.data.php';
require_once __DIR__.'/../entity/tipoEquipo.php';

class TipoModeloDAO {

    private $task;
    public $objTipoEquipo;

    const TABLE = 'tipoequipo';
    
    public function __construct() {
        $this->objTipoEquipo = new TipoEquipo();
        $this->task = new Task();
    }

    public function ExecuteCompleteCombobox() {
        $this->task->setTables(self::TABLE);
        $this->task->setFields('idTipoEquipo;descripcionTipoEquipo');
        $this->task->setWhereFields('indicador');
        $this->task->setWhereLogical('=');
        $this->task->setWhereValues('1');
        $this->task->setOrder('descripcionTipoEquipo');
        $this->task->setValuesOrder('asc');
        return $this->task->executeSelect();
    }
}
