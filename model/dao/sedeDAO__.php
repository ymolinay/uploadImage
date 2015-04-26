<?php

require_once __DIR__.'/../config/mysqli.data.php';
require_once __DIR__.'/../entity/sede.php';

class SedeDAO {

    public $objSede;
    private $task;

    const TABLA = "sede";

    public function __construct() {
        $this->objSede = new Sede();
        $this->task = new Task();
    }

    public function ExecuteSave($objSede) {
        
        $descripcion = $objSede->getDescripcion();
        $direccion = $objSede->getDireccion();
        $idCuenta = $objSede->getIdCuenta();
        $idUbigeo = $objSede->getIdUbigeo();
        $indicador = $objSede->getIndicador();
        
        $idSede = $this->task->getId(self::TABLA, 'idSede'); //generar id        
        $this->task->setTables(self::TABLA);
        $this->task->setFields('idSede;descripcion;direccion;idCuenta;idUbigeo;indicador');
        $this->task->setValues($descripcion.";".$direccion.";".$idCuenta.";".$idUbigeo.";".$indicador);
        $result[0] = $this->task->executeInsert("idSede");
        $result[1] = $idSede;        
        return $result; //retorna el id del registro
   
    }    
    
    public function ExecuteCompleteCombobox() {
        $this->task->setTables(self::TABLA);
        $this->task->setFields('idSede;descripcion');
        $this->task->setWhereFields('indicador');
        $this->task->setWhereLogical('=');
        $this->task->setWhereValues('1');
        $this->task->setOrder('descripcion');
        $this->task->setValuesOrder('asc');
        return $this->task->executeSelect();
    }
    
    public function ExecuteSelect($objSede){   
        $idCuenta = $objSede->getIdCuenta();    
        $this->task->setTables(self::TABLA);
        $this->task->setFields('idSede;descripcion;direccion;idCuenta;idUbigeo;indicador');
        $this->task->setWhereFields('indicador;idCuenta');
        $this->task->setWhereLogical('=;=');
        $this->task->setWhereValues('1;'.$idCuenta);
        return $this->task->executeSelect();        
    }

}




