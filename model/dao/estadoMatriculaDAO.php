<?php

require_once __DIR__ . '/../config/mysqli.data.php';
require_once __DIR__ . '/../entity/estadoMatricula.php';

class EstadoMatriculaDAO {

    public $objEstadoMatricula;
    private $task;

    const TABLE = 'estadomatricula';

    public function __construct() {
        $this->objEstadoMatricula = new EstadoMatricula();
        $this->task = new Task();
    }

    public function SearchAllData() {
        $this->task->setTables(self::TABLE);
        $this->task->setFields('idEstadoMatricula;etmDescripcion');
        $this->task->setWhereFields('etmIndicador');
        $this->task->setWhereLogical('=');
        $this->task->setWhereValues('1');
        $this->task->setOrder('etmDescripcion');
        $this->task->setValuesOrder('asc');
        return $this->task->executeSelect();
    }

}
