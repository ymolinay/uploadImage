<?php

require_once __DIR__.'/../config/mysqli.data.php';
require_once __DIR__.'/../entity/mantenimiento.php';

class MantenimientoDAO {

    public $objMantenimiento;
    private $task;

    public function __construct() {
        $this->objMantenimiento = new Mantenimiento();
        $this->task = new Task();
    }

    public function ExecuteSearch($objMantenimiento) {

        $table = $objMantenimiento->getTable();
        $field = $objMantenimiento->getField();
        $search = $objMantenimiento->getSearch();
        $fieldId = $objMantenimiento->getFieldId();
        $id = $objMantenimiento->getId();

        $this->task->setTables($table);
        $this->task->setFields($field);
        
        if(!empty($fieldId) && !empty($id)){
            $this->task->setWhereFields($field . ';' . $fieldId);
            $this->task->setWhereLogical('=;<>');
            $this->task->setWhereValues($search . ';' . $id);
        } else {
            $this->task->setWhereFields($field);
            $this->task->setWhereLogical('=');
            $this->task->setWhereValues($search);
        }

        $count = array();
        $count = $this->task->executeSelect();

        return count($count);
    }

    public function ExecuteDelete($objMantenimiento) {
        $table = $objMantenimiento->getTable();
        $fieldId = $objMantenimiento->getFieldId();
        $id = $objMantenimiento->getId();

        $this->task->setTables($table);
        $this->task->setWhereFields($fieldId);
        $this->task->setWhereLogical('=');
        $this->task->setWhereValues($id);
        
        return $this->task->executeDelete();
    }

}
