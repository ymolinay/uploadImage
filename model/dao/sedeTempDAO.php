<?php

require_once __DIR__.'/../config/mysqli.data.php';
require_once __DIR__.'/../entity/sede.php';
require_once __DIR__.'/../entity/sedetemp.php';

class SedeTempDAO {

    public $objSedeTemp;
    private $task;

    const TABLA = "sedetemp";

    public function __construct() {
        $this->objSedeTemp = new SedeTemp();
        $this->task = new Task();
    }

    public function ExecuteSave($objSedeTemp) {
        $idSedeTemp = $this->task->getId(self::TABLA, 'idSedeTemp');
        $idAcceso = $objSedeTemp->getIdAcceso();
        $idSede = $objSedeTemp->getIdSede();
        $descripcion = $objSedeTemp->getDescripcion();
        $direccion = $objSedeTemp->getDireccion();
        $idUbigeo = $objSedeTemp->getIdUbigeo();
        $indicador = $objSedeTemp->getIndicador();
        $this->task->setTables(self::TABLA);
        $this->task->setFields('idSedeTemp;idSede;descripcion;direccion;idUbigeo;idAcceso;indicador');
        $this->task->setValues($idSede.";" . $descripcion . ";" . $direccion . ";" . $idUbigeo . ";" . $idAcceso . ";" . $indicador);
        $result[0] = $this->task->executeInsert("idSedeTemp");
        $result[1] = $idSedeTemp;
        
        return $result;
    }
    
    public function ExecuteSelect($objSedeTemp){   
        $idAcceso = $objSedeTemp->getIdAcceso();    
        $this->task->setTables(self::TABLA);
        $this->task->setFields('idSedeTemp;idSede;descripcion;direccion;idUbigeo;idAcceso;indicador');
        $this->task->setWhereFields('indicador;idAcceso');
        $this->task->setWhereLogical('=;=');
        $this->task->setWhereValues('1;'.$idAcceso);
        return $this->task->executeSelect();        
    }

    public function ExecuteCompleteCombobox($objSedeTemp) {
        $idAcceso = $objSedeTemp->getIdAcceso();    
        $this->task->setTables(self::TABLA);
        $this->task->setFields('idSedeTemp;descripcion');
        $this->task->setWhereFields('indicador;idAcceso');
        $this->task->setWhereLogical('=;=');
        $this->task->setWhereValues('1;'.$idAcceso);
        $this->task->setOrder('descripcion');
        $this->task->setValuesOrder('asc');
        return $this->task->executeSelect();
    }
    
    public function ExecuteDelete($objSedeTemp){
        $idAcceso = $objSedeTemp->getIdAcceso();
        $this->task->setTables(self::TABLA);
        $this->task->setWhereFields("idAcceso");
        $this->task->setWhereLogical("=");
        $this->task->setWhereValues($idAcceso);
        $result = $this->task->executeDelete();
        return $result;
    }
    
    public function ExecuteDeleteItem($objSedeTemp){
        $idSedeTemp = $objSedeTemp->getIdSedeTemp();
        $this->task->setTables(self::TABLA);
        $this->task->setWhereFields("idSedeTemp");
        $this->task->setWhereLogical("=");
        $this->task->setWhereValues($idSedeTemp);
        $result = $this->task->executeDelete();
        return $result;
    }

}
