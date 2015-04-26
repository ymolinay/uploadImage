<?php

require_once __DIR__.'/../config/mysqli.data.php';
require_once __DIR__.'/../entity/cuenta.php';
//extras
require_once __DIR__.'/../dao/sedeTempDAO.php';
require_once __DIR__.'/../dao/sedeDAO.php';
require_once __DIR__.'/../dao/areaTempDAO.php';
require_once __DIR__.'/../dao/areaDAO.php';

class CuentaDAO {

    public $objCuenta;
    public $objSedeTempDAO;
    public $objSedeDAO;
    public $objAreaTempDAO;
    public $objAreaDAO;
    private $task;

    const TABLE = "cuenta";

    public function __construct() {
        $this->objCuenta = new Cuenta();
        $this->objSedeTempDAO = new SedeTempDAO();
        $this->objSedeDAO = new SedeDAO();
        $this->objAreaTempDAO = new AreaTempDAO();
        $this->objAreaDAO = new AreaDAO();
        $this->task = new Task();
    }

    public function ExecuteSave($objCuenta) {

        $idAcceso = $_SESSION["sessionIdAcceso"];
        //validamos que exista almenos un registro en la tabla sedetemp
        $this->objSedeTempDAO->objSedeTemp->setIdAcceso($idAcceso);
        $resultSedeTemp = array();
        $resultSedeTemp = $this->objSedeTempDAO->ExecuteSelect($this->objSedeTempDAO->objSedeTemp);

        $countSedeTemp = count($resultSedeTemp);

        if ($countSedeTemp > 0) {
            //validamos que exista almenos un registro en la tabla areatemp
            $this->objAreaTempDAO->objAreaTemp->setIdAcceso($idAcceso);
            $resultAreaTemp = array();
            $resultAreaTemp = $this->objAreaTempDAO->ExecuteSelect($this->objAreaTempDAO->objAreaTemp);

            $countAreaTemp = count($resultAreaTemp);

            if ($countAreaTemp > 0) {
                //registramos la nueva cuenta
                $razonSocial = $objCuenta->getRazonSocial();
                $nombreComercial = $objCuenta->getNombreComercial();
                $ruc = $objCuenta->getRuc();
                $direccion = $objCuenta->getDireccion();
                $telefono = $objCuenta->getTelefono();
                //generar id
                $idCuenta = $this->task->getId(self::TABLE, 'idCuenta');
                //ejecutar el registro
                $this->task->setTables(self::TABLE);
                $this->task->setFields("idCuenta;razonSocial;nombreComercial;direccion;ruc;telefono;indicador");
                $this->task->setValues($razonSocial . ";" . $nombreComercial . ";" . $direccion . ";" . $ruc . ";" . $telefono . ";1");
                $resultCuenta = $this->task->executeInsert("idCuenta");

                if ($resultCuenta) {
                    //registrar sede
                    foreach ($resultSedeTemp as $valSede) {
                        $this->objSedeDAO->objSede->setDescripcion($valSede->descripcion);
                        $this->objSedeDAO->objSede->setDireccion($valSede->direccion);
                        $this->objSedeDAO->objSede->setIdCuenta($idCuenta);
                        $this->objSedeDAO->objSede->setIdUbigeo($valSede->idUbigeo);
                        $this->objSedeDAO->objSede->setIndicador($valSede->indicador);
                        $resultSede = $this->objSedeDAO->ExecuteSave($this->objSedeDAO->objSede);
                        //idsede
                        $idSedeTemp = $valSede->idSedeTemp;

                        if ($resultSede[0]) {
                            foreach ($resultAreaTemp as $valArea) {
                                $idSedeTemp2 = $valArea->idSedeTemp;
                                //validamos que las areas correspondan a sus respectivas sedes
                                if ($idSedeTemp == $idSedeTemp2) {
                                    $this->objAreaDAO->objArea->setDescripcion($valArea->descripcion);
                                    $this->objAreaDAO->objArea->setIdSede($resultSede[1]);
                                    $this->objAreaDAO->objArea->setIndicador($valArea->indicador);
                                    $resultArea = $this->objAreaDAO->ExecuteSave($this->objAreaDAO->objArea);
                                }
                            }
                        }
                    }
                    //BEGIN BORRAR LAS TABLAS TEMPORALES
                    if ($resultArea == "1") {
                        $result = $this->task->mysqlSimpleExecute("DELETE FROM areatemp WHERE idAcceso = " . $idAcceso);
                        if ($result == "1") {
                            $result = $this->task->mysqlSimpleExecute("DELETE FROM sedetemp WHERE idAcceso = " . $idAcceso);
                        }
                        return $result;
                    }
                    //END BORRAR LAS TABLAS TEMPORALES
                } else {
                    return "ERROR";
                }
            } else {
                echo "ERROR debe registrar al menos una área.";
            }
        } else {
            echo "ERROR debe registrar al menos una sede.";
        }
    }

    public function ExecuteUpdate($objCuenta) {

        $idAcceso = $_SESSION["sessionIdAcceso"];
        //validamos que exista almenos un registro en la tabla sedetemp
        $this->objSedeTempDAO->objSedeTemp->setIdAcceso($idAcceso);
        $resultSedeTemp = array();
        $resultSedeTemp = $this->objSedeTempDAO->ExecuteSelect($this->objSedeTempDAO->objSedeTemp);
        $countSedeTemp = count($resultSedeTemp);

        if ($countSedeTemp > 0) {
            //validamos que exista almenos un registro en la tabla areatemp
            $this->objAreaTempDAO->objAreaTemp->setIdAcceso($idAcceso);
            $resultAreaTemp = array();
            $resultAreaTemp = $this->objAreaTempDAO->ExecuteSelect($this->objAreaTempDAO->objAreaTemp);
            $countAreaTemp = count($resultAreaTemp);

            if ($countAreaTemp > 0) {
                //actualizar cuenta
                $idCuenta = $objCuenta->getIdCuenta();
                $razonSocial = $objCuenta->getRazonSocial();
                $nombreComercial = $objCuenta->getNombreComercial();
                $ruc = $objCuenta->getRuc();
                $direccion = $objCuenta->getDireccion();
                $telefono = $objCuenta->getTelefono();

                $this->task->setTables(self::TABLE);
                $this->task->setFields('razonSocial;nombreComercial;direccion;ruc;telefono');
                $this->task->setValues($razonSocial . ';' . $nombreComercial . ';' . $direccion . ';' . $ruc . ';' . $telefono);
                $this->task->setWhereFields('idCuenta');
                $this->task->setWhereLogical('=');
                $this->task->setWhereValues($idCuenta);
                $resultCuenta = $this->task->executeUpdate();

                if ($resultCuenta == "1") {
                    //LIMPIAR TABLAS
                    $cleanTable = $this->ExecuteDeleteTables($idCuenta);
                    
                    if ($cleanTable == "1") {
                        //BEGIN GRABAR SEDES Y AREAS
                        $result[0] = $resultSedeTemp;
                        $result[1] = $resultAreaTemp;
                        
                        return $result;                        
                    }
                } else {
                    echo "ERROR";
                }
            } else {
                echo "ERROR debe registrar al menos una área.";
            }
        } else {
            echo "ERROR debe registrar al menos una sede.";
        }
    }

    public function ExecuteDeleteTables($idCuenta) {

        $this->objSedeDAO->objSede->setIdCuenta($idCuenta);
        $resultSede = array();
        $resultSede = $this->objSedeDAO->ExecuteSelect($this->objSedeDAO->objSede);
        
        foreach ($resultSede as $val) {
            $result = $this->task->mysqlSimpleExecute("DELETE FROM area WHERE idSede = " . $val->idSede);
        }
        if ($result == "1") {
            $result = $this->task->mysqlSimpleExecute("DELETE FROM sede WHERE idCuenta = " . $idCuenta);
        }
        return $result;
    }

    public function ExecuteSelectItem($objCuenta) {

        $idCuenta = $objCuenta->getIdCuenta();
        $this->task->setTables(self::TABLE);
        $this->task->setFields('idCuenta;razonSocial;nombreComercial;direccion;ruc;telefono');
        $this->task->setWhereFields('indicador;idCuenta');
        $this->task->setWhereLogical('=;=');
        $this->task->setWhereValues('1;' . $idCuenta);
        $result = $this->task->executeSelect();

        if ($result) {
            //RECUPERAR TABLAS
            $idAcceso = $_SESSION["sessionIdAcceso"];
            //SEDES
            $this->objSedeDAO->objSede->setIdCuenta($idCuenta);
            $resultSede = array();
            $resultSede = $this->objSedeDAO->ExecuteSelect($this->objSedeDAO->objSede);
            $countSede = count($resultSede);

            if ($countSede > 0) {
                foreach ($resultSede as $valSedeTemp) {
                    $idSede = $valSedeTemp->idSede;
                    $this->objSedeTempDAO->objSedeTemp->setIdSede($valSedeTemp->idSede);
                    $this->objSedeTempDAO->objSedeTemp->setDescripcion($valSedeTemp->descripcion);
                    $this->objSedeTempDAO->objSedeTemp->setDireccion($valSedeTemp->direccion);
                    $this->objSedeTempDAO->objSedeTemp->setIdUbigeo($valSedeTemp->idUbigeo);
                    $this->objSedeTempDAO->objSedeTemp->setIdAcceso($idAcceso);
                    $this->objSedeTempDAO->objSedeTemp->setIndicador($valSedeTemp->indicador);
                    $resultSedeTemp = $this->objSedeTempDAO->ExecuteSave($this->objSedeTempDAO->objSedeTemp);

                    //AREAS
                    $this->objAreaDAO->objArea->setIdSede($idSede);
                    $resultArea = array();
                    $resultArea = $this->objAreaDAO->ExecuteSelect($this->objAreaDAO->objArea);
                    $countArea = count($resultArea);

                    if ($countArea > 0) {
                        foreach ($resultArea as $valAreaTemp) {
                            $this->objAreaTempDAO->objAreaTemp->setIdArea($valAreaTemp->idArea);
                            $this->objAreaTempDAO->objAreaTemp->setDescripcion($valAreaTemp->descripcion);
                            $this->objAreaTempDAO->objAreaTemp->setIdAcceso($idAcceso);
                            $this->objAreaTempDAO->objAreaTemp->setIdSedeTemp($resultSedeTemp[1]);
                            $this->objAreaTempDAO->objAreaTemp->setIndicador($valAreaTemp->indicador);
                            $this->objAreaTempDAO->ExecuteSave($this->objAreaTempDAO->objAreaTemp);
                        }
                    }
                }
            }
            return $result;
        }
    }
    
    public function ExecuteCompleteCombobox() {
        $this->task->setTables(self::TABLE);
        $this->task->setFields('idCuenta;nombreComercial');
        $this->task->setWhereFields('indicador');
        $this->task->setWhereLogical('=');
        $this->task->setWhereValues('1');
        $this->task->setOrder('nombreComercial');
        $this->task->setValuesOrder('asc');
        return $this->task->executeSelect();
    }

}
