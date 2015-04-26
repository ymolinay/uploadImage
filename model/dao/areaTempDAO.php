<?php

require_once __DIR__.'/../config/mysqli.data.php';
require_once __DIR__.'/../entity/areatemp.php';

class AreaTempDAO {

    public $objAreaTemp;
    private $task;

    const TABLA = "areatemp";

    public function __construct() {
        $this->objAreaTemp = new AreaTemp();
        $this->task = new Task();
    }

    public function ExecuteSave($objAreaTemp) {

        $idAcceso = $objAreaTemp->getIdAcceso();
        $idArea = $objAreaTemp->getIdArea();
        $area = $objAreaTemp->getDescripcion();
        $idSede = $objAreaTemp->getIdSedeTemp();
        $indicador = $objAreaTemp->getIndicador();
        
        $this->task->setTables(self::TABLA);
        $this->task->setFields("idAreaTemp;idArea;descripcion;idSedeTemp;idAcceso;indicador");
        $this->task->setValues($idArea.";" . $area . ";" . $idSede . ";" . $idAcceso . ";" . $indicador);
        $result = $this->task->executeInsert("idAreaTemp");
        return $result;
    }

    public function ExecuteCompleteCombobox($objAreaTemp) {

        $idAcceso = $objAreaTemp->getIdAcceso();
        $this->task->setTables(self::TABLA);
        $this->task->setFields('idAreaTemp;descripcion');
        $this->task->setWhereFields('indicador;idAcceso');
        $this->task->setWhereLogical('=;=');
        $this->task->setWhereValues('1;' . $idAcceso);
        $this->task->setOrder('descripcion');
        $this->task->setValuesOrder('asc');
        return $this->task->executeSelect();
    }

    public function ExecuteSelect($objAreaTemp) {
        $idAcceso = $objAreaTemp->getIdAcceso();

        $this->task->setTables(self::TABLA);
        $this->task->setFields('idAreaTemp;idArea;descripcion;idSedeTemp;idAcceso;indicador');
        $this->task->setWhereFields('indicador;idAcceso');
        $this->task->setWhereLogical('=;=');
        $this->task->setWhereValues('1;' . $idAcceso);

        return $this->task->executeSelect();
    }

    public function ExecuteSelectId($objAreaTemp) {
        $idAcceso = $objAreaTemp->getIdAcceso();
        $idSedeTemp = $objAreaTemp->getIdSedeTemp();

        $this->task->setTables(self::TABLA);
        $this->task->setFields('idAreaTemp;idArea;descripcion;idSedeTemp;idAcceso;indicador');
        $this->task->setWhereFields('indicador;idAcceso;idSedeTemp');
        $this->task->setWhereLogical('=;=;=');
        $this->task->setWhereValues('1;' . $idAcceso . ';' . $idSedeTemp);

        return $this->task->executeSelect();
    }

    public function ExecuteDelete($objAreaTemp) {
        $idAcceso = $objAreaTemp->getIdAcceso();

        $this->task->setTables(self::TABLA);
        $this->task->setWhereFields("idAcceso");
        $this->task->setWhereLogical("=");
        $this->task->setWhereValues($idAcceso);
        $result = $this->task->executeDelete();
        return $result;
    }

    public function ExecuteDeleteItem($objAreaTemp) {
        $idAreaTemp = $objAreaTemp->getIdSedeTemp();
        $this->task->setTables(self::TABLA);
        $this->task->setWhereFields("idAreaTemp");
        $this->task->setWhereLogical("=");
        $this->task->setWhereValues($idAreaTemp);
        $result = $this->task->executeDelete();
        return $result;
    }

}

//$objAreaTempDAO=new AreaTempDAO();
//$objAreaTempDAO->objAreaTemp->setIdAcceso($idAcceso);
//$resultDeleteArea = $objAreaTempDAO->ExecuteDelete($objAreaTempDAO->objAreaTemp);
//echo "dlt area = " . $resultDeleteArea;
