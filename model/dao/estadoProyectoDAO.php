<?php

require_once __DIR__.'/../config/mysqli.data.php';
require_once __DIR__.'/../entity/estadoProyecto.php';

class EstadoProyectoDAO {

    public $objEtadoProyecto;
    private $task;

    const TABLE = 'estadoproyecto';

    function __construct() {
        $this->objEtadoProyecto = new EstadoProyecto();
        $this->task = new Task();
    }
    
    public function ExecuteCompleteCombobox() {
        $this->task->setTables(self::TABLE);
        $this->task->setFields('idEstadoProyecto;descripcion');
        $this->task->setWhereFields('indicador');
        $this->task->setWhereLogical('=');
        $this->task->setWhereValues('1');
        $this->task->setOrder('descripcion');
        $this->task->setValuesOrder('asc');
        return $this->task->executeSelect();
    }

}
