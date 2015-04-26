<?php

require_once __DIR__.'/../config/mysqli.data.php';
require_once __DIR__.'/../entity/categoria.php';

class CategoriaDAO{
   
    public $objCategoria;
    private $task;
    
    const TABLE = 'categoria';
    
    public function __construct() {
        $this->objCategoria = new Categoria();
        $this->task = new Task();
    }
    
    public function ExecuteCompleteCombobox() {
        $this->task->setTables(self::TABLE);
        $this->task->setFields('idCategoria;descripcion');
        $this->task->setWhereFields('indicador');
        $this->task->setWhereLogical('=');
        $this->task->setWhereValues('1');
        $this->task->setOrder('descripcion');
        $this->task->setValuesOrder('asc');
        return $this->task->executeSelect();
    }
}

