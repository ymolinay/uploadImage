<?php

require_once __DIR__.'/../config/mysqli.data.php';
require_once __DIR__.'/../entity/perfil.php';

class PerfilDAO {

    public $objPerfil;
    private $task;

    const TABLE = "perfil";

    public function __construct() {
        $this->objPerfil = new Perfil();
        $this->task = new Task();
    }

    public function ExecuteCompleteCombobox() {
        $this->task->setTables(self::TABLE);
        $this->task->setFields('idPerfil;descripcion');
        $this->task->setWhereFields('indicador');
        $this->task->setWhereLogical('=');
        $this->task->setWhereValues('1');
        $this->task->setOrder('descripcion');
        $this->task->setValuesOrder('asc');
        return $this->task->executeSelect();
    }

}
