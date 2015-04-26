<?php

session_start();

require_once __DIR__.'/../model/dao/equipoTempDAO.php';
require_once __DIR__.'/../model/dao/proyectoEquipoDAO.php';
require_once __DIR__.'/../model/dao/gridDAO.php';

$objEquipoTempDAO = new EquipoTempDAO();
$objProyectoEquipoDAO = new ProyectoEquipoDAO();
$objGridDAO = new GridDAO();

$action = $_GET['action'];

if ($action == "save") {

    //$idEquipo = $_GET['txtIdEquipo'];
    $idEquipo = '0';
    $serie = $_GET['adTxtSerie'];
    $costo = $_GET['adTxtCosto'];
    $idTipo = $_GET['adTxtIdTipo'];
    $idModelo = $_GET['adTxtIdModelo'];
    $idProyecto = $_GET['adTxtIdProyecto'];
    $idAcceso = $_SESSION['sessionIdAcceso'];
    $indicador = '1';

    $objEquipoTempDAO->objEquipoTemp->setIdEquipo($idEquipo);
    $objEquipoTempDAO->objEquipoTemp->setSerie($serie);
    $objEquipoTempDAO->objEquipoTemp->setCosto($costo);
    $objEquipoTempDAO->objEquipoTemp->setIdTipoEquipo($idTipo);
    $objEquipoTempDAO->objEquipoTemp->setIdModelo($idModelo);
    $objEquipoTempDAO->objEquipoTemp->setIdProyecto($idProyecto);
    $objEquipoTempDAO->objEquipoTemp->setIdAcceso($idAcceso);
    $objEquipoTempDAO->objEquipoTemp->setIndicador($indicador);

    $equipoTemp = $objEquipoTempDAO->ExecuteSave($objEquipoTempDAO->objEquipoTemp);

    if ($equipoTemp === true) {
        echo 'success';
    } else {
        echo 'fail';
    }
}

if ($action == 'delete') {
    $id = base64_decode($_GET['id']);
    $idAcceso = $_SESSION['sessionIdAcceso'];
    $indicador = '0';

    $objEquipoTempDAO->objEquipoTemp->setIdAcceso($idAcceso);
    $objEquipoTempDAO->objEquipoTemp->setIdEquipoTemp($id);
    $objEquipoTempDAO->objEquipoTemp->setIndicador($indicador);
    //actualizar indicador del equipo temporal
    $deleteEquipoTemp = $objEquipoTempDAO->ExecuteUpdateIndicador($objEquipoTempDAO->objEquipoTemp);

    if ($deleteEquipoTemp === true) {
        echo 'success';
    } else {
        echo 'fail';
    }
}

if ($action == 'count') {
    $idProyecto = $_GET['txtIdProyecto'];
    $idAcceso = $_SESSION['sessionIdAcceso'];

    $objEquipoTempDAO->objEquipoTemp->setIdProyecto($idProyecto);
    $objEquipoTempDAO->objEquipoTemp->setIdAcceso($idAcceso);

    $resultEquipoTemp = $objEquipoTempDAO->ExecuteSelect($objEquipoTempDAO->objEquipoTemp);
    $countEquipoTemp = count($resultEquipoTemp);

    if ($countEquipoTemp > 0) {
        echo 'success';
    } else {
        echo 'fail';
    }
}

if ($action == 'reload') {
    $error = true;
    $idAcceso = $_SESSION['sessionIdAcceso'];
    $idProyecto = base64_decode($_GET['idProyecto']);
    $objProyectoEquipoDAO->objProyectoEquipo->setIdProyecto($idProyecto);
    $proyectoEquipo = $objProyectoEquipoDAO->ExecuteSelect($objProyectoEquipoDAO->objProyectoEquipo);

    $objEquipoTempDAO->objEquipoTemp->setIdAcceso($idAcceso);
    $objEquipoTempDAO->objEquipoTemp->setIdProyecto($idProyecto);
    
    $deleteEquipoTemp = $objEquipoTempDAO->ExecuteDelete($objEquipoTempDAO->objEquipoTemp);
    
    if ($deleteEquipoTemp === true) {
        $error = false;
        foreach ($proyectoEquipo as $key => $val) {
            $objEquipoTempDAO->objEquipoTemp->setIdEquipo($val->idEquipo);
            $objEquipoTempDAO->objEquipoTemp->setSerie($val->serieEquipo);
            $objEquipoTempDAO->objEquipoTemp->setCosto($val->costo);
            $objEquipoTempDAO->objEquipoTemp->setIdTipoEquipo($val->idTipoEquipo);
            $objEquipoTempDAO->objEquipoTemp->setIdModelo($val->idModelo);
            $objEquipoTempDAO->objEquipoTemp->setIdProyecto($val->idProyecto);
            $objEquipoTempDAO->objEquipoTemp->setIdAcceso($idAcceso);
            $objEquipoTempDAO->objEquipoTemp->setIndicador('1');

            $SaveEquipoTemp = $objEquipoTempDAO->ExecuteSave($objEquipoTempDAO->objEquipoTemp);

            if ($SaveEquipoTemp === true) {
                $error = false;
            } else {
                $error = true;
            }
        }
    }
    echo (!($error === true)) ? 'success' : 'fail';
}