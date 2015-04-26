<?php

require_once __DIR__.'/../config/mysqli.data.php';
require_once __DIR__.'/../entity/categoriaProyecto.php';

class CategoriaProyectoDAO{
   
    public $objCategoriaProyecto;
    private $task;
    
    const TABLE = 'categoriaproyecto';
    
    public function __construct() {
        $this->objCategoriaProyecto = new CategoriaProyecto();
        $this->task = new Task();
    }
    
    public function ExecuteCompleteCombobox() {
        $this->task->setTables(self::TABLE);
        $this->task->setFields('idCategoriaProyecto;descripcionCategoria');
        $this->task->setWhereFields('indicador');
        $this->task->setWhereLogical('=');
        $this->task->setWhereValues('1');
        $this->task->setOrder('descripcionCategoria');
        $this->task->setValuesOrder('asc');
        return $this->task->executeSelect();
    }
}

